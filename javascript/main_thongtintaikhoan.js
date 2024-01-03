var containerBox = document.getElementsByClassName('container__box');
var listItem = document.getElementsByClassName('list__item');

var groupInfoInput = document.getElementsByClassName('group-info__input');
var groupInfoButtonEdit = document.getElementsByClassName('group-info__button-edit');
var groupInfoButtonSave = document.getElementsByClassName('group-info__button-save');

var inputFileChangeAvatar = document.getElementById('avatar__input-file');

var containerNotice = document.getElementsByClassName('container__notice')[0];
var validImageType = ['image/jpg', 'image/jpeg', 'image/png'];
const boxShowAvatar = document.getElementById('box__show-avatar');
const showAvatar = document.getElementById('show-avatar__avatar');
const range = document.getElementById('box__range');
var boxChangeAvatar = document.getElementsByClassName('body__background')[0];

var valueRange;
var xMouseDown;
var yMouseDown;
var widthAvatar;
var heightAvatar;

var zoomChuan;

const inputWidth = document.getElementById('width');
const inputHeight = document.getElementById('height');
const inputLeft = document.getElementById('left');
const inputTop = document.getElementById('top');

function clickMenu(index) {
    for(var i = 0 ; i < 2 ; ++i) {
        if(i != index && containerBox[i].classList.contains('show')) {
            containerBox[i].classList.remove('show');
            listItem[i].classList.remove('check');
            break;
        }
    }
    containerBox[index].classList.add('show');
    listItem[index].classList.add('check');
}

function clickButtonEdit(index, value) {
    for(var i = 0 ; i < 4 ; ++i) {
        groupInfoButtonEdit[i].classList.add('display-none');
    }
    if(index == 1) {
        groupInfoInput[2].classList.add('edit');
    } else if(index == 2) {
        groupInfoInput[3].classList.add('edit');
    } else if(index == 3){
        groupInfoInput[4].classList.add('edit');
    } else {
        groupInfoInput[index].classList.add('edit');
    }
    groupInfoButtonSave[index].classList.remove('display-none');
}
function clickButtonSave(index) {
    for(var i = 0 ; i < 4 ; ++i) {
        groupInfoButtonEdit[i].classList.remove('display-none');
    }
    if(index == 1) {
        groupInfoInput[2].classList.remove('edit');
    } else if(index == 2) {
        groupInfoInput[3].classList.remove('edit');
    } else {
        groupInfoInput[index].classList.remove('edit');
    }
    groupInfoButtonSave[index].classList.add('display-none');
}

function loadNoticeThongtintaikhoan() {
    if(containerNotice.textContent != "") {
        containerNotice.classList.add('show-notice');
    } else {
        containerNotice.classList.remove('show-notice');
    }
}

function clickButtonInputFile() {
    var buttonInputFile = document.getElementById('avatar__input-file');
    // var boxChangeAvatar = document.getElementsByClassName('body__background')[0];
    // var buttonSubmitChangeAvatar = document.getElementById('avatar__input-submit');

    // boxChangeAvatar.classList.remove('body__background-display-none');
    buttonInputFile.click();
    // buttonSubmitChangeAvatar.click();
}
function clickButtonCancelChangeAvatar() {
    boxChangeAvatar.classList.add('body__background-display-none');
    window.location = "thongtintaikhoan.php";
}

inputFileChangeAvatar.addEventListener('change', function(e) {
    const files = e.target.files
    const file = files[0];
    const fileType = file['type'];

    if(validImageType.includes(fileType)) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(file);

        fileReader.onload = function() {
            const url = fileReader.result;
            boxChangeAvatar.classList.remove('body__background-display-none');
            showAvatar.src = url;

            widthAvatar = showAvatar.width;
            heightAvatar = showAvatar.height;
    
            if(widthAvatar >= heightAvatar) {
                // showAvatar.style.setProperty('height', '350px');
                showAvatar.height = 350;
                widthAvatar = showAvatar.width;
                heightAvatar = 350;
                zoomChuan = "height";
            } else if(widthAvatar < heightAvatar) {
                // showAvatar.style.setProperty('width', '350px');
                showAvatar.width = 350;
                widthAvatar = 350;
                heightAvatar = showAvatar.height;
                zoomChuan = "width";
            }

            inputWidth.value = showAvatar.width;
            inputHeight.value = showAvatar.height;
            inputLeft.value = showAvatar.offsetLeft;
            inputTop.value = showAvatar.offsetTop;
        }

    }
})

// PHẦN CODE ĐIỀU CHỈNH AVATAR
function getValueRange(value) {
    valueRange = value;
}
range.addEventListener('mousedown', () => {
    range.addEventListener('mousemove', zoom);
});
window.addEventListener('mouseup', () => {
    range.removeEventListener('mousemove', zoom);
});
function zoom() {
    // showAvatar.style.setProperty('width', `${widthAvatar + 3 * valueRange}px`);
    // showAvatar.style.setProperty('height', `${heightAvatar + 3 * valueRange}px`);
    if(zoomChuan == "width") {
        showAvatar.width = widthAvatar + 3 * valueRange;
    } else if(zoomChuan == "height") {
        showAvatar.height = heightAvatar + 3 * valueRange;
    }

    if(showAvatar.offsetLeft <= -(showAvatar.width - 350)) {
        showAvatar.style.setProperty('left', `${-(showAvatar.width - 350)}px`);
    }
    if(showAvatar.offsetTop <= -(showAvatar.height - 350)) {
        showAvatar.style.setProperty('top', `${-(showAvatar.height - 350)}px`);
    }

    inputWidth.value = showAvatar.width;
    inputHeight.value = showAvatar.height;
    inputLeft.value = showAvatar.offsetLeft;
    inputTop.value = showAvatar.offsetTop;
}

showAvatar.addEventListener('mousedown', (e) => {
    xMouseDown = e.clientX - showAvatar.offsetLeft;
    yMouseDown = e.clientY - showAvatar.offsetTop;
    boxShowAvatar.addEventListener('mousemove', update);
});
boxShowAvatar.addEventListener('mouseup', () => {
    boxShowAvatar.removeEventListener('mousemove', update);
    showAvatar.style.setProperty('left', `${showAvatar.offsetLeft}px`);
    showAvatar.style.setProperty('top', `${showAvatar.offsetTop}px`);
});
function update(e) {
    showAvatar.style.setProperty('left', `${e.clientX - xMouseDown}px`);
    showAvatar.style.setProperty('top', `${e.clientY - yMouseDown}px`);

    
    if(showAvatar.offsetLeft >= 0) {
        showAvatar.style.setProperty('left', '0px');
    }
    if(showAvatar.offsetLeft <= -(showAvatar.width - 350)) {
        showAvatar.style.setProperty('left', `${-(showAvatar.width - 350)}px`);
    }
    if(showAvatar.offsetTop >= 0) {
        showAvatar.style.setProperty('top', '0px');
    }
    if(showAvatar.offsetTop <= -(showAvatar.height - 350)) {
        showAvatar.style.setProperty('top', `${-(showAvatar.height - 350)}px`)
    }
    
    inputWidth.value = showAvatar.width;
    inputHeight.value = showAvatar.height;
    inputLeft.value = showAvatar.offsetLeft;
    inputTop.value = showAvatar.offsetTop;
}