function ClickMenu(product_type) {
    var containBox = document.getElementsByClassName('contain__box');
    for(var i = 0 ; i < 4 ; ++i) {
        if(containBox[i].classList.contains('show')) {
            containBox[i].classList.remove('show');
            break;
        }
    }
    switch(product_type) {
        case 'giay-da-co-day': {
            containBox[0].classList.add('show');
            break;
        }
        case 'giay-vai-co-day': {
            containBox[1].classList.add('show');
            break;
        }
        case 'giay-da-khong-day': {
            containBox[2].classList.add('show');
            break;
        }
        case 'giay-vai-khong-day': {
            containBox[3].classList.add('show');
            break;
        }
    }
}

function ClickColor(product_type, color) {
    var boxImageProduct = document.getElementsByClassName('box__image-product');
    var _color = document.getElementsByClassName('colors__color');
    var nameProduct = document.getElementsByClassName('name-product');
    var linkProduct = document.getElementsByClassName('link-product');

    if(product_type === 'giay-vai-co-day') {
        for(var i = 0 ; i < 6 ; ++i) {
            if(_color[i].classList.contains('check')) {
                _color[i].classList.remove('check');
                break;
            }
        }
        switch(color) {
            case 'nuoc-ngot': {
                _color[0].classList.add('check');
                boxImageProduct[2].setAttribute('style', 'background-image: url(./images/images_san-pham/giay_vai_co_day/mau_nuoc_ngot/1500x1000_dm_nuoc-ngot_profile.webp);');
                nameProduct[0].innerHTML = 'giày vải Nước ngọt';
                linkProduct[0].setAttribute('href', 'giay_vai_co_day_nuoc_ngot.php?idgiay=67');
                break;
            }
            case 'qua-do': {
                _color[1].classList.add('check');
                boxImageProduct[2].setAttribute('style', 'background-image: url(./images/images_san-pham/giay_vai_co_day/mau_qua_do/1500x1000_DM_qua-do_profile.webp);');
                nameProduct[0].innerHTML = 'giày vải Quá đỏ';
                linkProduct[0].setAttribute('href', 'giay_vai_co_day_qua_do.php?idgiay=68');
                break;
            }
            case 'tim-than': {
                _color[2].classList.add('check');
                boxImageProduct[2].setAttribute('style', 'background-image: url(./images/images_san-pham/giay_vai_co_day/mau_tim_than/1500x1000_DM_tim-than_profile.webp);');
                nameProduct[0].innerHTML = 'giày vải Tím than';
                linkProduct[0].setAttribute('href', 'giay_vai_co_day_tim_than.php?idgiay=69');
                break;
            }
            case 'vang-nghe': {
                _color[3].classList.add('check');
                boxImageProduct[2].setAttribute('style', 'background-image: url(./images/images_san-pham/giay_vai_co_day/mau_vang_nghe/1500x1000_vang-nghe_doi-moi_profile.webp);');
                nameProduct[0].innerHTML = 'giày vải Vàng nghệ';
                linkProduct[0].setAttribute('href', 'giay_vai_co_day_vang_nghe.php?idgiay=70');
                break;
            }
            case 'xam-that-su': {
                _color[4].classList.add('check');
                boxImageProduct[2].setAttribute('style', 'background-image: url(./images/images_san-pham/giay_vai_co_day/mau_xam_that_su/1500x1000_DM_vai-xam-that-su_profile.webp);');
                nameProduct[0].innerHTML = 'giày vải Xám thật sự';
                linkProduct[0].setAttribute('href', 'giay_vai_co_day_xam_that_su.php?idgiay=71');
                break;
            }
            case 'xanh-la-cay': {
                _color[5].classList.add('check');
                boxImageProduct[2].setAttribute('style', 'background-image: url(./images/images_san-pham/giay_vai_co_day/mau_xanh_la_cay/1500x1000_xanh-la-cay_doi-moi_profile.webp);');
                nameProduct[0].innerHTML = 'giày vải Xanh lá cây';
                linkProduct[0].setAttribute('href', 'giay_vai_co_day_xanh_la_cay.php?idgiay=72');
                break;
            }
        }
    } else if(product_type === 'giay-vai-khong-day') {
        for(var i = 6 ; i < 12 ; ++i) {
            if(_color[i].classList.contains('check')) {
                _color[i].classList.remove('check');
                break;
            }
        }
        switch(color) {
            case 'nuoc-ngot': {
                _color[6].classList.add('check');
                boxImageProduct[5].setAttribute('style', 'background-image: url(./images/images_san-pham/giay_vai_khong_day/mau_nuoc_ngot/1500x1000_dt_nuoc-ngot_profile.webp);');
                nameProduct[1].innerHTML = 'giày vải Nước ngọt';
                linkProduct[1].setAttribute('href', 'giay_vai_khong_day_nuoc_ngot.php?idgiay=75');
                break;
            }
            case 'qua-do': {
                _color[7].classList.add('check');
                boxImageProduct[5].setAttribute('style', 'background-image: url(./images/images_san-pham/giay_vai_khong_day/mau_qua_do/1500x1000_DT_qua-do_profile.webp);');
                nameProduct[1].innerHTML = 'giày vải Quá đỏ';
                linkProduct[1].setAttribute('href', 'giay_vai_khong_day_qua_do.php?idgiay=76');
                break;
            }
            case 'tim-than': {
                _color[8].classList.add('check');
                boxImageProduct[5].setAttribute('style', 'background-image: url(./images/images_san-pham/giay_vai_khong_day/mau_tim_than/1500x1000_DT_tim-than_profile.webp);');
                nameProduct[1].innerHTML = 'giày vải Tím than';
                linkProduct[1].setAttribute('href', 'giay_vai_khong_day_tim_than.php?idgiay=77');
                break;
            }
            case 'vang-nghe': {
                _color[9].classList.add('check');
                boxImageProduct[5].setAttribute('style', 'background-image: url(./images/images_san-pham/giay_vai_khong_day/mau_vang_nghe/1500x1000_DT_vang-nghe_profile.webp);');
                nameProduct[1].innerHTML = 'giày vải Vàng nghệ';
                linkProduct[1].setAttribute('href', 'giay_vai_khong_day_vang_nghe.php?idgiay=78');
                break;
            }
            case 'xam-that-su': {
                _color[10].classList.add('check');
                boxImageProduct[5].setAttribute('style', 'background-image: url(./images/images_san-pham/giay_vai_khong_day/mau_xam_that_su/1500x1000_DT_vai-xam-that-su_profile.webp);');
                nameProduct[1].innerHTML = 'giày vải Xám thật sự';
                linkProduct[1].setAttribute('href', 'giay_vai_khong_day_xam_that_su.php?idgiay=79');
                break;
            }
            case 'xanh-la-cay': {
                _color[11].classList.add('check');
                boxImageProduct[5].setAttribute('style', 'background-image: url(./images/images_san-pham/giay_vai_khong_day/mau_xanh_la_cay/1500x1000_xanh-la-cay_doi-thuong_profile.webp);');
                nameProduct[1].innerHTML = 'giày vải Xanh lá cây';
                linkProduct[1].setAttribute('href', 'giay_vai_khong_day_xanh_la_cay.php?idgiay=80');
                break;
            }
        }
    }
}