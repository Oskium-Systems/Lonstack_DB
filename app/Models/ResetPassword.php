<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'token',
        'status',
        'expires_at',
        'attempts',
        'lockout_until',
    ];


    protected $casts = [
        'expires_at' => 'datetime',
        'lockout_until' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
