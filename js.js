document
  .getElementById("inscriptionForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const formation = document.getElementById("formation").value;

    if (!name || !email || !formation) {
      alert("Veuillez remplir tous les champs SVP");
      return;
    }

    alert(
      `Merci ${name} pour votre inscription à la formation ${formation}.\nNous vous contacterons bientôt à votre e-mail : ${email}.`
    );
  });

document.getElementById("search").addEventListener("input", function () {
  const query = this.value.toLowerCase();
  const formations = document.querySelectorAll("#formationList li");

  formations.forEach(function (formation) {
    const text = formation.textContent.toLowerCase();
    if (text.includes(query)) {
      formation.style.display = "list-item";
    } else {
      formation.style.display = "none";
    }
  });
});

function changer() {
  let images = document.getElementById("moi");
  images.src = "img.jpg";
}
