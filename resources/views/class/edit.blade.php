{{--@extends('layouts.master')--}}

{{--@section('content')--}}
    {{--<h3>{{$class[0]->name}}</h3>--}}
    {{--<div class="jumbotron">--}}
        {{--<table class="table table-hover">--}}
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th></th>--}}
                {{--<th>Name</th>--}}
                {{--<th>Action</th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}
            {{--@foreach($students as $student)--}}
                {{--<tr id="row{{$student->id}}">--}}
                    {{--<td><input type="checkbox" name="word_id" value="{{$student->id}}"></td>--}}
                    {{--<td>{!! $student->name !!}</td>--}}
                    {{--<td>--}}
                        {{--<a class="btn btn-primary" onclick="openEditModal('{{$student->id}}')">Edit</a>--}}
                    {{--</td>--}}
                {{--</tr>--}}
            {{--@endforeach--}}
            {{--<tr id="formInputWord">--}}
                {{--<td><input type="text" name="kanji_word" id="kanji_input"></td>--}}
                {{--<td></td>--}}
                {{--<td><input type="text" name="kanji_word" id="name_input"></td>--}}
                {{--<td><a href="#" class="btn btn-info" id="addWordBtn">Add new</a></td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td><a class="btn btn-danger" id="deleteBtn">Delete</a></td>--}}
                {{--<td></td>--}}
                {{--<td></td>--}}
                {{--<td></td>--}}
            {{--</tr>--}}
            {{--</tbody>--}}
        {{--</table>--}}
    {{--</div>--}}
    {{--<!-- Modal -->--}}
    {{--<div id="editModal" class="modal fade" role="dialog">--}}
        {{--<div class="modal-dialog">--}}

            {{--<!-- Modal content-->--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                    {{--<h4 class="modal-title">Modal Header</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="email">Name: </label>--}}
                        {{--<input type="text" class="form-control" id="name_edit">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-success" data-dismiss="modal" onclick="saveEditedWord()">Save--}}
                    {{--</button>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}

{{--@section('extra_js')--}}
    {{--<script>--}}
        {{--var current_id;--}}

        {{--$("#addWordBtn").on('click', function (e) {--}}
            {{--$.post("{{route('student.store')}}",--}}
                {{--{--}}
                    {{--"_token": "{{csrf_token()}}",--}}
                    {{--"name": $("#name_input").val(),--}}
                    {{--"class_id": "{{$class[0]->id}}"--}}
                {{--},--}}
                {{--function (data, status) {--}}
                    {{--if (status === 'success') {--}}
                        {{--$("#formInputWord").before("<tr><td><input type='checkbox' name='student_id' value='" + data.id + "'></td><td>"--}}
                            {{--+ data.name + "</td><td>"--}}
                            {{--+ "<a class='btn btn-primary' onclick='openEditModal(" + data.id + ")'>Edit</a></td></tr>");--}}
                    {{--} else {--}}
                        {{--alert(data);--}}
                    {{--}--}}
                {{--}--}}
            {{--);--}}
        {{--});--}}

        {{--$("#deleteBtn").on("click", function (e) {--}}
            {{--var ids = [];--}}
            {{--$("input:checkbox[name='word_id']:checked").each(function () {--}}
                {{--ids.push($(this).val());--}}
            {{--});--}}
            {{--$.post("{{route('student.destroy')}}",--}}
                {{--{--}}
                    {{--"_token": "{{csrf_token()}}",--}}
                    {{--"id[]": ids--}}
                {{--},--}}
                {{--function (data, status) {--}}
                    {{--if (status === 'success') {--}}
                        {{--for (var i = 0; i < ids.length; i++) {--}}
                            {{--$("#row" + ids[i]).hide();--}}
                        {{--}--}}
                    {{--}--}}
                {{--}--}}
            {{--);--}}
        {{--});--}}

        {{--function openEditModal(id) {--}}
            {{--$.getJSON("{{route('student.index')}}" + "/" + id, function (data) {--}}
                {{--var kana_edit = $("#kana_edit");--}}
                {{--var viet_edit = $("#viet_edit");--}}
                {{--kana_edit.val(data.kana_word);--}}
                {{--viet_edit.val(data.viet_word);--}}
                {{--$("#editModal").modal();--}}
                {{--current_id = id;--}}
            {{--});--}}
        {{--}--}}

        {{--function saveEditedWord() {--}}
            {{--$.post("{{route('student.index')}}" + "/" + current_id,--}}
                {{--{--}}
                    {{--"_method": "PUT",--}}
                    {{--"_token": "{{csrf_token()}}",--}}
                    {{--"kana_word": $("#kana_edit").val(),--}}
                    {{--"viet_word": $("#viet_edit").val()--}}
                {{--},--}}
                {{--function (data, status) {--}}
                    {{--if (status === 'success') {--}}
                        {{--$("#row" + data.id).html(--}}
                            {{--"<td><input type='checkbox' name='word_id' value='" + data.id + "'></td><td>"--}}
                            {{--+ data.name + "</td><td><a class='btn btn-primary' onclick='openEditModal(" + data.id + ")'>Edit</a></td>"--}}
                        {{--)--}}
                    {{--}--}}
                {{--}--}}
            {{--);--}}
        {{--}--}}
    {{--</script>--}}
{{--@endsection--}}