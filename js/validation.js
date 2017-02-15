function verifUser(login) {
    $i = document.getElementById('info');
    if (login.value == '') {
        $i.innerHTML = '';
    } else {
        obAjax = new creationObjetXMLhttpRequest();
        args = "login=" + login.value;
        obAjax.open('POST', 'control.php', true);
        obAjax.setRequestHeader("content-type", 'application/x-www-form-urlencoded');
        obAjax.setRequestHeader("content-length", args.length);
        obAjax.onreadystatechange = traitementResultat;
        obAjax.send(args);
    }
}
function creationObjetXMLhttpRequest() {

    try {
        var requete = new XMLHttpRequest();
    } catch (e1) {
        try {
            var requete = new ActionXobject("Msxml2.XMLHTTP");
            // POUR IE < 5
        } catch (e2) {

            try {
                var requete = new ActiveXobject("Microsoft.XMLHTTP");
                // POUR IE 6 <
            } catch (e3) {
                return false;
            }
        }
    }
    return requete;
}


function traitementResultat() {

    if (this.readyState == 4) {

        if (this.status == 200) {

            if (this.responseText != '') {
                $i.innerHTML = this.responseText;
            }
        }
    }
}