function validateLettersOnly(inputtxt, inputName){
    var letters = /^[A-Za-z]+$/;

    if(inputtxt.value.match(letters)){
        return true;
    }
    else{
        alert("Please input alphabet characters only. \nNumbers & special characters are not allowed");
        document.getElementsByName(inputName)[0].value = "";
        return false;
    }
}

function validateNumericOnly(inputtxt, inputName){
    var numbers = /^[0-9]+$/;
    
    if(inputtxt.value.match(numbers)){
        return true;
    }
    else{
        alert('Please input numeric characters only. \nAlphabet & special characters are not allowed');
        document.getElementsByName(inputName)[0].value = "";
        return false;
    }
}

function validateEmail(mail, inputName){
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    
    if(mail.value.match(mailformat)){
        return true;
    }
    else{
        alert("You have entered an invalid email address!");
        document.getElementsByName(inputName)[0].value = "";
        return false;
    }
}

function validatePhoneNumber(inputtxt, inputName){
    var phoneno = /^\d{10}$/;
    if (inputtxt.value.match(phoneno)) {
        return true;
    }
    else{
        alert("Only 10 digits allows. \nAlphabet & special characters are not allowed");
        document.getElementsByName(inputName)[0].value = "";
        return false;
    }
}