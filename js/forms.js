// Denne siden er utviklet av Raymond.  Sist endret 15.november 2020

// sjekk at passord er rigtig skrevet 
function passordsjekk() {
    const p1 = document.getElementById("passord1").value;
    const p2 = document.getElementById("passord2").value;
    const p1felt = document.getElementById("passord1");

    if (p1 != p2) {
        alert("passord matcher ikke!");
        p1felt.focus();
        return false;
    }
}

//vis melding om nominasjonen
function nominasjonsmelding() {
    setTimeout(vismelding(), 3000);
}

function vismelding() {
    let meld = document.getElementById("nominasjon").value;
    alert(meld);
}

function formtest() {
    alert("Hello there!");
}

function kopitr(radnr) {
    // alert(radnr);
    // hent verdier i raden 
    var rad = document.getElementsByClassName("rad".concat(radnr));
    var v = rad[0].innerHTML.replace(/\<td\>/g, "*");
    v = v.replace(/\<\/td\>/g, "");
   
    // console.log(typeof(v));
    // console.log(v);
    // console.log(v.replace(/\<td\>|\<\/td\>/g, "*"));

    var verdier = v.split("*");  //gjør om til array
    // console.log(verdier);


    var f = document.forms["valgdato"];
    for (i = 0; i < f.length-1; i++) {
        f.elements[i].value = verdier[i+2];
    }

   
/* 
    for (i = 0; i < f.length-1; i++) {
        f.elements[i].value = verdier[i+1];
    }
     */
}