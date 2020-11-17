function validateForm(form){
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(form.email.value))
  {
    return true;
  }
  alert("Invalid email!");
  return false;
}
