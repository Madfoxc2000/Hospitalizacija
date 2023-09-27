import{
    invalid,
  } from "./JsValidacije.js";

const korisnickoime = document.forms["prijavaForm"]["korisnickoIme"];
const sifra = document.forms["prijavaForm"]["sifra"];

korisnickoime.oninvalid = invalid;
korisnickoime.oninput = invalid;
sifra.oninvalid = invalid;
sifra.oninput = invalid;


