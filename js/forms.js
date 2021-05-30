// Denne siden er utviklet av Raymond.  Sist endret 30.mai 2021

// sjekk at passord er rigtig skrevet 
function passordsjekk() {
    const p1 = document.getElementById("password").value;
    const p2 = document.getElementById("passord2").value;
    const p1felt = document.getElementById("password");

    if (p1 != p2) {
        alert("passord matcher ikke!");
        p1felt.focus();
        return false;
    }
}

//vis melding om nominasjonen funker ikke
/* function nominasjonsmelding() {
    setTimeout(vismelding(), 3000);
}

function vismelding() {
    let meld = document.getElementById("nominasjon").value;
    alert(meld);
} */

/* ## kun 1 valg ikke lenger nødvending? */
/* function kopitr(radnr) { //kopi valg data fra tabellen til form
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
}  */

function sjekkDatoene() { // sjekk nominasjons- og valgperiode er gylidige fra valg form i valgadmin.php
    // datoene = new Array(4);
    const f = document.forms["valgdato"];
    for (i = 1; i < f.length -1; i++) {
        // alert(f.querySelector("label[for=" + f.elements[i].id.textContent )
        // alert(f.elements[i].value);
        // console.log(f.elements[i].value);
        if (f.elements[i].value < f.elements[i-1].value) {
            // var l1 = f.querySelector('label[for=' + f.elements[i].id + ']');
            // var l2 = f.querySelector('label[for=' + f.elements[i-1].id + ']');
            alert("Sjekk datoene!\nStartdatoene må vare før Sluttdatoene\nOg Nomineringsperioden må være avlusttet før Valgperionden starter");
            return false;
        }
    }
    return true;
}