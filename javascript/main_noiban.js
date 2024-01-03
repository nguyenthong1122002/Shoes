function slideMoveRightToLeft() {
    var slide_now = document.getElementsByClassName("active")[0];
    var slide_next;

    if(slide_now.nextElementSibling == null) {
        slide_next = document.getElementsByClassName("slides__image")[0];
    }
    else {
        slide_next = slide_now.nextElementSibling;
    }
    slide_next.classList.add("active");
    slide_now.classList.add("disappear-right-to-left");
    slide_next.classList.add("appear-right-to-left");
    setTimeout(function() {
        slide_now.classList.remove("active");
        slide_now.classList.remove("disappear-right-to-left");
        slide_next.classList.remove("appear-right-to-left");
    }, 300)
}

function slideMoveLeftToRight() {
    var slide_now = document.getElementsByClassName("active")[0];
    var slide_before;

    if(slide_now.previousElementSibling == null) {
        var length_slide = document.getElementsByClassName("slides__image").length;
        slide_before = document.getElementsByClassName("slides__image")[length_slide - 1];
    }
    else {
        slide_before = slide_now.previousElementSibling;
    }
    slide_before.classList.add("active");
    slide_now.classList.add("disappear-left-to-right");
    slide_before.classList.add("appear-left-to-right");
    setTimeout(function() {
        slide_now.classList.remove("active");
        slide_now.classList.remove("disappear-left-to-right");
        slide_before.classList.remove("appear-left-to-right");
    }, 300)
}