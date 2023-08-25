const povredjen = document.getElementById('Povredjen');
const nePovredjen = document.getElementById('NePovredjen');
const povreda = document.getElementById('UzrokPovrede');

const vrstaOtpusta = document.getElementById('VrstaOtpusta');
const osnovniUzrokSmrti = document.getElementById('OsnovniUzrokSmrti');
const obdukovan = document.getElementById('Obdukovan'); 
const neObdukovan = document.getElementById('NeObdukovan'); 

povredjen.addEventListener('click', function () {changeUzrokPovredeState(false)});
nePovredjen.addEventListener('click',function() {changeUzrokPovredeState(true)});

vrstaOtpusta.addEventListener('change', function(){changeElementsAboutDeathStates(vrstaOtpusta.value)});

function changeUzrokPovredeState (bool) {
povreda.disabled = bool;
}

function changeElementsAboutDeathStates (string){
 if (string == 6){
    osnovniUzrokSmrti.disabled = false;
    obdukovan.disabled=false;
    neObdukovan.disabled=false;
 }
 else{
    osnovniUzrokSmrti.disabled = true;
    obdukovan.disabled = true;
    neObdukovan.disabled = true;
 }
}