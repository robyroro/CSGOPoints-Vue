<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waxpeer extends Model
{
    protected $fillable = ['item_id','name','image','price'];
}
