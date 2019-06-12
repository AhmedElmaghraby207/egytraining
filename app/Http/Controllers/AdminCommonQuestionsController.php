<?php

namespace App\Http\Controllers;

use App\CommonQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminCommonQuestionsController extends Controller
{
    public function index()
    {
        $questions = CommonQuestion::all();
        return view('admin.common_questions.index', compact('questions'));
    }

    //=========================================================//
    public function create()
    {
        return view('admin.common_questions.create');
    }

    //=========================================================//
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required|unique:common_questions',
            'answer' => 'required',
        ]);

        CommonQuestion::create($request->all());
        Session::flash('success', 'تم إضافة السؤال بنجاح');
        return redirect()->route('questions.index');

    }

    //=========================================================//
    public function show()
    {
        return redirect()->route('questions.index');
    }

    //=========================================================//
    public function edit($slug)
    {
        $question = CommonQuestion::findBySlugOrFail($slug);
        return view('admin.common_questions.edit', compact('question'));
    }

    //=========================================================//
    public function update(Request $request, $id)
    {
        $question = CommonQuestion::findOrFail($id);
        $this->validate($request, [
            'question' => 'required|unique:common_questions,slug'.$question->$id,
            'answer' => 'required',
        ]);

        $question->update($request->all());
        Session::flash('info', 'تم تعديل السؤال بنجاح');
        return redirect()->route('questions.index');
    }


    //=========================================================//
    public function destroy($id)
    {
        $question = CommonQuestion::findOrFail($id);

        $question->delete();

        Session::flash('error', 'تم حذف السؤال بنجاح');
        return redirect()->back();
    }

}
