var places = [];
function addPlace (value) {
    places.push(value);
    console.log(places.length);
}

function clearPlaces () {
    places = [];
}

function setCookie(cname,cvalue) {
    var d = new Date();
    d.setTime(d.getTime() + (60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    location.reload();
}

function addCookieFor(cname, cvalue) {
    var value = getCookie(cname);
    if(value == null || value == "")
        value = cvalue;
    else
        value = value + "," + cvalue;
    setCookie(cname, value);
}

function deleteAllCookieFor(cname){
    setCookie(cname, "");
    location.reload();
}

function addAllPlacesCookieFor(cname){
    deleteAllCookieFor(cname);
    for(var i = 0; i < places.length; i++){
        addCookieFor(cname, places[i]);
    }
    location.reload();
}

function deleteCookieFor(cname, cvalue) {
    var value = getCookie(cname);
    if(value != null && value != ""){
        var array = value.split(",");
        for(var i = 0; i < array.length; i++){
            if((parseInt(cvalue)) == (parseInt(array[i]))){
                for(var j = i; j < array.length; j++){
                    array[j] = array[j+1];
                }
                break;
            }
        }
        value = "";
        var tmpArray = new Array();
        for(var i = 0; i < array.length-1; i++){
            if(value == null || value == "")
                value = array[i];
            else
                value = value + "," + array[i];
        }
    }
    setCookie(cname, value);
}

function getCookie(cname){
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
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

function searchReservation(firstName, lastName, email, mobilePhone) {
    firstName = document.getElementById(firstName).value;
    lastName = document.getElementById(lastName).value;
    email = document.getElementById(email).value;
    mobilePhone = document.getElementById(mobilePhone).value;
    setCookie('firstName', firstName);
    setCookie('lastName', lastName);
    setCookie('email', email);
    setCookie('mobilePhone', mobilePhone);
    location.reload();
}

function clearSearchReservation() {
    setCookie('firstName', '');
    setCookie('lastName', '');
    setCookie('email', '');
    setCookie('mobilePhone', '');
}