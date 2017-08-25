@extends('layouts.master')

@section('content')
    <h3>Test</h3>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Xổ số kiến thiết lớp học</h4></div>
                    <div class="panel-body">
                        <div class="row">
                            <form class="form-horizontal" method="get" action="{{route('lesson.show',2)}}">
                                {{--Student--}}
                                <div class="form-group col-md-6">
                                    <label for="type" class="col-md-4 control-label">Student: </label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="student_selector" name="student_id">
                                            <option value="random">Random!</option>
                                            @foreach($students as $student)
                                                <option value="{{$student->id}}">{{$student->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--Class--}}
                                <div class="form-group col-md-6">
                                    <label for="type" class="col-md-4 control-label">Class: </label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="class_selector" name="lesson_id">
                                            <option value="random">Random!</option>
                                            @foreach($lessons as $lesson)
                                                <option value="{{$lesson->id}}">{{$lesson->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--Word type--}}
                                <div class="form-group col-md-6">
                                    <label for="type" class="col-md-4 control-label">Word type: </label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="word_selector" name="word_type">
                                            <option value="random">Random!</option>
                                            @foreach($wordTypes as $key => $wordType)
                                                <option value="{{$key}}">{{$wordType}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="col-md-offset-3 col-md-6">
                                        <button class="btn btn-primary" id="generate_first_student">
                                            Generate random
                                        </button>
                                        <button class="btn btn-primary" id="generate_next_student"
                                                style="display: none">
                                            Next target
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <hr>
                        <h4 class="" id="congrat_note"></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="jumbotron">
                    <div id="testPlace">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
    <script>
        var student_selector = $("#student_selector");
        var class_selector = $("#class_selector");
        var word_selector = $("#word_selector");

        $("#generate_first_student").on("click", function (e) {
            e.preventDefault();

            student_selector.doneSelect = false;
            class_selector.doneSelect = false;
            word_selector.doneSelect = false;

            if (student_selector.val() === "random") {
                randomizeSelector(student_selector);
            }
            if (class_selector.val() === "random") {
                randomizeSelector(class_selector);
            }
            if (word_selector.val() === "random") {
                randomizeSelector(word_selector);
            }
        });

        $("#generate_next_student").on("click", function (e) {
            e.preventDefault();

            $('option:selected', student_selector).remove();

            student_selector.doneSelect = false;
            class_selector.doneSelect = false;
            word_selector.doneSelect = false;

            if (student_selector.val() === "random") {
                randomizeSelector(student_selector);
            } else {
                student_selector.doneSelect = true;
            }
            if (class_selector.val() === "random") {
                randomizeSelector(class_selector);
            } else {
                class_selector.doneSelect = true;
            }
            if (word_selector.val() === "random") {
                randomizeSelector(word_selector);
            } else {
                word_selector.doneSelect = true;
            }
        });

        function randomizeSelector(selectObj) {
            var currentTime = 0;
            var maxTime = 100;

            var idOfInterval = setInterval(selectRandomStudent, 20);

            function selectRandomStudent() {
                if (currentTime >= maxTime) {
                    clearInterval(idOfInterval);
                    selectObj.doneSelect = true;
                    if (student_selector.doneSelect && class_selector.doneSelect && word_selector.doneSelect)
                        congratulateLuckyStudent();
                } else {
                    currentTime++;
                    var index = Math.floor((Math.random() * (selectObj.children().length - 1)) + 1);
                    selectObj.children().eq(index).prop('selected', true);
                }
            }
        }

        function congratulateLuckyStudent() {
            $("#congrat_note").html("Chúc mừng bạn " + $('option:selected', student_selector).html()
                + " đã trúng giải.<br><br>Phần thưởng của bạn là kiểm tra "
                + $('option:selected', class_selector).html());
            $("#generate_first_student").css("display", "none");
            $("#generate_next_student").css("display", "block");
            $("#testPlace").html('<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">\n' +
                '<div class="carousel-inner"><div class="item active"><div class="alert alert-info flashcard">' +
                'Press next to start</div></div>' +
                    @foreach($vocabularies as $vocabulary)
                        '<div class="item"><div class="alert alert-info flashcard">' + '{{$vocabulary[$column]}}' + '</div></div>' +
                    @endforeach
                        '<div class="item"><div class="alert alert-info flashcard">Welcome to the end, CHAMPION!</div></div>' +
                '</div><a class="right carousel-control" href="#carousel-example-generic" data-slide="next" id="startTimer">' +
                '<span class="glyphicon glyphicon-chevron-right"></span></a></div>')
        }
    </script>
@endsection