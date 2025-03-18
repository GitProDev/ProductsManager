<?php

namespace Inovector\ProductManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo_url', 'website_url'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}