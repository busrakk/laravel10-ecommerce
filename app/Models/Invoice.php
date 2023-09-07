<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_no',
        'name',
        'email',
        'phone',
        'company_name',
        'address',
        'country',
        'city',
        'district',
        'zip_code',
        'note'
    ];
}
