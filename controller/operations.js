const cad = document.querySelector("#cad-user");//formulario cadastro
const msgAlert = document.querySelector(".msg");//mensagem de cadastro
// const cadastro = document.querySelector("#cad");
const formPesquisa = document.querySelector(".form-pes");
const listarTodos = document.querySelector(".listar");//btn listar

const tableL = document.querySelector(".tabela-listar");//table
const tbodylistar = document.querySelector(".tbody-listar");//body table listar
const formulariolistar = document.querySelector(".listar-all");//body table listar


let formatualizar = document.querySelector(".form-atualizar");//form atualizar


// variaveis de controle de sobreposição

const um = document.querySelector(".conteudo");//container cadastrar
const dois = document.querySelector(".pesquisa1");//container pesquisar um
const tres = document.querySelector(".listar-all");//container listar todos
const quatro = document.querySelector(".atualizar-modal");//container atualizar

const sair = document.querySelector(".sair");


function cadAdm(){

    const btn = document.querySelector(".cadadm");

    btn.addEventListener("click", e =>{
        e.preventDefault();
        const area = document.querySelector(".conteudo-admin");
        area.classList.toggle("on");
    })

    
    const formadmin = document.querySelector(".form-admin");

    formadmin.addEventListener("submit", async (e) => {
        e.preventDefault();

        const form = new FormData(formadmin);

        const dados = await fetch("../model/cadadmin.php", {
            method: "POST",
            body: form,
        });

        const resultado = await dados.json();

        if(resultado['erro'] == false){
            document.querySelector(".msgadmin").innerHTML = resultado['msg'];
        }
        
        else{
            document.querySelector(".msgadmin").innerHTML = resultado['msg'];
        }
    })
}

cadAdm();

function Sair(){
    sair.addEventListener("click", async e=>{

        const dados = await fetch("../model/sair.php", {//envia os dados para a pagina pelo metodo fetch
            
        });

        window.location.href ="../index.php";
    })

}
Sair();



function cadastrar (){
    cad.addEventListener("submit", async (e) => {//no evendo de submit antes da função recebe o async para poder utilizar o await
        e.preventDefault();

        // um.style.display = "flex";
        // dois.style.display = "none";
        // tres.style.display = "none";
        // quatro.style.display = "none";

        let nomeCad = document.querySelector(".nomeCad");
        let emailCad = document.querySelector(".emailCad");
        let telCad = document.querySelector(".telCad");

        const dadosForm = new FormData(cad);//pega todos os dados do formulario

        const dados = await fetch("../model/cadastrar.php", {//envia os dados para a pagina pelo metodo fetch
            method: "POST",
            body: dadosForm,
        });

        const resposta = await dados.json();//recebe a resposta em formato de json
        if(resposta['erro']){
            msgAlert.innerHTML = resposta['msg'];
            nomeCad.value = "";
            emailCad.value = "";
            telCad.value = "";
        }else{
            msgAlert.innerHTML = resposta['msg'];
            nomeCad.value = "";
            emailCad.value = "";
            telCad.value = "";
        }
    });
}
cadastrar();

function pesquisar(){

        

    formPesquisa.addEventListener("submit", async e =>{
        e.preventDefault();

        // um.style.display = "none";
        // dois.style.display = "flex";
        // tres.style.display = "none";
        // quatro.style.display = "none";


        let pes = document.querySelector(".subpes");
        if(pes.value == ""){
            console.log("erro");
            document.querySelector(".pesquisa1").style.display = "none";
            return;
        }
        
        const dadosFormPes = new FormData(formPesquisa) 
        
        const dados = await fetch("../model/select.php",{
            method: "POST",
            body: dadosFormPes,
        });

        const resposta = await dados.json();

        if(resposta['erro'] == false){
            console.log(resposta);
            document.querySelector("td.id").innerHTML = resposta['dados'].id;
            document.querySelector("td.nome1").innerHTML = resposta['dados'].nome;
            document.querySelector("td.email").innerHTML = resposta['dados'].email;
            document.querySelector("td.tel").innerHTML = resposta['dados'].tel;
            document.querySelector(".pesquisa1").style.display = "flex";
            document.querySelector(".closePes").addEventListener("click", () =>{
            document.querySelector(".pesquisa1").style.display = "none";
            });

        }
        else{
            // document.querySelector(".pesquisa1").style.display = "none";
            // let msg = document.querySelector(".tbody");
            // let h = document.createElement("h1");
            // h.innerHTML = "Usuário não encontrado!";
            // msg.appendChild(h);

            document.querySelector("td.id").innerHTML = "";
            document.querySelector("td.nome1").innerHTML = "Não encontrado!";
            document.querySelector("td.email").innerHTML = "";
            document.querySelector("td.tel").innerHTML = "";
            document.querySelector(".pesquisa1").style.display = "flex";
            document.querySelector(".closePes").addEventListener("click", () =>{
            document.querySelector(".pesquisa1").style.display = "none";
            });
        }
        
        
    });
}
pesquisar();

