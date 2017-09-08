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
        $lessons = $this->business->getLessonsByParams([]);
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
     * Show vocabularies by lesson id.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, Request $request)
    {
        if ($id == "all") {
            $vocabularies = $this->business->getVocabuluryByParams([])->shuffle();
        } else {
            $vocabularies = $this->business->getVocabuluryByParams(['lesson_id' => $id])->shuffle();
        }
        foreach ($vocabularies as $vocabulary) {
            $vocabulary->kana_word = $this->business->getHtmlDisplay($vocabulary->kana_word);
        }
        $wordType = $request->word_type;
        return response()->json(compact('vocabularies', 'wordType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vocabularies = $this->business->getVocabuluryByParams(['lesson_id' => $id]);
        foreach ($vocabularies as $vocabulary) {
            $vocabulary->kana_word = $this->business->getHtmlDisplay($vocabulary->kana_word);
        }
        return view('lesson.edit', compact('vocabularies'));
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

    /**
     * Test here.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function test(Request $request)
    {
        $students = $this->business->getStudentsFromClass($request->class_id);
        $lessons = $this->business->getLessonsByParams([]);
        $wordTypes = Nihongo::WORD_TYPE;
        // TODO: to the api
        $vocabularies = $this->business->getVocabuluryByParams(['lesson_id' => 1])->shuffle();
//        dd($vocabularies);
        $column = 'kana_word';
        // end TODO
        return view('lesson.test', compact('vocabularies', 'students', 'lessons', 'wordTypes', 'column'));
    }
}
