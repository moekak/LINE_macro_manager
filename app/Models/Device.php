<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_name',
        'device_name',
        "uid",
        "is_used",
        "user_id",
        "file_name"
    ];
}
