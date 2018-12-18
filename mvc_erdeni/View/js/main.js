function passwordValidation() {
    var pass1 = (document.getElementsByName("reg_pass")[0]).value;
    var pass2 = (document.getElementsByName("reg_repeat")[0]).value;
    var ok = true;
    if (pass1 != pass2) {
        alert("Passwords are not equal.");
        ok = false;
    }
    return ok;
}

