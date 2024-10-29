<?php
namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'cate_id',
        'product_name',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'image',
        'qty',
        'tax',
        'status',
        'trending',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
    function category()
    {
        return $this->belongsTo(Category::class,'cate_id');
    }
    public function carts()
{
    return $this->hasMany(Cart::class);
}
}


