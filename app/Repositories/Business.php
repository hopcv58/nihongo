<?php

namespace App\Repositories;

/**
 * contain all Business logic
 * Class Business
 * @package App\Responsitory
 */
class Business
{
    private $vocabulary;
    private $lesson;
    private $student;
    private $nihongoClass;

    /**
     * Business constructor.
     */
    public function __construct()
    {
        $this->vocabulary = new Vocabulary();
        $this->lesson = new Lesson();
        $this->student = new Student();
        $this->nihongoClass = new NihongoClass();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getVocabularyById($id)
    {
        return $this->vocabulary->where('id', $id)->first();
    }

    public function getVocabuluryByParams($params)
    {
        $data = $this->vocabulary->where('delete_flag', 0)
            ->orderBy('lesson_id', 'asc');
        foreach ($params as $key => $param) {
            if (!empty($param)) {
                $data = $data->where($key, $param);
            }
        }
        return $data->get();
    }

    /**
     * @param $class
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getStudentsFromClass($class_id)
    {
        return $this->student->where('class_id', $class_id)->get();
    }

    public function getLessonsByParams(array $params)
    {
        $data = $this->lesson->orderBy('id', 'asc');
        foreach ($params as $key => $param) {
            if (!empty($param)) {
                $data = $data->where($key, $param);
            }
        }
        return $data->get();
    }

    public function getClassesByParams(array $params)
    {
        $data = $this->nihongoClass->orderBy('id', 'asc');
        foreach ($params as $key => $param) {
            if (!empty($param)) {
                $data = $data->where($key, $param);
            }
        }
        $data = $data->where('delete_flag', '0');
        return $data->get();
    }

    public function deleteClass($id)
    {
        $class = $this->nihongoClass->find($id);
        $class->delete_flag = 1;
        $class->update();
    }

    public function storeNewWord($kanaWord, $vietWord, $lessonId)
    {
        $kanjiWord = $this->getKanjiFromKana($kanaWord);
        return $this->vocabulary->store([
            'kanji_word' => $kanjiWord,
            'kana_word' => $kanaWord,
            'viet_word' => $vietWord,
            'lesson_id' => $lessonId
        ]);
    }

    public function getKanjiFromKana($kanaWord)
    {
        while ($openBracketPos = strpos($kanaWord, '(')) {
            $closeBracketPos = strpos($kanaWord, ')', $openBracketPos + 1);
            $kanaWord = substr_replace($kanaWord, '', $openBracketPos, $closeBracketPos - $openBracketPos + 1);
        }
        return $kanaWord;
    }

    public function getHtmlDisplay($kanaWord)
    {
        while ($openBracketPos = mb_strpos($kanaWord, '(')) {
            $closeBracketPos = mb_strpos($kanaWord, ')', $openBracketPos + 1);

            $kanaWord = mb_substr($kanaWord, 0, $openBracketPos - 1) . '<ruby>'
                . mb_substr($kanaWord, $openBracketPos - 1, 1) . '<rt>'
                . mb_substr($kanaWord, $openBracketPos + 1, $closeBracketPos - $openBracketPos - 1) . '</rt></ruby>'
                . mb_substr($kanaWord, $closeBracketPos + 1);
        }
        return $kanaWord;
    }

    public function deleteWord(array $ids)
    {
        return $this->vocabulary->whereIn('id', $ids)->update(['delete_flag' => 1]);
    }

    public function updateWord($id, array $demands)
    {
        $vocabulary = $this->vocabulary->find($id);
        $vocabulary->kana_word = $demands['kana_word'];
        $vocabulary->viet_word = $demands['viet_word'];
        $vocabulary->save();
        return $vocabulary;
    }
}