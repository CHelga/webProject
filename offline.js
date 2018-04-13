var id;

window.onload = function () {

    window.addEventListener('online', checkstatus);
    window.addEventListener('offline', checkstatus);

    checkstatus();
}

function checkstatus(event) {
    if (navigator.onLine) {

        if (window.localStorage.length != 0) {
            szinkronizalas();
        }
    }
}

function getRequestObject() {

    if (window.XMLHttpRequest)
        return (new XMLHttpRequest());
    else if (window.ActiveXObject)
        return (new ActiveXObject("Microsoft.XMLHTTP"));
    else
        return (null);
}

function modositas_lementese() {
    if (navigator.onLine) {
//        window.location="send_letter.php";
        id.open("POST", "send_letter.php", true);
        id.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var post = "id=" + sid + "&lsajat=" + ssajatid + "&luzenet=" + sluzenet;
        id.send(post);
    } else {
        var aktualisid = document.getElementById('felh').value;
        var sajatid = document.getElementById('felhasznalo').value;
        var uzenet = document.getElementById('myTextarea').value;

        localStorage.setItem("id", aktualisid);
        localStorage.setItem("lsajat", sajatid);
        localStorage.setItem("luzenet", uzenet);
        listLocalStorageContent();
    }
}


//online modba lepeskor feltoltjuk az adatbazisba a lokalis tarolo tartalmat, es a lokalis tarolot kiuritjuk
function szinkronizalas() {

    var sid = localStorage.getItem("id");
    var ssajatid = localStorage.getItem("lsajat");
    var sluzenet = localStorage.getItem("luzenet");

    id = getRequestObject();
    id.open("POST", "offline_send_letter.php", true);
    id.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var post = "id=" + sid + "&lsajat=" + ssajatid + "&luzenet=" + sluzenet;
    id.send(post);
    localStorage.clear();
    location.reload();
}
