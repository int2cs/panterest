import "./styles/app.scss";
import "./styles/bootstrap.min.css";

console.log("script chargé");
const btn = document.querySelector("#btn_pan_delete");
const form = document.querySelector("#js_form_pan_delete");

btn.addEventListener("click", (e) => {
  e.preventDefault();

  confirm("Voulez vous supprimer ce Pan ?") && form.submit();
});
