<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Polls;
use App\Models\Questions;
use App\Models\VariantAnswers;

use App\Http\Controllers\Api\VariantAnswersController;

use App\Http\Resources\PollsResource;
use App\Http\Resources\QuestionsResource;
use App\Http\Resources\VariantAnswersResource;

use App\Http\Requests\QuestionsStoreRequest;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//         $request->validate([
//             'polls_id' => 'required|integer|exists:polls,id'
//         ]);
//
//         $questions = QuestionsResource::collection(Questions::where('polls_id', $request->polls_id)->get());
//
//         return $questions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Polls $poll)
    {
//         $create_question = Questions::create($request->validated());
//
//         return $create_question;

        $variant_answers_add = new VariantAnswersController;

        $created_questions = Questions::create([
            'polls_id' => $poll->id,
            'id_type_question' => '1',
            'text_question' => 'Вопрос',
            'required' => '0',
        ]);

        $variant_answers_add->store($poll, $created_questions);

        return new QuestionsResource($created_questions);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Polls $poll, Questions $question)
    {
//         $id_poll = $poll->id;
//         $id_question = $question->id;
//
//         $question = Questions::where('polls_id', $id_poll)->where('id', $id_question)->get()->makeHidden('polls_id');
//
//         return $question;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionsStoreRequest $request, Polls $poll, Questions $question)
    {
//         $polls_id = ['polls_id' => $poll->id];
//
//         $request = $request->toArray();
//
//         $request = array_merge($request, $polls_id);
//
//         $request = $request->get();
//
//         $request = new QuestionsResource($request);

//         $request = $request . $polls_id;

        $question_update = new QuestionsResource(Questions::with('variantAnswers')->where('polls_id', $poll->id)->findOrFail($question->id));

        $question_update->update($request->validated());

        return $question_update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Polls $poll, Questions $question)
    {
        $question_delete = new QuestionsResource(Questions::with('variantAnswers')->where('polls_id', $poll->id)->findOrFail($question->id));

        $question_delete->destroy($question->id);

        return $question_delete;
    }
}
