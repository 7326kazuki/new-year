<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * Class Money
 * @package App\Models
 * @property string $type
 * @property integer $price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Money extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'type',
        'price',
    ];
}
