function validateForm(form)
{
  var pass =form.pass.value;
  var cpass = form.cpass.value;
  var c1 = true;
  var c2 = false;
  if(pass != cpass)
  {
    alert("Password doesn't match!");
    c1 = false;
  }

  if(pass == "" || pass==" " || pass==null)
  {
    alert("Password can't be empty");
    c1 = false;
  }

  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(form.email.value))
  {
    c2 = true;
  }

  else {
    alert("You have entered an invalid email address!");
    c2 = false;
  }
  if(c1 && c2)
  {
    return true;
  }
  else {
    return false;
  }
}

function checkpic(t)
{
  const file = this.files[0];
  const fileType = file['type'];
  const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
  if (!validImageTypes.includes(fileType)) {
    alert("Not a pic!");
}
}
