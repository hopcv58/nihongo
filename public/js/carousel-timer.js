var total = -1;
var failure = [];
startTimerBtn = document.getElementById("startTimer");
skipBtn = document.getElementById("skipButton");
testCarousel = $('.carousel');

testCarousel.carousel({
    interval: false
});

startTimerBtn.addEventListener('click', countDown);
testCarousel.bind('slide.bs.carousel', function (e) {
    console.log('slide event!');
});
// startTimerBtn.addEventListener('click', countSuccess);
// skipBtn.addEventListener('click', countFailure);

function countDown() {
    var totalSec = 0.1 * 60;
    // Update the count down every 1 second
    var x = setInterval(function () {
        // Time calculations for days, hours, minutes and seconds
        var minutes = Math.floor((totalSec / 60));
        var seconds = Math.floor((totalSec % 60));

        // Output the result in an element with id="timer"
        document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

        // If the count down is over, write some text
        if (totalSec < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "TIME 'S UP!";
        }

        totalSec = totalSec - 1;
    }, 1000);
    document.getElementById("startTimer").removeEventListener('click', countDown);
    skipButton();
}

function skipButton() {
    skipBtn = $("#skipButton");
    skipBtn.css("display", "block");
    skipBtn.on("click", function (e) {
        var word = testCarousel.find(".active").text();
        if($.inArray(word, failure) === -1){
            failure.push(word);
        }
        $("#startTimer").trigger("click");
    });
}

// function countSuccess() {
//     success++;
//     $("#pass_count").text("Passed: " + success);
// }
//
// function countFailure() {
//     $("#skip_count").text("Skipped: " + failure);
//     failure++;
// }