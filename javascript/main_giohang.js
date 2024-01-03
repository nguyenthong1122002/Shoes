var radio = document.getElementsByClassName('radio');
var buttonUpdate = document.getElementsByClassName('body__button-update')[0];
var inputSoLuong = document.getElementsByClassName('inputSoLuong')[0];

function clickRadio(value, index) {
    if(index == 0) {
        radio[0].checked = true;
        radio[1].checked = false;
    } else if(index == 1) {
        radio[0].checked = false;
        radio[1].checked = true;
    }   
    window.location = `giohang.php?phi=${value}`;
}

function clickButtonDeleteProduct(idAccout, idGiay, idSize) {
    window.location = `xu_li_xoa_trong_gio_hang.php?idaccount=${idAccout}&idgiay=${idGiay}&idsize=${idSize}`;
}

function changeValue() {
    buttonUpdate.classList.add('active-button-update');
}

function clickButtonUpdate(idAccount, idGiay, idSize) {
    var soLuong = inputSoLuong.value;
    window.location = `cap_nhat_gio_hang.php?idaccount=${idAccount}&idgiay=${idGiay}&idsize=${idSize}&soluong=${soLuong}`;
}