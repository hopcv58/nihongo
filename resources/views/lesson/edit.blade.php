@extends('layouts.master')

@section('content')
    <h3>{{$vocabularies[0]->lessons->name}}</h3>
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
                <td><a href="#" class="btn btn-info" id="addWordBtn">Add new</a></td>
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
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('extra_js')
    <script>
        $("#addWordBtn").on('click', function (e) {
            $.post("{{route('vocabulary.store')}}",
                {
                    "_token": "{{csrf_token()}}",
                    "kana_word": $("#kana_input").val(),
                    "viet_word": $("#viet_input").val(),
                    "lesson_id": "{{$vocabularies[0]->lessons->id}}"
                },
                function (data, status) {
                    if (status === 'success') {
                        $("#formInputWord").before("<tr><td><input type='checkbox' name='word_id' value='" + data.id + "'></td><td>"
                            + data.kanji_word + "</td><td>" + data.kana_word + "</td><td>"
                            + data.viet_word + "</td><td><a class='btn btn-danger'>Delete</a>"
                            + "<a class='btn btn-primary'>Edit</a></td></tr>");
                    } else {
                        alert(data);
                    }
                }
            );
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
                    }
                }
            );
        });

        function openEditModal(id) {
            $("#editModal").modal();
        }
    </script>
@endsection