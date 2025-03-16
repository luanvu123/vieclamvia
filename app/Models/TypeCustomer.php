<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'Total_Deposit',
        'Discount_percent',
        'status',
    ];
}
