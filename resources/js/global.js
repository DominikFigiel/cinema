function setCookie(cname,cvalue) {
    var d = new Date();
    d.setTime(d.getTime() + (60*1000)); //minuta
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    location.reload();
}

function setSession(cname,cvalue) {
    //'<%Session["'+cname+'"] = "' + cvalue + '"; %>'
    //sessionStorage.setItem(cname, cvalue);
    //alert(sessionStorage.getItem(cname));
    //Page objp = new Page();
    //objp.Session[cname] = cvalue;

    location.reload();
}