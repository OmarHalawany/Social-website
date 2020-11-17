function validateForm(form) {
    var npass = form.newpassword.value;
    var cpass = form.confirmpassword.value;
    if((npass!="" || !npass==" ") && (cpass!="" || cpass!=" "))
    {
        if(npass != cpass)
        {
            alert("New password doesn't match confirm password!");
            return false;
        }
    }
    else
    {
        return true;
    }
}