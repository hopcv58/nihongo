<?php

namespace App\Repositories;

class Student extends BaseModel
{
    protected $table = 'students';
    protected $fillable = [
        'name',
        'class_id',
        'delete_flag',
    ];

    public function rule()
    {
        return [
            'name' => 'required|min:1|max:255',
            'class' => 'required|min:1|max:255',
        ];
    }

    public function nihongoClass()
    {
        return $this->belongsTo(NihongoClass::class, 'lesson_id', 'id');
    }
}