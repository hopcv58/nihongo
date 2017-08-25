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

    /**
     * Business constructor.
     */
    public function __construct()
    {
        $this->vocabulary = new Vocabulary();
        $this->lesson = new Lesson();
        $this->student = new Student();
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
        $data = $this->vocabulary;
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
    public function getStudentsFromClass($class)
    {
        return $this->student->where('class', $class)->get();
    }

    public function getLessonList()
    {
        return $this->lesson->all();
    }
}