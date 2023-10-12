<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $table = 'votes';
    protected $fillable = [
        'user_id',
        'feedback_id',
        'vote_type',
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

}
