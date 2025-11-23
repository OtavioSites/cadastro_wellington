let user_list = document.querySelector(".user_card");

async function carregarCards() {
    let response = await fetch("http://localhost:8000/listar_users.php")
    let dados = await response.json();

    console.log(dados)
}

carregarCards()