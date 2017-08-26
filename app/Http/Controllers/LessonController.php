<?php

namespace App\Http\Controllers;

use App\Components\Constants\Nihongo;
use App\Repositories\Business;
use App\Repositories\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    private $business;

    /**
     * LessonController constructor.
     */
    public function __construct()
    {
        $this->business = new Business();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = $this->business->getStudentsFromClass($request->class_id);
        $lessons = $this->business->getLessonList();
        $wordTypes = Nihongo::WORD_TYPE;
        // TODO: to the api
        $vocabularies = $this->business->getVocabuluryByParams(['lesson_id' => 1])->shuffle();
//        dd($vocabularies);
        $column = 'kana_word';
        // end TODO
        return view('lesson.index', compact('vocabularies', 'students', 'lessons', 'wordTypes', 'column'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $filter = [
            'lesson_id' => $id
        ];
        if (in_array($request->word_type, ['kanji_word', 'kana_word', 'viet_word']))
            $wordType = $request->word_type;
        else {
            $wordType = 'kana_word';
        }
        $vocabularies = $this->business->getVocabuluryByParams($filter)->shuffle();
        return view('lesson.show', compact('vocabularies', 'wordType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Repositories\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Repositories\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repositories\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
