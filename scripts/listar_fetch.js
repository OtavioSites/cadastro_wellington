let user_list = document.querySelector("#users");

async function carregarCards() {
    let response = await fetch("http://localhost:8000/listar_users.php")
    let dados = await response.json();

    console.log(dados);
    let htmlCards = '';

    dados.forEach(user => {
    const card_template = `
        <div class="user_card">
                <div class="id">${user.id}</div>
                <div class="img"><img src="uploads/${user.avatar}" alt=""></div>
                <div class="nome">
                    <p class="nome_para">${user.nome}</p>
                </div>
                <div class="email">
                    <p class="email_para">${user.email}</p>
                </div>
                <div class="edit">
                    <button class="excluir"><img src="svg/trash-can-svgrepo-com.svg" alt=""></button>
                    <button class="editar" type="button"><img src="svg/pencil-edit-button-svgrepo-com.svg" alt=""></button>
                </div>
            </div>
    `;
   htmlCards += card_template;
})
   user_list.innerHTML = htmlCards;
}

document.querySelector("#cadastrar_btn").addEventListener("click", () => {
    window.location.href = "./index.html";

})

carregarCards();



    let popup =  document.querySelector("#popup_edit");
    let form = document.getElementById("editarForm");
    user_list.addEventListener("click", (btn) => {
    
    let botaoEditar = btn.target.closest(".editar");
    let botaoDeletar = btn.target.closest(".excluir");
   
    if(botaoEditar){
        let user_card = botaoEditar.closest(".user_card");
        let id = user_card.querySelector(".id");
        id = id.textContent.trim();
        console.log("ID: " + id);
        popup.style.display = "flex";

        form.addEventListener("submit", async (event) => {

            const formData = new FormData(form);
            formData.append("ID", id);
            console.log(formData);
            let data = Object.fromEntries(formData);
            console.log(data);
            try{

            await fetch("http://localhost:8000/editar_usuario.php", {
                method: "POST",
                body: formData
            }).then(response => response.text())
            .then(data => {console.log(data)})

        }catch(error){
            console.log(error);
        }


        })}
    if(botaoDeletar){
        let user_card = botaoEditar.closest(".user_card");
        let id = user_card.querySelector(".id");
        id = id.textContent.trim();
        console.log("ID: " + id);

    }
})


