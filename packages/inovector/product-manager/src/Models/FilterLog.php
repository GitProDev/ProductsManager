<?php

namespace Inovector\ProductManager\Models;

use Illuminate\Database\Eloquent\Model;

class FilterLog extends Model
{
    protected $fillable = ['user_id', 'filters', 'applied_at'];
    public $timestamps = false;
}