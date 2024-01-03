var header1 = document.querySelector(".header__header-1");
var header2 = document.querySelector(".header__header-2");
window.addEventListener("scroll", myFunction);

var temp;
function myFunction() {
    temp = header2.getBoundingClientRect().top;
    if(temp <= -400) {
        header1.setAttribute("style", "top: 0");
    }
    else {
        header1.removeAttribute("style");
    }
}

function slidesContent3 (index) {
    var numbers = [0, 1, 2, 3, 4, 5, 6, 7]
    var slides = document.querySelector(".slides-contain__slides");
    var buttons = document.getElementsByClassName("button-slides__button");
    if(index == 0) {
        slides.setAttribute("style", "left: 0;");
    }
    if(index == 1) {
        slides.setAttribute("style", "left: -100%;");
    }
    if(index == 2) {
        slides.setAttribute("style", "left: -200%;");
    }
    if(index == 3) {
        slides.setAttribute("style", "left: -300%;");
    }
    if(index == 4) {
        slides.setAttribute("style", "left: -400%;");
    }
    if(index == 5) {
        slides.setAttribute("style", "left: -500%;");
    }
    if(index == 6) {
        slides.setAttribute("style", "left: -600%;");
    }
    if(index == 7) {
        slides.setAttribute("style", "left: -700%;");
    }

    for (var number in numbers) {
        if(buttons[number].classList.contains("selected") == true) {
            buttons[number].classList.remove("selected");
            buttons[number].classList.add("no-select");
            break;
        }
    }

    buttons[index].classList.remove("no-select");
    buttons[index].classList.add("selected");
}