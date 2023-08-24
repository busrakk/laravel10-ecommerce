<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'category_id',
        'short_text',
        'price',
        'size',
        'color',
        'qty',
        'status',
        'content',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
