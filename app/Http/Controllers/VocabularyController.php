<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use App\Repositories\Business;
use Illuminate\Http\Request;

class VocabularyController extends Controller
{
    /**
     * @var $business
     */
    private $business;

    /**
     * VocabularyController constructor.
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
        $lessons = $this->business->getLessonsByParams([]);
        return view('vocabulary.index', compact('lessons'));
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
        $validator = Validator::make($request->all(), [
            'kana_word' => 'required|unique:vocabularies|max:255',
            'viet_word' => 'required|max:255',
            'lesson_id' => 'required|exists:lessons,id'
        ]);

        $validator->after(function ($validator) {
            // TODO: add validation on bracket
        });

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        $vocabulary = $this->business->storeNewWord($request->kana_word, $request->viet_word, $request->lesson_id);
        $vocabulary->kana_word = $this->business->getHtmlDisplay($vocabulary->kana_word);
        return response()->json($vocabulary);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($this->business->getVocabularyById($id)->lessons->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return response()->json($this->business->deleteWord($request->id));
    }
}
