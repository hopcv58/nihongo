<?php

namespace App\Repositories;

class Lesson extends BaseModel
{
    protected $table = 'lessons';
    protected $fillable = [
        'name',
        'weight'
    ];

    public function rule()
    {
        return [
            'name' => 'required|min:1|max:255',
        ];
    }

    public function vocabularies()
    {
        return $this->hasMany(Vocabulary::class, 'lesson_id', 'id');
    }

}