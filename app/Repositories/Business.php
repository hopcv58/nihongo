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
        $data = $this->vocabulary->orderBy('lesson_id','asc');
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
        $data = $this->lesson->orderBy('id','asc');
        foreach ($params as $key => $param) {
            if (!empty($param)) {
                $data = $data->where($key, $param);
            }
        }
        return $data->get();
    }
}