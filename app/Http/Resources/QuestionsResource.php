<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\VariantAnswersResource;
use App\Models\VariantAnswers;

class QuestionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_type_question' => $this->id_type_question,
            'text_question' => $this->text_question,
            'required' => $this->required,
            'visible' => false,
            'variant_answers' => VariantAnswersResource::collection($this->variantAnswers),
        ];
    }
}
