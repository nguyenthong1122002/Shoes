function login(linkPage) {
    window.location = "dangnhap.php?linkpage="+linkPage;
}
function logout(linkPage) {
    window.location = "index.php?linkpage="+linkPage;
}
function nextPage(pageName) {
    window.location = pageName+".php";
}