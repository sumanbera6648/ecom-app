<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    /**
     * The attributes that are encrypted by the encryptable trait
     *
     * @var array
     */
    protected $encryptable = [
        'title',
        'photo',
        'description',
        'status',
    ];
}
