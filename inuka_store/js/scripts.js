// MODAL

function checkoutForm() {
  const dialog = document.getElementById("form-content").innerHTML;
  displayDialog(dialog);
}

function referDialog() {
  const dialog = document.getElementById("refer-content").innerHTML;
  displayDialog(dialog);
}

function closeRefer() {
  window.location.href = "/student-toys/home.php";
}

function displayDialog(dialog) {
  document.getElementById("dialogoverlay").style.display = "block";
  document.getElementById("dialogbox").style.display = "block";
  document.getElementById("dialogbox_body").innerHTML = dialog;
}

function closeDialog() {
  document.getElementById("dialogbox").style.display = "none";
  document.getElementById("dialogoverlay").style.display = "none";
}

// VALIDATION

function validateName() {
  const name = document.getElementById("name-order");
  const regex = /^[A-Za-z\s]{3,}$/;
  const result = regex.test(name.value);

  if (result) {
    name.style.border = "2px solid green";
  } else {
    name.style.border = "2px solid red";
    name.focus();
    return false;
  }
}

function validateEmail() {
  const email = document.getElementById("email-order");
  const regex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
  const result = regex.test(email.value);

  if (result) {
    email.style.border = "2px solid green";
  } else {
    email.style.border = "2px solid red";
    email.focus();
    return false;
  }
}

function validatePhone() {
  const phone = document.getElementById("phone-order");
  const regex = /^\d{10}$/;
  const result = regex.test(phone.value);

  if (result) {
    phone.style.border = "2px solid green";
  } else {
    phone.style.border = "2px solid red";
    phone.focus();
    return false;
  }
}

function validateAddress() {
  const address = document.getElementById("address-order");
  const regex = /^(.+?)$/;
  const result = regex.test(address.value);

  if (result) {
    address.style.border = "2px solid green";
  } else {
    address.style.border = "2px solid red";
    address.focus();
    return false;
  }
}

function validateAll() {
  let valid = true;
  valid = validateName();
  if (valid === false) {
    return valid;
  }
  valid = validateEmail();
  if (valid === false) {
    return valid;
  }
  valid = validatePhone();
  if (valid === false) {
    return valid;
  }
  valid = validateAddress();
  if (valid === false) {
    return valid;
  }
  return valid;
}
