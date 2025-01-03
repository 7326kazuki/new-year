<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * Class Training
 * @package App\Models
 * @property string $menu
 * @property integer $times
 * @property string $unit
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Training extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'menu',
        'times',
        'unit'
    ];
}
