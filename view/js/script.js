let form = document.querySelector("#inscriptionForm");

form.mail.addEventListener("change", function () {
  validEmail(this);
});

form.pass1.addEventListener("change", function () {
  validPassword(this);
});

form.pseudo.addEventListener("change", function () {
  validPseudo(this);
});

const validEmail = function (inputEmail) {
  let emailRegExp = new RegExp(
    "^[a-zA-Z0-9.-_]+[@]{1}[a-zA-Z0-9.-_]+[.]{1}[a-z]{2,10}$"
  );

  let small = inputEmail.nextElementSibling;

  if (emailRegExp.test(inputEmail.value)) {
    small.innerHTML = "Adresse valide";
    small.classList.remove("text-danger");
    small.classList.add("text-success");
  } else {
    small.innerHTML = "Adresse invalide";
    small.classList.remove("text-success");
    small.classList.add("text-danger");
  }
};

const validPassword = function (inputPassword) {
  let msg;
  let valid = true;

  //Au moins 11 caractères
  if (inputPassword.value.length >= 11) {
    msg = "Mot de passe valide";
  } else {
    msg = "Le mot de passe doit contenir au minimum 11 caractères";
    valid = false;
  }

  let small2 = inputPassword.nextElementSibling;

  if (valid) {
    small2.innerHTML = msg;
    small2.classList.remove("text-danger");
    small2.classList.add("text-success");
  } else {
    small2.innerHTML = msg;
    small2.classList.remove("text-success");
    small2.classList.add("text-danger");
  }
};

const validPseudo = function (inputPseudo) {
  let msg2;
  let valid2 = true;

  //Au moins 5 caractères
  if (inputPseudo.value.length >= 5) {
    msg2 = "Pseudo valide";
  } else {
    msg2 = "Pseudo doit contenir au minimum 5 caractères";
    valid2 = false;
  }

  let small3 = inputPseudo.nextElementSibling;

  if (valid2) {
    small3.innerHTML = msg2;
    small3.classList.remove("text-danger");
    small3.classList.add("text-success");
  } else {
    small3.innerHTML = msg2;
    small3.classList.remove("text-success");
    small3.classList.add("text-danger");
  }
};
