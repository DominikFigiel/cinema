function setCookie(cname,cvalue) {
    var d = new Date();
    d.setTime(d.getTime() + (60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    location.reload();
}

function setCookieDubbing(cname) {
    var d = new Date();
    d.setTime(d.getTime() + (60*60*1000));
    var expires = "expires=" + d.toGMTString();
    var checkBox = document.getElementById("dubbing");
    if(checkBox.checked)
        cvalue = 1;
    else
        cvalue = 0;
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    location.reload();
}