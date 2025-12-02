let imagem = document.querySelector("#preview");
let email = document.querySelector("#email");
let nome = document.querySelector("#nome");
let file = document.getElementById("avatar");
let form = document.getElementById("formulario");
let avisoP = document.getElementById("aviso");


file.addEventListener("change", (event) => {

  
let arquivo = event.target.files[0];

const reader = new FileReader();

reader.onload = function(e){
  imagem.src = e.target.result;
  console.log(e.target.result)
  imagem.style.display = "block";
}

reader.readAsDataURL(arquivo);
})



const fetchParaPhp =  async (event) => {
  event.preventDefault();

  const formData = new FormData(form); //Cria um objeto para enviar dados via método http, bom para enviar arquivos.
  let reader = new FileReader(file);
 
  let data = Object.fromEntries(formData);//Transforma em um objeto
  console.log(data);
  if(data.nome == '' || data.email == '' || data.avatar.name == ''){
    avisoP.style.display = 'block';
    avisoP.textContent = 'Preencha todos os campos';
    console.log(reader.EMPTY)


  }else{
    avisoP.style.display = 'none';
  try {
    let res = await fetch('http://localhost:8000/inserir_users.php', {
      method: "POST",
      body: formData
    });

    let response = await res.json();
    console.log(response);
   
    if(response.status == 'error'){
      avisoP.style.display = 'block';
      avisoP.textContent = response.message;
    }


  } catch (error) {
    console.log(error)
  }

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

