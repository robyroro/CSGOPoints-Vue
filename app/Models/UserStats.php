<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStats extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'date', 'earned',];
}
