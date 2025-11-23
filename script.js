let imagem = document.querySelector("#avatarImg");
let botao = document.querySelector("#btn_cadastro");
let email = document.querySelector("#email");
let nome = document.querySelector("#nome");
let file = document.getElementById("avatar");
let form = document.getElementById("formulario");
let p = document.querySelector("#teste")
form.addEventListener("submit", async (event) => {
  event.preventDefault();

  const formData = new FormData(form); //Cria um objeto para enviar dados via método http, bom para enviar arquivos.
  //Adiciona uma informação de um arquivo, files[] é o nome que vai ser dado no php
 
  let data = Object.fromEntries(formData);
  console.log(data);
  try {
    await fetch('http://localhost:8000', {
      method: "POST",
      body: formData
    }).then(response => response.text())
    .then(data => {
      console.log(data);

    })
   
  } catch (error) {
    console.log(error)
  }


})

// botao.addEventListener("click", (e) => {
  
//   fetch("./logica/inserir_users.php",
//     {
//         method: "GET",
//         headers: {
//     'Content-Type': 'application/json'
//   },
//   body: JSON.stringify(dados)
//     })
//     .then(response => response.json())
//     .then(data => {
//         alert(data);
//     })

// })

