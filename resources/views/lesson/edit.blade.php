@extends('layouts.master')

@section('content')
    <h3>{{$lesson[0]->name}}</h3>
    <div class="jumbotron">
        <table class="table table-hover">
            <thead>
            <tr>
                <th></th>
                <th>Kanji word</th>
                <th>Kana word</th>
                <th>Vietnamese word</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($vocabularies as $vocabulary)
                <tr id="row{{$vocabulary->id}}">
                    <td><input type="checkbox" name="word_id" value="{{$vocabulary->id}}"></td>
                    <td>{{$vocabulary->kanji_word}}</td>
                    <td>{!! $vocabulary->kana_word !!}</td>
                    <td>{{$vocabulary->viet_word}}</td>
                    <td>
                        <a class="btn btn-primary" onclick="openEditModal('{{$vocabulary->id}}')">Edit</a>
                    </td>
                </tr>
            @endforeach
            <tr id="formInputWord">
                {{--<td><input type="text" name="kanji_word" id="kanji_input"></td>--}}
                <td></td>
                <td></td>
                <td><input type="text" name="kanji_word" id="kana_input"></td>
                <td><input type="text" name="kanji_word" id="viet_input"></td>
                <td><a class="btn btn-info" id="addWordBtn">Add new</a></td>
            </tr>
            <tr>
                <td><a class="btn btn-danger" id="deleteBtn">Delete</a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
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
                        <label for="kana_edit">Kana word:</label>
                        <input type="text" class="form-control" id="kana_edit">
                    </div>
                    <div class="form-group">
                        <label for="viet_edit">Viet word:</label>
                        <input type="text" class="form-control" id="viet_edit">
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

        $("#addWordBtn").on('click', function (e) {
            $.post("{{route('vocabulary.store')}}",
                {
                    "_token": "{{csrf_token()}}",
                    "kana_word": $("#kana_input").val(),
                    "viet_word": $("#viet_input").val(),
                    "lesson_id": "{{$lesson[0]->id}}"
                },
                function (data, status) {
                    if (status === 'success') {
                        $("#formInputWord").before("<tr id='row" + data.id + "'><td><input type='checkbox' name='word_id' value='" + data.id + "'></td><td>"
                            + data.kanji_word + "</td><td>" + data.kana_word + "</td><td>"
                            + data.viet_word + "</td><td>"
                            + "<a class='btn btn-primary' onclick='openEditModal(" + data.id + ")'>Edit</a></td></tr>");
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
            $("input:checkbox[name='word_id']:checked").each(function () {
                ids.push($(this).val());
            });
            $.post("{{route('vocabulary.destroy')}}",
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
            $.getJSON("{{route('vocabulary.index')}}" + "/" + id, function (data) {
                var kana_edit = $("#kana_edit");
                var viet_edit = $("#viet_edit");
                kana_edit.val(data.kana_word);
                viet_edit.val(data.viet_word);
                $("#editModal").modal();
                current_id = id;
            });
        }

        function saveEditedWord() {
            $.post("{{route('vocabulary.index')}}" + "/" + current_id,
                {
                    "_method": "PUT",
                    "_token": "{{csrf_token()}}",
                    "kana_word": $("#kana_edit").val(),
                    "viet_word": $("#viet_edit").val()
                },
                function (data, status) {
                    if (status === 'success') {
                        $("#row" + data.id).html(
                            "<td><input type='checkbox' name='word_id' value='" + data.id + "'></td><td>"
                            + data.kanji_word + "</td><td>" + data.kana_word + "</td><td>"
                            + data.viet_word + "</td><td><a class='btn btn-primary' onclick='openEditModal(" + data.id + ")'>Edit</a></td>"
                        )
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