@extends('layouts.master')

@section('content')
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
                    <td>{{$lesson->name}}</td>
                    <td>{{count($lesson->vocabularies)}}</td>
                    <td>{{($lesson->weight < 1) ? "Chưa có dữ liệu" : $lesson->weight}}</td>
                    <td>Delete/Edit</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('extra_js')

@endsection