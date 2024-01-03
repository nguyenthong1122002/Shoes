var answer = document.getElementsByClassName('contain-question__answer');
var icon = document.getElementsByClassName('icon');

function clickQuest(index) {
    if(answer[index].classList.contains('hidden')) {
        answer[index].classList.remove('hidden');
        icon[index].setAttribute('style', 'transform: rotate(-90deg);')
    } else {
        answer[index].classList.add('hidden');
        icon[index].setAttribute('style', 'transform: rotate(0);')
    }
}