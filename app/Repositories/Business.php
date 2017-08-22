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

    /**
     * Business constructor.
     */
    public function __construct()
    {
        $this->vocabulary = new Vocabulary();
        $this->lesson = new Lesson();
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
            $data = $data->where($key, $param);
        }
        return $data->get();
    }
}