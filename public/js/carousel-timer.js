var passed = 0;
var failure = [];
nextCarouselBtn = document.getElementById("nextCarousel");
prevCarouselBtn = document.getElementById("prevCarousel");
skipBtn = document.getElementById("skipButton");
testCarousel = $('.carousel');

testCarousel.carousel({
    interval: false
});

nextCarouselBtn.addEventListener('click', countDown);
testCarousel.bind('slide.bs.carousel', function (e) {
    var carousel_index = testCarousel.find('.active').index('.carousel .item');
    var carousel_length = testCarousel.find('.item').length;
    if (carousel_index > 0 && carousel_index < (carousel_length - 1)) {
        passed++;
        $("#pass_count").text("Passed: " + passed);
        if (carousel_index === (carousel_length - 2)) {
            nextCarouselBtn.style.visibility = 'hidden';
            skipBtn.unbind("click");
        }
        if (carousel_index > 0) {
            prevCarouselBtn.style.visibility = 'block';
        }
    } else {
        skipBtn.css("display", "hidden");
    }
});
// nextCarouselBtn.addEventListener('click', countSuccess);
// skipBtn.addEventListener('click', countFailure);

function countDown() {
    var totalSec = 2 * 60;
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
    document.getElementById("nextCarousel").removeEventListener('click', countDown);
    skipButton();
}

function skipButton() {
    skipBtn = $("#skipButton");
    skipBtn.css("display", "block");
    skipList = $("#skip_list");
    skipCount = $("#skip_count");

    skipBtn.on("click", function (e) {
        var word = testCarousel.find(".active").text();
        if ($.inArray(word, failure) === -1) {
            failure.push(word);
            skipCount.text("Skipped: " + failure.length);
            skipList.append('<tr class="danger"><td>' + word + '</td></tr>');
        }
        $("#nextCarousel").trigger("click");
        passed--;
        $("#pass_count").text(passed);
        // $("#pass_count").text(passed);
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