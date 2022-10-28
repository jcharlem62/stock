$(document).on("submit", "form", function (e) {
  let regexListe = {
    nom: /^[\p{L}\s]{2,}$/u,
    tel: /^[\d]{10}$/,
    adr: /^[\p{L}\w\-\s]{5,}$/u,
    cp: /^[\[\d]{5}$/,
    pass: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/,
    mail: /^[a-z]{2,}\.[a-z]{2,}@mondom\.com$/,
  };

  // récupérer les elements du form
  let formElements = $("form")[0];
  let erreur = false;
  $("small").text("");

  // formElements.length-2 : pour ne pas prendre les boutons submit et reset
  for (let i = 0; i < formElements.length - 2; i++) {
    $(formElements[i]).removeClass("erreurInput");
    const type = $(formElements[i]).attr("data-type");
    const pattern = regexListe[type];

    if (pattern.test(formElements[i].value) === false) {
      erreur = true;
      $(formElements[i]).addClass("erreurInput");
      $("#" + $(formElements[i]).attr("aria-describedby")).html(
        `<p class="erreurMessage">
            ${$(formElements[i]).attr("data-message")}
            </p>`
      );
    }
  }
  if (erreur) {
    e.preventDefault();
  }
});
