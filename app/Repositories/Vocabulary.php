<?php

namespace App\Repositories;

class Vocabulary extends BaseModel
{
    protected $table = 'vocabularies';
    protected $fillable = [
        'kanji_word',
        'kana_word',
        'viet_word',
        'lesson_id',
        'delete_flag',
    ];

    public function rule()
    {
        return [
            'name' => 'required|min:3|max:191|unique:categories',
            'alias' => 'max:191',
        ];
    }

    public function lessons()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }

}