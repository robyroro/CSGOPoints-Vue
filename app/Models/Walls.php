<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walls extends Model
{
    protected $fillable = ['ip', 'name', 'sid', 'amount', 'status', 'credit', 'reverse', 'passwordVar', 'password', 'success', 'error', 'hash', 'iframe', 'track', 'mulTrack', 'per', 'boost', 'unlock','active','color','logo','type','cname','wall_image'];
}
