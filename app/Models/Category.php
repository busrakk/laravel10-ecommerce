<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{

    use Sluggable;
    protected $fillable = [
        'image',
        'thumbnail',
        'name',
        'slug',
        'content',
        'cat_ust',
        'status'
    ];

    public function items(){
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function subCategory(){
        return $this->hasMany(Category::class, 'cat_ust', 'id');
    }


    public function getTotalProductCount()
    {
        $total = $this->items()->count();

        foreach ($this->subcategory as $childCategory) {
          $total += $childCategory->items()->count(); // Alt kategorilerdeki ürün sayısını totale ekle
        }

        return $total;
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
