var passed = 0;
var failure = [];
nextCarouselBtn = document.getElementById("nextCarousel");
prevCarouselBtn = document.getElementById("prevCarousel");
skipBtn = document.getElementById("skipButton");
testCarousel = $('.carousel');
nextTargetBtn = $("#generate_next_student");
skipBtn = $("#skipButton");
skipBtn.css("display", "block");
skipList = $("#skip_list");
skipCount = $("#skip_count");
var countInterval;

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
            clearInterval(countInterval);
        }
        // TODO: previous carousel handle
        // if (carousel_index > 0) {console.log(carousel_index)
        //     prevCarouselBtn.style.display = 'block';
        // }
    } else {
        skipBtn.css("display", "block");
    }
});

nextTargetBtn.on("click", function (e) {
    passed = 0;
    failure = [];
    $("#pass_count").text("Passed: " + passed);
    skipCount.text("Skipped: " + failure.length);
    skipBtn.css("display", "none");
    skipList.html("");
    clearInterval(countInterval);
});

function countDown() {
    var totalSec = 2 * 60;
    // Update the count down every 1 second
    countInterval = setInterval(function () {
        // Time calculations for days, hours, minutes and seconds
        var minutes = Math.floor((totalSec / 60));
        var seconds = Math.floor((totalSec % 60));

        // Output the result in an element with id="timer"
        document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

        // If the count down is over, write some text
        if (totalSec < 0) {
            clearInterval(countInterval);
            document.getElementById("timer").innerHTML = "TIME 'S UP!";
        }

        totalSec = totalSec - 1;
    }, 1000);
    document.getElementById("nextCarousel").removeEventListener('click', countDown);
    skipButton();
}

function skipButton() {
    skipBtn.on("click", function (e) {
        var word = testCarousel.find(".active").text();
        if ($.inArray(word, failure) === -1) {
            failure.push(word);
            skipCount.text("Skipped: " + failure.length);
            skipList.append('<tr class="danger"><td>' + word + '</td></tr>');
        }
        $("#nextCarousel").trigger("click");
        $("#pass_count").text("Passed: " + passed);
    });
}
