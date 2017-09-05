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
                                    <label for="type" class="col-md-4 control-label">Lesson: </label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="lesson_selector" name="lesson_id">
                                            <option value="random">Random!</option>
                                            <option value="all" weight="1">Toàn bộ từ mới</option>
                                            @foreach($lessons as $lesson)
                                                <option weight="{{$lesson->weight}}"
                                                        value="{{$lesson->id}}">{{$lesson->name}}</option>
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
                <div class="btn btn-warning col-md-3 pull-right" id="skipButton" style="display: none">
                    Bỏ qua
                </div>

                <div class="col-md-4 btn btn-success" id="pass_count" style="display: none">Passed: 0</div>

                <div class="col-md-4" id="skipped_table_div" style="display: none;">
                    <table class="table table-hover">
                        <thead>
                        <tr class="danger">
                            <th id="skip_count">Skipped : 0</th>
                        </tr>
                        </thead>
                        <tbody id="skip_list">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2">
                <h1 id="timer">

                </h1>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
    <script>
        var student_selector = $("#student_selector");
        var lesson_selector = $("#lesson_selector");
        var word_selector = $("#word_selector");

        $("#generate_first_student").on("click", function (e) {
            e.preventDefault();

            student_selector.doneSelect = false;
            lesson_selector.doneSelect = false;
            word_selector.doneSelect = false;

            if (student_selector.val() === "random") {
                randomizeSelector(student_selector, false);
            } else {
                student_selector.doneSelect = true;
            }
            if (lesson_selector.val() === "random") {
                randomizeSelector(lesson_selector, true);
            } else {
                lesson_selector.doneSelect = true;
            }
            if (word_selector.val() === "random") {
                randomizeSelector(word_selector, false);
            } else {
                word_selector.doneSelect = true;
            }
        });

        $("#generate_next_student").on("click", function (e) {
            e.preventDefault();

            if (student_selector.val() !== "random") {
                $('option:selected', student_selector).remove();
            }

            student_selector.doneSelect = false;
            lesson_selector.doneSelect = false;
            word_selector.doneSelect = false;
            $('#pass_count').text("Passed: 0");

            if (student_selector.val() === "random") {
                randomizeSelector(student_selector, false);
            } else {
                student_selector.doneSelect = true;
            }
            if (lesson_selector.val() === "random") {
                randomizeSelector(lesson_selector, true);
            } else {
                lesson_selector.doneSelect = true;
            }
            if (word_selector.val() === "random") {
                randomizeSelector(word_selector, false);
            } else {
                word_selector.doneSelect = true;
            }
        });

        function randomizeSelector(selectObj, is_weighted) {
            var currentRun = 0;
            var maxRun = 100;

            var sumOfWeight = 0;
            var arrayWeightOfSelectObj = [];

            if (is_weighted) {
                for (var i = 1; i < selectObj.children().length; i++) {
                    var currentWeight = Number(selectObj.children()[i].getAttribute("weight"));
                    sumOfWeight += currentWeight;
                    arrayWeightOfSelectObj.push(currentWeight);
                }
            }

            var idOfInterval = setInterval(selectRandomStudent, 20);

            function selectRandomStudent() {
                var index;
                if (currentRun >= maxRun) {
                    clearInterval(idOfInterval);
                    selectObj.doneSelect = true;
                    if (student_selector.doneSelect && lesson_selector.doneSelect && word_selector.doneSelect)
                        congratulateLuckyStudent();
                } else {
                    if (is_weighted) {
                        currentRun++;
                        var randomedWeight = Math.floor(Math.random() * sumOfWeight);
                        for (var i = 0; i < arrayWeightOfSelectObj.length; i++) {
                            if (randomedWeight > arrayWeightOfSelectObj[i]) {
                                randomedWeight = randomedWeight - arrayWeightOfSelectObj[i];
                            } else {
                                selectObj.children().eq(i+1).prop('selected', true);
                                break;
                            }
                        }
                    } else {
                        currentRun++;
                        index = Math.floor((Math.random() * (selectObj.children().length - 1)) + 1);
                        selectObj.children().eq(index).prop('selected', true);
                    }
                }
            }
        }

        function congratulateLuckyStudent() {
            $("#congrat_note").html("Chúc mừng bạn " + $('option:selected', student_selector).html()
                + " đã trúng giải.<br><br>Phần thưởng của bạn là kiểm tra " + $('option:selected', lesson_selector).html());

            $("#generate_first_student").css("display", "none");
            $("#generate_next_student").css("display", "block");
            $('#pass_count').css("display", "block");
            $('#skipped_table_div').css("display", "block");

            var jsonUrl = "{{route('lesson.index')}}" + "/" + lesson_selector.val() + "?word_type=" + word_selector.val();
            var vocabularies = [];
            var word_type = '';
            $.getJSON(jsonUrl, function (data) {
                vocabularies = data['vocabularies'];
                word_type = data['wordType'];
                var carouselHtml = '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">' +
                    '<div class="carousel-inner"><div class="item active"><div class="alert alert-info flashcard">' +
                    'Press next to start</div></div>';
                for (var i = 0; i < vocabularies.length; i++) {
                    carouselHtml = carouselHtml + '<div class="item"><div class="alert alert-info flashcard">'
                        + vocabularies[i][word_type] + '</div></div>';
                }
                carouselHtml = carouselHtml + '<div class="item"><div class="alert alert-info flashcard">Welcome to the end, CHAMPION!</div></div>' +
                    '</div><a class="left carousel-control" href="#carousel-example-generic" data-slide="prev" id="prevCarousel" style="display: none">' +
                    '<span class="glyphicon glyphicon-chevron-left"></span></a>' +
                    '<a class="right carousel-control" href="#carousel-example-generic" data-slide="next" id="nextCarousel">' +
                    '<span class="glyphicon glyphicon-chevron-right"></span></a></div>';

                $("#testPlace").html(carouselHtml);
                $.getScript("{{asset('js/carousel-timer.js')}}");
            });
        }
    </script>
@endsection