function listar (){

        

    listarTodos.addEventListener("click", async (e) =>{
        e.preventDefault();

        // um.style.display = "none";
        // dois.style.display = "none";
        // tres.style.display = "flex";
        // quatro.style.display = "none";

        let openatt = document.querySelector(".atualizar-modal");
        openatt.style.display = "none";

        tbodylistar.innerHTML ="";

        formulariolistar.style.display = "flex";


        const dados = await fetch("../model/listar.php",{
            method: "GET",
        });

        const resposta = await dados.json(); 
        
        //console.log(resposta);
        let array =[];     
        if(resposta['erro'] == true){
            tbodylistar.innerHTML ="";
            tbodylistar.innerHTML ="Nenhum usúario cadastrado!";
        }   
        for(let i=0; i<resposta.length; i++){   

                                                   //percorreo o array de objetos que veio do bd
            array[0] = resposta[i]['id'];                  //em cada posição do array pega o valor da chave do objeto e joga em um arrray
            array[1] = resposta[i]['nome'];
            array[2] = resposta[i]['email'];
            array[3] = resposta[i]['tel'];
            array[4] =  `<button class="atualizar" value="${array[0]}">Atualizar</button>`;
            array[5] =  `<button class="excluir" value="${array[0]}">Excluir</button>`;
            
            let tr = document.createElement("tr");        //cria uma linha de tabela
            tbodylistar.appendChild(tr);                  //na tabela insere um linha
            for(let j=0; j<6; j++){
               let td = document.createElement("td");     //cria uma tupla de tabela
               td.innerHTML = array[j];                   //insere na tupla o valor do array
               tr.appendChild(td);
               tr.classList.add("esc");
            }
        };

    });
    
    
};

listar();

function atualizar(){  

    document.addEventListener("click", async e =>{
        // e.preventDefault();
        let botao = e.target;

        // um.style.display = "none";
        // dois.style.display = "none";
        // tres.style.display = "none";
        // quatro.style.display = "flex";

        if(botao.classList == "atualizar"){


            document.querySelector(".msgat").innerHTML ='';
            //recupera dados
            recuperaId = botao.value;
            let codId = botao.value;
            console.log(codId);
            let id = codId;

            const dados = await fetch(`../model/busca.php?id=${id}`,{
                method: "GET",
            });

            const resposta = await dados.json(); 

            
            document.querySelector(".id-atualizar").value = resposta['id'];
            nomeatualiza.value = resposta['nome'];
            emailatualiza.value = resposta['email'];
            telatualiza.value = resposta['tel'];

            let closeform = document.querySelector(".listar-all");
            closeform.style.display = "none";

            let openatt = document.querySelector(".atualizar-modal");
            if(closeform.style.display = "none"){
                openatt.style.display = "flex";
            };

            // atualizar

            
            

        }else if(botao.classList == "excluir"){
            let codId = botao.value;
            console.log(codId);
            let alertmsg = confirm("Realmente deseja excluir?");
            if(alertmsg == true){
                
                const dados = await fetch(`../model/delete.php?id=${codId}`,{
                    method: "GET",
                });

                const resposta = await dados.json();

                // teste listar 

                tbodylistar.innerHTML ="";

                //formulariolistar.style.display = "flex";
        
        
                const dados1 = await fetch("../model/listar.php",{
                    method: "GET",
                });
        
                const resposta1 = await dados1.json(); 
                
                //console.log(resposta);
                let array =[];     
                if(resposta1['erro'] == true){
                    tbodylistar.innerHTML ="";
                    tbodylistar.innerHTML ="Nenhum usúario cadastrado!";
                }   
                for(let i=0; i<resposta1.length; i++){   
        
                                                           //percorreo o array de objetos que veio do bd
                    array[0] = resposta1[i]['id'];                  //em cada posição do array pega o valor da chave do objeto e joga em um arrray
                    array[1] = resposta1[i]['nome'];
                    array[2] = resposta1[i]['email'];
                    array[3] = resposta1[i]['tel'];
                    array[4] =  `<button class="atualizar" value="${array[0]}">Atualizar</button>`;
                    array[5] =  `<button class="excluir" value="${array[0]}">Excluir</button>`;
                    
                    let tr = document.createElement("tr");        //cria uma linha de tabela
                    tbodylistar.appendChild(tr);                  //na tabela insere um linha
                    for(let j=0; j<6; j++){
                       let td = document.createElement("td");     //cria uma tupla de tabela
                       td.innerHTML = array[j];                   //insere na tupla o valor do array
                       tr.appendChild(td);
                       tr.classList.add("esc");
                    }
                };

                // fim teste

                
            }
        }
        
    });

    
};


let nomeatualiza = document.querySelector(".nomeatualiza");
let emailatualiza = document.querySelector(".emailatualiza");
let telatualiza = document.querySelector(".telatualiza");
let recuperaId;


function update(){
    const btn = document.querySelector(".btn-atualizar");
    
    btn.addEventListener("click", async e =>{
        e.preventDefault();

        

        const arrayDados = [];
        arrayDados['id'] = recuperaId;
         
        let nome = document.querySelector(".nomeatualiza");
        let email = document.querySelector(".emailatualiza");
        let tel = document.querySelector(".telatualiza");
        let msgat = document.querySelector(".msgat");

        const obj = {
            id: '1',
            nome: 'felipe',
            email: 'email.value',
            tel: 'tel.value'
        };

        arrayDados['nome'] = nome.value;
        arrayDados['email'] = email.value;
        arrayDados['tel'] = tel.value;

        

        const form = document.querySelector(".form-atualizar");

        const formAtualizar = new FormData(form)

        
        
        for(let i =0;i<5;i++){
            if(arrayDados[i] == ""){
                msgat.innerHTML = "Preencha todos os campos!";
            }
        };

        

        const resp = await fetch("../model/update.php",{
            method: "POST",
            body: formAtualizar,
        });

        

        const dados = await resp.json();

        if(dados['erro'] == false){
            document.querySelector(".msgat").innerHTML = dados['msg'];
        }else{
            document.querySelector(".msgat").innerHTML = dados['msg'];
        }

    }) 
};
update();


atualizar();














