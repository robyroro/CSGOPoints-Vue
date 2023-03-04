<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable=['userid','points','item','status','icon'];

    public function user()
    {
      return $this->belongsTo(User::class,'userid','id');
    }

}
