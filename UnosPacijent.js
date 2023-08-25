function validateForm(){
    let BrojIstorijeBolesti = document.forms["pacijentForm"]["BrojIstorijeBolesti"].value;
    if(BrojIstorijeBolesti=="123"){
        alert("Name must be filled out with letters");
        return false;
    }
}