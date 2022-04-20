<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VariantAnswers;

class Questions extends Model
{
    use HasFactory;

    protected $fillable = ['polls_id', 'id_type_question', 'text_question', 'required'];

    public $timestamps = false;

    public function variantAnswers() {
        return $this->hasMany(VariantAnswers::class);
    }
}
