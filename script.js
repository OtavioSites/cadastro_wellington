let imagem = document.querySelector("#avatarImg");
let botao = document.querySelector("#btn_cadastro");
let email = document.querySelector("#email");
let nome = document.querySelector("#nome");
let file = document.getElementById("avatar");
let form = document.getElementById("formulario");




const fetchParaPhp =  async (event) => {
  event.preventDefault()

  const formData = new FormData(form); //Cria um objeto para enviar dados via método http, bom para enviar arquivos.
  //Adiciona uma informação de um arquivo, files[] é o nome que vai ser dado no php
 
  let data = Object.fromEntries(formData);//Transforma em um objeto
  console.log(data);
  try {
    let res = await fetch('http://localhost:8000/inserir_users.php', {
      method: "POST",
      body: formData
    });

    let response = await res.json();
    console.log(response);
   
    
  } catch (error) {
    console.log(error)
  }


}

form.addEventListener("submit", fetchParaPhp);

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

