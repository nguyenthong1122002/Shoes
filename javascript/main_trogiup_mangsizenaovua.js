var listItem = document.getElementsByClassName("list__item");
var content01 = document.getElementsByClassName("tab-content__content-1")[0];
var content02 = document.getElementsByClassName("tab-content__content-2")[0];
var content03 = document.getElementsByClassName("tab-content__content-3")[0];

function ClickTab (index) {
    for(var i = 0 ; i < 3 ; ++i) {
        if(listItem[i].classList.contains('checked-2')) {
            listItem[i].classList.remove('checked-2');
            if(i == 0) {
                content01.classList.remove('show');
            } else if(i == 1) {
                content02.classList.remove('show');
            } else {
                content03.classList.remove('show');
            }
            break;
        }
    }

    listItem[index].classList.add('checked-2');
    if(index == 0) {
        content01.classList.add('show');
    } else if(index == 1) {
        content02.classList.add('show');
    } else {
        content03.classList.add('show');
    }
}