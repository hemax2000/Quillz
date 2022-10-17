<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    //Table Name
    protected $table = 'quizzes';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
    
    public function user(){
        return $this->belongTo('App\Models\User');
    }
}
