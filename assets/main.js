const mostrar = document.querySelector("#cad");// btn cadastrar
const conteudo = document.querySelector(".conteudo");//form cadastrar
const formlistar = document.querySelector(".closelistar");//btn fechar listar
const formlista = document.querySelector(".listar-all");//form listar


const navleft = document.querySelector(".nav-left");//menu lateral


const clo = document.querySelector(".close");//X para fechar

function clicar(){
    mostrar.addEventListener("click", function (e) {
        e.preventDefault();
        conteudo.classList.toggle("dissolve");
    });
    clo.addEventListener("click", () =>{
        conteudo.classList.toggle("dissolve");
    } );
};

function fecharListar(){
    formlistar.addEventListener("click", e =>{
        formlista.style.display = "none";
        let esc =  document.querySelector(".tbody-listar");
        esc.innerHTML = "";
    })
};

fecharListar();


// squares -------------------------------------------------------------------

const ulSquares = document.querySelector("ul.squares");
for(let i = 0; i<16; i++){
    const li = document.createElement("li");

    const random = (min, max) => Math.random() * (max - min) + min; 

    const size = Math.floor(random(10, 100));

    const position = random(20, 99);
    const delay = random(5, 0.1);
    const durantion = random(24 , 12);

    li.style.width = `${size}px`;
    li.style.height = `${size}px`;
    li.style.bottom = `-${size}px`;
    li.style.left = `${position}%`;

    li.style.animationDelay = `${delay}s`;
    li.style.animationDuration = `${durantion}s`;
    li.style.animationTimingFunction = `cubic-bazier(${Math.random},${Math.random},${Math.random},${Math.random})`

    ulSquares.appendChild(li);
}

clicar();