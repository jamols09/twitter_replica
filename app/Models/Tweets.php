<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweets extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tweet',
        'is_public',
        'image',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
