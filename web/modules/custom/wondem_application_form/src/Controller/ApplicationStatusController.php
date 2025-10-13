<?php

namespace Drupal\wondem_application_form\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

class ApplicationStatusController extends ControllerBase {

  /**
   * Small helper to render a nice alert (no icon).
   *
   * @param string $variant info|success|warning|error
   * @param string $title
   * @param string $body
   * @param array  $actions [['label'=>'Text','url'=>'/path','primary'=>true], ...]
   */
  private function renderAlert(string $variant, string $title, string $body, array $actions = []): string {
    $palette = [
      'info'    => ['bg'=>'bg-blue-50','border'=>'border-blue-200','text'=>'text-blue-800'],
      'success' => ['bg'=>'bg-green-50','border'=>'border-green-200','text'=>'text-green-800'],
      'warning' => ['bg'=>'bg-amber-50','border'=>'border-amber-200','text'=>'text-amber-900'],
      'error'   => ['bg'=>'bg-red-50','border'=>'border-red-200','text'=>'text-red-800'],
    ];
    $p = $palette[$variant] ?? $palette['info'];

    $actions_html = '';
    if (!empty($actions)) {
      $btns = [];
      foreach ($actions as $a) {
        $label   = htmlspecialchars($a['label'] ?? 'Learn more', ENT_QUOTES, 'UTF-8');
        $url     = htmlspecialchars($a['url'] ?? '#', ENT_QUOTES, 'UTF-8');
        $primary = !empty($a['primary']);
        $cls = $primary
          ? 'inline-flex items-center justify-center rounded-lg px-3 py-2 text-sm font-semibold bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/80'
          : 'inline-flex items-center justify-center rounded-lg px-3 py-2 text-sm font-semibold border border-black/10 bg-white/70 hover:bg-white';
        $btns[] = '<a href="'.$url.'" class="'.$cls.'">'.$label.'</a>';
      }
      $actions_html = '<div class="mt-4 flex flex-wrap gap-2">'.implode('', $btns).'</div>';
    }

    return '
      <div class="mx-auto w-full max-w-3xl">
        <div class="rounded-xl '.$p['bg'].' border '.$p['border'].' p-4 md:p-5 shadow-sm">
          <h3 class="font-semibold '.$p['text'].' text-base">'.htmlspecialchars($title, ENT_QUOTES, 'UTF-8').'</h3>
          <div class="mt-1 text-sm text-gray-700 leading-relaxed">'.$body.'</div>
          '.$actions_html.'
        </div>
      </div>
    ';
  }

  /**
   * Show the current user's application status and summary.
   */
  public function status() {
    $account = $this->currentUser();
    if ($account->isAnonymous()) {
      $login = Url::fromUserInput('/user/login', [
        'query' => ['destination' => '/application/status'],
      ])->toString();

      return [
        '#title' => '',
        '#type'   => 'container',
        '#attributes' => ['class' => ['px-4','py-6']],
        'alert' => [
          '#markup' => $this->renderAlert(
            'warning',
            $this->t('Please log in'),
            $this->t('You must <a class="underline" href=":login">log in</a> to view your application status.', [':login' => $login])
          ),
        ],
      ];
    }

    // Look up the latest application by this user's email.
    $email  = $account->getEmail();
    $record = \Drupal::database()->select('wondem_applications', 'wa')
      ->fields('wa', ['id', 'full_name', 'email', 'phone', 'created', 'data'])
      ->condition('email', $email)
      ->orderBy('created', 'DESC')
      ->range(0, 1)
      ->execute()
      ->fetchObject();

    // No application yet — nudge to apply.
    if (!$record) {
      return [
        '#title' => '',
        '#type'   => 'container',
        '#attributes' => ['class' => ['px-4','py-6']],
        'alert' => [
          '#markup' => $this->renderAlert(
            'info',
            $this->t('No application found'),
            $this->t('We don’t have an application from you yet.'),
            [
              ['label' => $this->t('Apply now'), 'url' => '/application-form', 'primary' => TRUE],
            ]
          ),
        ],
      ];
    }

    // Decode saved values (was stored with serialize()).
    $values = @unserialize($record->data) ?: [];

    $role_labels = [
      'it' => $this->t('IT Applicant / Developer'),
      'cw' => $this->t('Content Creator and Writer'),
      'cs' => $this->t('Customer Service'),
    ];
    $role_label = $values['role_label'] ?? ($role_labels[$values['role'] ?? ''] ?? ($values['role'] ?? '-'));

    $submitted = \Drupal::service('date.formatter')->format($record->created, 'short');

    // Responsive card using a definition list (better on mobile than wide tables).
    $card = '
      <section class="px-4 py-6">
        <div class="mx-auto w-full max-w-3xl rounded-xl bg-white border border-slate-200 shadow-sm">
          <div class="px-5 py-5 border-b border-slate-200">
            <h1 class="text-lg md:text-xl font-semibold text-slate-900">'.$this->t('Your Application').'</h1>
            <p class="mt-1 text-sm text-slate-600">'.$this->t('Status:').' <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 px-2 py-0.5 text-xs font-medium">'.$this->t('Submitted').'</span></p>
          </div>

          <div class="px-5 py-5">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
              <div>
                <dt class="text-xs uppercase tracking-wide text-slate-500">'.$this->t('Submitted on').'</dt>
                <dd class="text-slate-900">'.$submitted.'</dd>
              </div>

              <div>
                <dt class="text-xs uppercase tracking-wide text-slate-500">'.$this->t('Role').'</dt>
                <dd class="text-slate-900">'.htmlspecialchars((string) $role_label, ENT_QUOTES, 'UTF-8').'</dd>
              </div>

              <div>
                <dt class="text-xs uppercase tracking-wide text-slate-500">'.$this->t('Full Name').'</dt>
                <dd class="text-slate-900">'.htmlspecialchars((string) $record->full_name, ENT_QUOTES, 'UTF-8').'</dd>
              </div>

              <div>
                <dt class="text-xs uppercase tracking-wide text-slate-500">'.$this->t('Email').'</dt>
                <dd class="text-slate-900">'.htmlspecialchars((string) $record->email, ENT_QUOTES, 'UTF-8').'</dd>
              </div>

              <div class="sm:col-span-2">
                <dt class="text-xs uppercase tracking-wide text-slate-500">'.$this->t('Phone').'</dt>
                <dd class="text-slate-900">'.htmlspecialchars((string) $record->phone, ENT_QUOTES, 'UTF-8').'</dd>
              </div>
            </dl>

            <div class="mt-6 flex flex-wrap gap-2">
              <a href="/" class="inline-flex items-center justify-center rounded-lg px-4 py-2 text-sm font-semibold border border-black/10 bg-white hover:bg-slate-50">
                '.$this->t('Go to home').'
              </a>
            </div>
          </div>
        </div>

        <p class="mx-auto mt-4 w-full max-w-3xl text-sm text-slate-600">'.$this->t('Your application has been received. We’ll email you with updates.').'</p>
      </section>
    ';

    return [
      '#title' => '',
      '#type' => 'container',
      '#attributes' => ['class' => ['waf-status']],
      'markup' => ['#markup' => $card],
    ];
  }
}
