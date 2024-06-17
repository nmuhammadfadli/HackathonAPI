<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['title', 'created_at'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'id_quiz');
    }
}