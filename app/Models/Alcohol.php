<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * Class Alcohol
 * @package App\Models
 * @property string $counterplan
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Alcohol extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'counterplan',
    ];
}
