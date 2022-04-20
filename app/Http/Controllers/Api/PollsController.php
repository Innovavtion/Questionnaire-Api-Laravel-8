<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Polls;
use App\Models\Questions;
use App\Models\VariantAnswers;

use App\Http\Controllers\Api\QuestionsController;

use App\Http\Resources\PollsResource;
use App\Http\Resources\QuestionsResource;
use App\Http\Resources\VariantAnswersResource;

use App\Http\Requests\PollsStoreRequest;

class PollsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Получение данных из модели PollsResource, который формирует нам удобный массив данных
    public function index()
    {
        $polls = Polls::all()->makeHidden('updated_at');

        return $polls;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Добавление данных в массив
    public function store(Request $request)
    {
        $questions_add = new QuestionsController;

        $created_polls = Polls::create([
            'id_who_created' => $request->id_who_created,
            'name_poll' => 'Новый опрос',
            'description_poll' => '',
        ]);

        $questions_add->store($created_polls);

        return new PollsResource($created_polls);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Просмотр конретного опроса
    public function show($id)
    {
       $polls = new PollsResource(Polls::with('questions')->findOrFail($id));

       return $polls;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Обновление данных в опросе
    public function update(PollsStoreRequest $request, $id)
    {
        $polls = new PollsResource(Polls::with('questions')->findOrFail($id));

        $polls->update($request->validated());

        return $polls;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $polls = new PollsResource(Polls::with('questions')->findOrFail($id));

        $polls->destroy($id);

        return $polls;
    }
}
