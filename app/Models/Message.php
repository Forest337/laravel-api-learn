<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function messageCreate()
    {
        return $this->belongsTo(Message::class);
    }
}
