<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;

class QuestionController extends Controller
{
    public function __construct(Question $question)
    {
        $this->question = $question;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions =$this->question->latest()->where('user_id', auth()->user()->id)->get();
        return view('question.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question();
        return view('question.create',compact('question'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\QuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        try {

            $question = $this->question->create($request->validated());
            $this->updateQuestionTag($question, $request);
            $request->session()->flash('success', 'Question created successfully');
            return redirect()->route('question.index');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
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
    public function edit(Question $question)
    {
        return view('question.create',compact('question'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\QuestionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {
        try {
            $question->update($request->validated());
            $this->updateQuestionTag($question, $request);
            $request->session()->flash('success', 'Question updated successfully');
            return redirect()->route('question.index');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    protected function updateQuestionTag($question, $request)
    {
        $tags = array_filter(explode(',', $request->tags));
        $question->questionHasTags()->sync($tags);
    }
}
