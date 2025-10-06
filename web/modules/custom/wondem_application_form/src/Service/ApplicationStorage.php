<?php

namespace Drupal\wondem_application_form\Service;

use Drupal\Core\Database\Connection;

class ApplicationStorage {

  public function __construct(private Connection $db) {}

  public function fetch(array $filters, int $limit = 50, int $offset = 0): array {
    $q = $this->db->select('wondem_applications', 'wa')
      ->fields('wa', ['id','full_name','email','phone','status','score','reviewer_uid','created','updated'])
      ->orderBy('created', 'DESC')
      ->range($offset, $limit);

    $this->applyFilters($q, $filters);
    return $q->execute()->fetchAllAssoc('id', \PDO::FETCH_ASSOC);
  }

    public function count(array $filters): int {
    // Build base select FIRST, then apply filters, then convert to count.
    $base = $this->db->select('wondem_applications', 'wa');
    $this->applyFilters($base, $filters);
    return (int) $base->countQuery()->execute()->fetchField();
    }

  public function load(int $id): ?array {
    $row = $this->db->select('wondem_applications', 'wa')
      ->fields('wa')
      ->condition('id', $id)
      ->execute()
      ->fetchAssoc();
    return $row ?: null;
  }

  public function saveReview(int $id, string $status, ?int $score, string $note, int $reviewer_uid): void {
    $score = ($score === null) ? null : max(0, min(100, $score));
    $this->db->update('wondem_applications')
      ->fields([
        'status' => $status,
        'score' => $score,
        'note' => $note,
        'reviewer_uid' => $reviewer_uid,
        'updated' => \Drupal::time()->getRequestTime(),
      ])
      ->condition('id', $id)
      ->execute();
  }

    private function applyFilters($q, array $filters): void {
    if (!empty($filters['status']) && $filters['status'] !== 'all') {
        $q->condition('wa.status', $filters['status']);
    }
    if (isset($filters['min_score']) && $filters['min_score'] !== '') {
        $q->condition('wa.score', (int) $filters['min_score'], '>=');
    }
    if (isset($filters['max_score']) && $filters['max_score'] !== '') {
        $q->condition('wa.score', (int) $filters['max_score'], '<=');
    }
    if (!empty($filters['q'])) {
        $needle = '%' . $filters['q'] . '%';
        $or = $q->orConditionGroup()
        ->condition('wa.full_name', $needle, 'LIKE')
        ->condition('wa.email', $needle, 'LIKE')
        ->condition('wa.phone', $needle, 'LIKE');
        $q->condition($or);
    }
    }
}
