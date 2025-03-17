<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $fillable = [
        'big_logo',
        'small_logo',
        'url_facebook',
        'notice',
        'notice_modal',
        'warranty_policy_success',
        'warranty_policy_error',
    ];
}
