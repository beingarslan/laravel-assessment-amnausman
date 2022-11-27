<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'title',
        'description',
        'price',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function getPriceAttribute($value)
    {
        return number_format($value, 2);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace(',', '', $value);
    }

    public function getRouteKeyName()
    {
        return 'title';
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', "%{$search}%");
    }

    public function scopePrice($query, $price)
    {
        return $query->where('price', '<=', $price);
    }

    public function scopeSort($query, $sort)
    {
        if ($sort === 'price') {
            return $query->orderBy('price', 'asc');
        }

        return $query->orderBy('title', 'asc');
    }

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'id');
    }


}
