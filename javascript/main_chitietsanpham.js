var boxSize = document.getElementsByClassName('list-size__size');
var buttonAddProductToCart = document.getElementsByClassName('option-product__button-add-cart inactive')[0];

function clickButtonRight() {
    var slide_now = document.getElementsByClassName('show')[0];
    var slide_next;

    if(slide_now.previousElementSibling == null) {
        var lenght_slide = document.getElementsByClassName("slides__slide").length;
        slide_next = document.getElementsByClassName('slides__slide')[lenght_slide - 1];
    } else {
        slide_next = slide_now.previousElementSibling;
    }

    slide_next.classList.add('show');
    slide_now.classList.add('slide-hide-right-to-left');
    slide_next.classList.add('slide-show-right-to-left');

    setTimeout(function() {
        slide_now.classList.remove('show');
        slide_now.classList.remove('slide-hide-right-to-left');
        slide_next.classList.remove('slide-show-right-to-left');
    }, 300)
}

function clickButtonLeft() {
    var slide_now = document.getElementsByClassName("show")[0];
    var slide_before;

    if(slide_now.nextElementSibling == null) {
        slide_before = document.getElementsByClassName("slides__slide")[0];
    }
    else {
        slide_before = slide_now.nextElementSibling;
    }
    slide_before.classList.add("show");
    slide_now.classList.add("slide-hide-left-to-right");
    slide_before.classList.add("slide-show-left-to-right");
    setTimeout(function() {
        slide_now.classList.remove("show");
        slide_now.classList.remove("slide-hide-left-to-right");
        slide_before.classList.remove("slide-show-left-to-right");
    }, 300)
}

function clickLink(index) {
    switch(index) {
        case 0:
            window.location = "giay_da_co_day_den_tuyen.php?idgiay=65";
            break;
        case 1:
            window.location = "giay_da_co_day_xam_nhe.php?idgiay=66";
            break;
        case 2:
            window.location = "giay_vai_co_day_nuoc_ngot.php?idgiay=67";
            break;
        case 3:
            window.location = "giay_vai_co_day_qua_do.php?idgiay=68";
            break;
        case 4:
            window.location = "giay_vai_co_day_tim_than.php?idgiay=69";
            break;
        case 5:
            window.location = "giay_vai_co_day_vang_nghe.php?idgiay=70";
            break;
        case 6:
            window.location = "giay_vai_co_day_xam_that_su.php?idgiay=71";
            break;
        case 7:
            window.location = "giay_vai_co_day_xanh_la_cay.php?idgiay=72";
            break;
        case 8:
            window.location = "giay_da_khong_day_da.php?idgiay=73";
            break;
        case 9:
            window.location = "giay_da_khong_day_xam_nhe.php?idgiay=74";
            break;
        case 10:
            window.location = "giay_vai_khong_day_nuoc_ngot.php?idgiay=75";
            break;
        case 11:
            window.location = "giay_vai_khong_day_qua_do.php?idgiay=76";
            break;
        case 12:
            window.location = "giay_vai_khong_day_tim_than.php?idgiay=77";
            break;
        case 13:
            window.location = "giay_vai_khong_day_vang_nghe.php?idgiay=78";
            break;
        case 14:
            window.location = "giay_vai_khong_day_xam_that_su.php?idgiay=79";
            break;
        case 15:
            window.location = "giay_vai_khong_day_xanh_la_cay.php?idgiay=80";
            break;
    }
}

function clickSize(index) {
    for(var i = 0 ; i < 11 ; ++i) {
        if(i != index) {
            boxSize[i].setAttribute('style', 'border: 1px solid var(--mau-chu-footer-hover);');
        }
    }
    boxSize[index].setAttribute('style', 'border: 3px solid var(--mau-den);');

    if(buttonAddProductToCart.classList.contains('inactive')) {
        buttonAddProductToCart.classList.remove('inactive');
    }
}

function clickButtonAddCart(idgiay, link) {
    var size = null;
    for(var i = 0 ; i < 11 ; ++i) {
        if(boxSize[i].getAttribute('style') == 'border: 3px solid var(--mau-den);') {
            size = i + 35;
            break;
        }
    }
    window.location = `themvaogiohang.php?idgiay=${idgiay}&size=${size}&link=${link}`;
}