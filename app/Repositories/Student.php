<?php

namespace App\Repositories;

class Student extends BaseModel
{
    protected $table = 'student';
    protected $fillable = [
        'name',
        'class',
    ];

    public function rule()
    {
        return [
            'name' => 'required|min:1|max:255',
            'class' => 'required|min:1|max:255',
        ];
    }

}