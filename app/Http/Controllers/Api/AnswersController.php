<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Polls;
use App\Models\Questions;
use App\Models\VariantAnswers;
use App\Models\Answers;

use App\Http\Controllers\Api\QuestionsController;

use App\Http\Resources\PollsResource;
use App\Http\Resources\QuestionsResource;
use App\Http\Resources\VariantAnswersResource;

use App\Http\Requests\PollsStoreRequest;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Answers::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create_answers = Answers::create([
            'id_user' => $request->id_user,
            'id_question' => $request->id_question,
            'value' => $request->value,
        ]);

        return $create_answers;
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id_answer)
    {
        $update_answers = Answers::findOrFail($id_answer)->update([
            'id' => $id_answer,
            'id_user' => $request->id_user,
            'id_question' => $request->id_question,
            'value' => $request->value,
        ]);

        return $update_answers;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_answer)
    {
        $destroy_answers = Answers::findOrFail($id_answer)->destroy($id_answer);

        return $destroy_answers;
    }
}
