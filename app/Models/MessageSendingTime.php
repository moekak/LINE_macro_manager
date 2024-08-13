<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageSendingTime extends Model
{
    use HasFactory;

    public function groupMessage(){
        return $this->hasMany(GroupMessage::class, "time_id");
    }
}
