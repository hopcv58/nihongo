@extends('layouts.master')

@section('content')
    <h3>Lesson list</h3>
    <div class="row">
        <a class="pull-right btn btn-danger" id="deleteBtn">Delete classes</a>
    </div>
    <div class="jumbotron">
        <table class="table table-hover">
            <thead>
            <tr>
                <th></th>
                <th>Lesson name</th>
                <th>Number of word</th>
                <th>Weight (for randomization)</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lessons as $lesson)
                <tr id="row{{$lesson->id}}">
                    <td><input type="checkbox" name="lesson_id" value="{{$lesson->id}}"></td>
                    <td><a href="{{route('lesson.edit',$lesson->id)}}"
                           id="row{{$lesson->id}}_name">{{$lesson->name}}</a></td>
                    <td><a href="{{route('lesson.edit',$lesson->id)}}">{{count($lesson->vocabularies)}}</a></td>
                    <td>
                        <a href="{{route('lesson.edit',$lesson->id)}}" id="row{{$lesson->id}}_weight">
                            {{($lesson->weight < 1) ? "Chưa có dữ liệu" : $lesson->weight}}
                        </a>
                    </td>
                    <td>
                        <a href="{{route('lesson.edit',$lesson->id)}}" class="btn btn-info">Add new words</a>
                        <a class="btn btn-primary" onclick="openEditModal('{{$lesson->id}}')">Edit</a>
                    </td>
                </tr>
            @endforeach
            <tr id="formInputLesson">
                <td></td>
                {{--<td><input type="text" name="kanji_word" id="kanji_input"></td>--}}
                <td><input type="text" name="name" id="lesson_name"></td>
                <td></td>
                <td><input type="number" name="weight" id="lesson_weight"></td>
                <td><a class="btn btn-info" id="addLessonBtn">Add new</a></td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name_edit">Lesson name:</label>
                        <input type="text" class="form-control" id="name_edit">
                    </div>
                    <div class="form-group">
                        <label for="weight_edit">Lesson weight:</label>
                        <input type="text" class="form-control" id="weight_edit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="saveEditedWord()">Save
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('extra_js')
    <script>
        var current_id;

        $("#addLessonBtn").on('click', function (e) {
            $.post("{{route('lesson.store')}}",
                {
                    "_token": "{{csrf_token()}}",
                    "name": $("#lesson_name").val(),
                    "weight": $("#lesson_weight").val()
                },
                function (data, status) {
                    if (status === 'success') {
                        $("#formInputLesson").before("<tr id='row" + data.id + "'><td><input type='checkbox' name='lesson_id' value='"
                            + data.id + "'></td>" + "<td><a href = '" + "{{route('lesson.index')}}" + "/"
                            + data.id + "/edit' id='row" + data.id + "_name'>" + data.name + "</a></td><td><a href = '"
                            + "{{route('lesson.index')}}" + "/ " + data.id + "/edit'>0</a></td><td>"
                            + "<a href = '" + "{{route('lesson.index')}}" + "/" + data.id + "/edit" + "'  id='row"
                            + data.id + "_weight'>" + data.weight + "</a></td><td>"
                            + "<a href='" + "{{route('lesson.index')}}" + "/" + data.id
                            + "/edit' class='btn btn-info'>Add new words</a>"
                            + "<a class='btn btn-primary' onclick=openEditModal('" + data.id
                            + "')>Edit</a>" + "</td></tr>");
                    } else {
                        alert("Error! Please try again!");
                    }
                }
            ).fail(function (data) {
                $.each(data.responseJSON, function (i, item) {
                    alert(item);
                    return false;
                });
            });
        });

        $("#deleteBtn").on("click", function (e) {
            var ids = [];
            $("input:checkbox[name='lesson_id']:checked").each(function () {
                ids.push($(this).val());
            });
            $.post("{{route('lesson.destroy')}}",
                {
                    "_token": "{{csrf_token()}}",
                    "id[]": ids
                },
                function (data, status) {
                    if (status === 'success') {
                        for (var i = 0; i < ids.length; i++) {
                            $("#row" + ids[i]).hide();
                        }
                    } else {
                        alert("Error! Please try again!");
                    }
                }
            ).fail(function (data) {
                $.each(data.responseJSON, function (i, item) {
                    alert(item);
                    return false;
                });
            });
        });

        function openEditModal(id) {
            current_id = id;
            var name_edit = $("#name_edit");
            var weight_edit = $("#weight_edit");
            name_edit.val($("#row" + id + "_name").text().trim());
            weight_edit.val($("#row" + id + "_weight").text().trim());
            $("#editModal").modal();
        }

        function saveEditedWord() {
            $.post("{{route('lesson.index')}}" + "/" + current_id,
                {
                    "_method": "PUT",
                    "_token": "{{csrf_token()}}",
                    "name": $("#name_edit").val(),
                    "weight": $("#weight_edit").val()
                },
                function (data, status) {
                    if (status === 'success') {
                        console.log(data);
                    } else {
                        alert("Error! Please try again!");
                    }
                }
            ).fail(function (data) {
                $.each(data.responseJSON, function (i, item) {
                    alert(item);
                    return false;
                });
            });
        }
    </script>
@endsection