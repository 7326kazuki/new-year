<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * Class Book
 * @package App\Models
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Book extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name'
    ];
}
