function validateForm(){
    let x = document.forms['student_form']['marks'].value;
    if (!((x >= 65) && (x <= 100))) {
        alert("Invalid Grade!");
        return false;
    }
}