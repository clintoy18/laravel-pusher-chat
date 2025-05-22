<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Message extends Model
{
    use HasFactory;
    //insert the line below
    protected $fillable = ['message', 'user_id']; 


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}



