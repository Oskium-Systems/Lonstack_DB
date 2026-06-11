<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvSubmission extends Model
{
  protected $fillable = [
    'name',
    'email',
    'phone',
    'position',
    'message',
    'cv_path',
    'cv_original_name',
    'cv_mime',
    'cv_size',
    'status',
    'admin_notes',
  ];

  // ── Accessors ────────────────────────────────────────────

  public function getStatusLabelAttribute(): string
  {
    return match ($this->status) {
      'new'         => 'New',
      'reviewed'    => 'Reviewed',
      'shortlisted' => 'Shortlisted',
      'rejected'    => 'Rejected',
      default       => ucfirst($this->status),
    };
  }

  public function getStatusColorAttribute(): string
  {
    return match ($this->status) {
      'new'         => 'primary',
      'reviewed'    => 'warning',
      'shortlisted' => 'success',
      'rejected'    => 'danger',
      default       => 'secondary',
    };
  }

  public function getFileSizeFormattedAttribute(): string
  {
    if (!$this->cv_size) return '—';
    $kb = $this->cv_size / 1024;
    if ($kb < 1024) return round($kb, 1) . ' KB';
    return round($kb / 1024, 2) . ' MB';
  }
}
