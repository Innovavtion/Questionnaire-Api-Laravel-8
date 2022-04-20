<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\QuestionsResource;
use App\Models\Questions;

class PollsResource extends JsonResource
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
            'id_who_created' => $this->id_who_created,
            'name_poll' => $this->name_poll,
            'description_poll' => $this->description_poll,
            'created_at' => $this->created_at->format('d.m.y'),
            'questions' => QuestionsResource::collection($this->questions),
        ];
    }

//     public function with($request)
//     {
//         return [
//             'meta' => [
//                 'id_polls' => $this->id,
//             ],
//         ];
//     }
}
