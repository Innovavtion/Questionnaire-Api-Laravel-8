<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantAnswers extends Model
{
    use HasFactory;

    protected $fillable = ['questions_id', 'value'];

    public $timestamps = false;
}
