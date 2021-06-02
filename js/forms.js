// Denne siden er utviklet av Raymond.  Sist endret 30.mai 2021
// Validere skjeamaer og bla gjennom knadidater

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

function sjekkDatoene() { // sjekk nominasjons- og valgperiode er gylidige fra valg form i valgadmin.php
    const f = document.forms["valgdato"];
    for (i = 1; i < f.length -1; i++) {
        if (f.elements[i].value < f.elements[i-1].value) {
            alert("Sjekk datoene!\nStartdatoene må vare før Sluttdatoene\nOg Nomineringsperioden må være avlusttet før Valgperionden starter");
            return false;
        }
    }
    return true;
}

class Kandidat {
    constructor (hvor, alt, navn, epost, informasjon) {
        this.hvor = hvor;
        this.alt = alt;
        this.navn = navn;
        this.epost = epost;
        this.informasjon = informasjon;
    }
    
}
/* let personer = new Array();

function addKandidater(hvor, alt, navn, epost, informasjon) {
    personer.push(new Kandidat(hvor, alt, navn, epost, informasjon));
    console.log(personer[0].epost);
} */

/* function visKandidat(index) {
    const kh = document.getElementById("kandidat_head");
    const kp = document.getElementById("kandidat_pic");
    const ki = document.getElementById("kandidat_info");

    kh.innerHTML = "kandidat head"; // personer[index].navn;
    kp.innerHTML = personer[index].hvor;
    ki.innerHTML = personer[index].informasjon;
} */

