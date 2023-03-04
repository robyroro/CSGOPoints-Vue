<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $fillable = [
        'userid',
        'logs_room_id',
        'wall',
        'points',
        'cname',
        'track',
        'color',
    ];

    public function user()
    {
      return $this->belongsTo(User::class,'userid','id');
    }
}
