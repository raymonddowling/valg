// Denne siden er utviklet av Raymond.  Sist endret 15.november 2020
//22feb21

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

function kopitr(radnr) {
    // hent verdier i raden 
    const rad = document.getElementsByClassName("rad".concat(radnr));
    let v = rad[0].innerHTML.replace(/\<td\>/g, "");
    v = v.replace(/\<\/td\>/g, "*");
   
    // console.log(typeof(v));
    // console.log(v);
    // console.log(v.replace(/\<td\>|\<\/td\>/g, "*"));

    const verdier = v.split("*");  //gjør om til array
    console.log(verdier);

    const f = document.forms["valgdato"];
    for (i = 0; i < f.length-1; i++) { // Tar ikke med submit-knappen
        f.elements[i].value = verdier[i+1];
    }
    visValgform(0,1);
}

function visValgform(head, form) {
    const valgforms = document.getElementsByClassName("valgform");
    valgforms[head].style.display = "flex";
    valgforms[form].style.display = "flex";
}
