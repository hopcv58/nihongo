<?php

namespace App\Repositories;

class NihongoClass extends BaseModel
{
    protected $table = 'classes';
    protected $fillable = [
        'name',
    ];

    public function rule()
    {
        return [
            'name' => 'required|min:1|max:255',
        ];
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }

}