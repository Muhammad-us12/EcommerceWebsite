<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $slug = Str::slug($product->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $product->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    protected $fillable = [
        'name',
        'description',
        'size',
        'slug',
        'category_id',
        'subcategory_id',
        'brand_id',
        'price',
        'rent_for_days',
        'cost_price',
        'status',
        'quantity',
        'security_deposit',
        'display_on_website',
        'review_remarks',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function productAssignedAttributes()
    {
        return $this->hasMany(ProductAssignedAttributes::class);
    }

    public function productExtraPrices()
    {
        return $this->hasMany(ProductExtraPrice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderLineItems()
    {
        return $this->hasMany(OrderLineItem::class);
    }
}
