@extends('layouts.master')

@section('content')
    <h3>Lesson list</h3>
    <div class="row">
        <a class="pull-right btn btn-primary" href="{{route('class.create')}}">Add new class</a>
    </div>
    <div class="jumbotron">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Lesson name</th>
                <th>Number of word</th>
                <th>Weight (for randomization)</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lessons as $lesson)
                <tr>
                    <td><a href="{{route('lesson.edit',$lesson->id)}}">{{$lesson->name}}</a></td>
                    <td><a href="{{route('lesson.edit',$lesson->id)}}">{{count($lesson->vocabularies)}}</a></td>
                    <td>
                        <a href="{{route('lesson.edit',$lesson->id)}}">
                            {{($lesson->weight < 1) ? "Chưa có dữ liệu" : $lesson->weight}}
                        </a>
                    </td>
                    <td><a href="{{route('lesson.edit',$lesson->id)}}" class="btn btn-info">Add new words</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('extra_js')

@endsection