@extends('layouts.master')

@section('content')
    <div class="jumbotron">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Class name</th>
                <th>Number of students</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($classes as $class)
                <tr id="class{{$class->id}}" class-name="{{$class->name}}" csrf-token="{{csrf_token()}}">
                    <td>{{$class->name}}</td>
                    <td>{{count($class->students)}}</td>
                    <td>
                        <a class="btn btn-success" href="{{route('lesson.test')}}?class_id={{$class->id}}">Test now</a>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{route('class.edit',$class->id)}}">Edit</a>
                        <a class="btn btn-danger" onclick="deleteClass({{$class->id}})">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('extra_js')
    <script>
        function deleteClass(id) {
            var row = $("#class" + id);
            var accept = confirm("This will delete " + row.attr('class-name') + "\n Are you sure to delete it?");
            var token = row.attr('csrf-token');
            {
                $.ajax({
                    type: 'DELETE',
                    url: '{{route('class.index')}}' + '/' + id,
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                    success: function () {
                        row.hide();
                        alert('Delete successfully!');
                    }
                });
            }
        }
    </script>
@endsection