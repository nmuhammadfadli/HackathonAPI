<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['id_quiz', 'content'];

    public function options()
    {
        return $this->hasMany(Option::class, 'id_question');
    }
}