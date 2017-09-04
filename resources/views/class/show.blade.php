@extends('layouts.master')

@section('content')
    <div class="jumbotron">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Kanji word</th>
                <th>Kana word</th>
                <th>Vietnamese word</th>
                <th>Lesson</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($vocabularies as $vocabulary)
                <tr>
                    <td>{{$vocabulary->kanji_word}}</td>
                    <td>{{$vocabulary->kana_word}}</td>
                    <td>{{$vocabulary->viet_word}}</td>
                    <td>{{$vocabulary->lessons->name}}</td>
                    <td>Delete/Edit</td>
                </tr>
            @endforeach
            <tr>
                <td><input type="text" name="kanji_word"></td>
                <td><input type="text" name="kanji_word"></td>
                <td><input type="text" name="kanji_word"></td>
                <td><input type="text" name="kanji_word"></td>
                <td>Add new</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('extra_js')

@endsection