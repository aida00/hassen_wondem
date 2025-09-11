<?php

namespace Drupal\wondem_application_form\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Provides admin listing and detail view for applications.
 */
class ApplicationAdminController extends ControllerBase {

  /**
   * The date formatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * Constructs the controller.
   */
  public function __construct(DateFormatterInterface $date_formatter) {
    $this->dateFormatter = $date_formatter;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('date.formatter'));
  }

  /**
   * List applications in a table.
   */
  public function list() {
    $header = [
      'id' => $this->t('ID'),
      'full_name' => $this->t('Full Name'),
      'email' => $this->t('Email'),
      'phone' => $this->t('Phone'),
      'created' => $this->t('Submitted'),
    ];

    $rows = [];
    $results = \Drupal::database()->select('wondem_applications', 'wa')
      ->fields('wa', ['id', 'full_name', 'email', 'phone', 'created'])
      ->orderBy('created', 'DESC')
      ->execute();

    foreach ($results as $record) {
      $rows[] = [
        'id' => Link::fromTextAndUrl((string) $record->id, Url::fromRoute('wondem_application_form.admin_view', ['id' => $record->id])),
        'full_name' => $record->full_name,
        'email' => $record->email,
        'phone' => $record->phone,
        'created' => $this->dateFormatter->format($record->created, 'short'),
      ];
    }

    return [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => $this->t('No applications found.'),
    ];
  }

  /**
   * View application details.
   */
  public function view($id) {
    $record = \Drupal::database()->select('wondem_applications', 'wa')
      ->fields('wa')
      ->condition('id', $id)
      ->execute()
      ->fetchObject();

    if (!$record) {
      throw new NotFoundHttpException();
    }

    $data = @unserialize($record->data) ?: [];

    $build = [
      '#type' => 'details',
      '#title' => $this->t('Application #@id', ['@id' => $record->id]),
      'info' => [
        '#type' => 'item',
        '#title' => $this->t('Submitted by'),
        '#markup' => "{$record->full_name} ({$record->email})",
      ],
      'phone' => [
        '#type' => 'item',
        '#title' => $this->t('Phone'),
        '#markup' => $record->phone,
      ],
      'submitted' => [
        '#type' => 'item',
        '#title' => $this->t('Submitted on'),
        '#markup' => $this->dateFormatter->format($record->created, 'long'),
      ],
      'answers' => [
        '#theme' => 'item_list',
        '#title' => $this->t('Form Answers'),
        '#items' => [],
      ],
    ];

    foreach ($data as $key => $value) {
      $build['answers']['#items'][] = $this->t('@key: @value', [
        '@key' => ucfirst(str_replace('_', ' ', $key)),
        '@value' => $value,
      ]);
    }

    return $build;
  }
}
