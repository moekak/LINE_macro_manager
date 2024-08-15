<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageSendingTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_id', 
        'end_id',
        'device_id'
    ];

    public function groupMessage(){
        return $this->hasMany(GroupMessage::class, "time_id");
    }
}
