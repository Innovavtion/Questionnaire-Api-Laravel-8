<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Polls;
use App\Models\Questions;
use App\Models\VariantAnswers;

use App\Http\Resources\PollsResource;
use App\Http\Resources\QuestionsResource;
use App\Http\Resources\VariantAnswersResource;

use App\Http\Requests\VariantAnswersRequest;

class VariantAnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Polls $poll, Questions $question)
    {
        $created_variant_answers = VariantAnswers::create([
            'questions_id' => $question->id,
            'value' => '{"type": "string", "answer": "вариант ответа"}',
        ]);

        return $created_variant_answers;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VariantAnswersRequest $request, Polls $poll, Questions $question, $variantAnswers)
    {
        $variant_answer_update = new VariantAnswersResource(VariantAnswers::where('questions_id', $question->id)->findOrFail($variantAnswers));

        $variant_answer_update->update($request->validated());

        return $variant_answer_update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Polls $poll, Questions $question, $variantAnswers)
    {
        $variant_answer_delete = new VariantAnswersResource(VariantAnswers::where('questions_id', $question->id)->findOrFail($variantAnswers));

        $variant_answer_delete->destroy($variantAnswers);

        return $variant_answer_delete;
    }
}
