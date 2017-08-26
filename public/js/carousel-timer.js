$('.carousel').carousel({
    interval: false
});

var success = 0;
var failure = 0;
startTimerBtn = document.getElementById("startTimer");
skipBtn = document.getElementById("skipButton");

function nextCaroulse(maxWord) {
    startTimerBtn.addEventListener('click', countDown);
    startTimerBtn.addEventListener('click', countSuccess);
    skipBtn.addEventListener('click', countFailure);
    alert("success:" + success + ", failure: " + failure);
}

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
        $("#startTimer").trigger("click");
    });
}

function countSuccess() {
    success++;
}

function countFailure() {
    failure++;
}