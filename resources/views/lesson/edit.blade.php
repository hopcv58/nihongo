@extends('layouts.master')

@section('content')
    <h3>{{$vocabularies[0]->lessons->name}}</h3>
    <div class="jumbotron">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Kanji word</th>
                <th>Kana word</th>
                <th>Vietnamese word</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($vocabularies as $vocabulary)
                <tr>
                    <td>{{$vocabulary->kanji_word}}</td>
                    <td>{{$vocabulary->kana_word}}</td>
                    <td>{{$vocabulary->viet_word}}</td>
                    <td>
                        <a class="btn btn-danger">Delete</a>
                        <a class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td><input type="text" name="kanji_word"></td>
                <td><input type="text" name="kanji_word"></td>
                <td><input type="text" name="kanji_word"></td>
                <td><a href="#" class="btn btn-info">Add new</a></td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('extra_js')

@endsection