const btn = document.querySelector("#btn_pan_delete");
const form = document.querySelector("#js_form_pan_delete");

btn.addEventListener("click", (e) => {
  e.preventDefault();

  confirm("Voulez vous supprimer ce Pan ?") && form.submit();
});
