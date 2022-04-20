<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Questions;
use App\Models\VariantAnswers;

class Polls extends Model
{
    use HasFactory;

    protected $fillable = ['id_who_created','name_poll', 'description_poll'];

    //если не понятно тема Eloquent ORM -> Отношения
    public function questions() {
        return $this->hasMany(Questions::class);
    }
}
