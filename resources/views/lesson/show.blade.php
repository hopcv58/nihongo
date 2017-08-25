@extends('layouts.master')

@section('content')
    <h3>Test</h3>
    <select id="word_selector">
        <option>Kanji word</option>
        <option>Kana word</option>
        <option>Viet word</option>
    </select>
    <div class="exmaple">
        <div class="col-md-8">
            <div class="jumbotron">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="alert alert-info flashcard">
                                Press next to start
                            </div>
                        </div>
                        @foreach($vocabularies as $vocabulary)
                            <div class="item">
                                <div class="alert alert-info flashcard">
                                    {{$vocabulary[$wordType]}}
                                </div>
                            </div>
                        @endforeach
                        <div class="item">
                            <div class="alert alert-info flashcard">
                                Welcome to the end, CHAMPION!
                            </div>
                        </div>
                    </div>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"
                       id="startTimer">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h1 id="timer">

            </h1>
        </div>
    </div>
@endsection

@section('extra_js')
    <script>
        $('.carousel').carousel({
            interval: false
        });
    </script>
    <script>
        document.getElementById("startTimer").addEventListener("click", countDown);

        function countDown() {
            var totalSec = 0.1 * 60;
            // Update the count down every 1 second
            var x = setInterval(function () {
                // Time calculations for days, hours, minutes and seconds
                var minutes = Math.floor((totalSec / 60));
                var seconds = Math.floor((totalSec % 60));

                // Output the result in an element with id="demo"
                document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

                // If the count down is over, write some text
                if (totalSec < 0) {
                    clearInterval(x);
                    document.getElementById("timer").innerHTML = "TIME 'S UP!";
                }

                totalSec = totalSec - 1;
            }, 1000);
            document.getElementById("startTimer").removeEventListener('click', countDown);
        }
    </script>
@endsection