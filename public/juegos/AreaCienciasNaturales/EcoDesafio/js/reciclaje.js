// Array de imágenes
let imagenes = [
    {
        url: "img/elementos/caja-aprovechable.png",
        tipo: "aprovechable",
    },
    {
        url: "img/elementos/papelperiodico.png",
        tipo: "noaprovechable",
    },
    {
        url: "img/elementos/papeles.png",
        tipo: "aprovechable",
    },
    {
        url: "img/elementos/botellavidrio.png",
        tipo: "aprovechable",
    },
    {
        url: "img/elementos/copavidrio.png",
        tipo: "aprovechable",
    },
    {
        url: "img/elementos/botellavidrio2.png",
        tipo: "aprovechable",
    },
    {
        url: "img/elementos/botellavidrio3.png",
        tipo: "aprovechable",
    },
    {
        url: "img/elementos/latausada.png",
        tipo: "noaprovechable",
    },
    {
        url: "img/elementos/lata.png",
        tipo: "aprovechable",
    },
    {
        url: "img/elementos/bolsa.png",
        tipo: "aprovechable",
    },
    {
        url: "img/elementos/botellaplastico.png",
        tipo: "aprovechable",
    },
    {
        url: "img/elementos/tijeras.png",
        tipo: "aprovechable",
    },
    {
        url: "img/elementos/juevos.png",
        tipo: "noaprovechable",
    },
    {
        url: "img/elementos/hueso.png",
        tipo: "organico",
    },
    {
        url: "img/elementos/banana.png",
        tipo: "organico",
    },
    {
        url: "img/elementos/aji.png",
        tipo: "organico",
    },
    {
        url: "img/elementos/pez.png",
        tipo: "organico",
    },
    {
        url: "img/elementos/patilla.png",
        tipo: "organico",
    },
    {
        url: "img/elementos/lata2.png",
        tipo: "aprovechable",
    },
    {
        url: "img/elementos/bateria.png",
        tipo: "aprovechable",
    },
    {
        url: "img/elementos/botellapartida.png",
        tipo: "aprovechable",
    },
    {
        url: "img/elementos/empaquecomida1.png",
        tipo: "noaprovechable",
    },
    {
        url: "img/elementos/empaquecomida2.png",
        tipo: "noaprovechable",
    },
    {
        url: "img/elementos/empaquecomida3.png",
        tipo: "noaprovechable",
    },
];

let imagenesMostradas = [];
let score = 0;
function obtenerIndiceAleatorio(imagenes) {
    let indice = Math.floor(Math.random() * imagenes.length);
    while (imagenesMostradas.includes(indice)) {
        indice = Math.floor(Math.random() * imagenes.length);
    }
    imagenesMostradas.push(indice);

    return imagenes[indice];
}


function mostrarImagenes() {
    let contenedor = document.getElementById("div-elementos");

    document.getElementById("img-mascota").src = "../../images/pensando.gif";

    for (let i = 0; i < 8; i++) {
        let imagenContenedor = document.createElement("div");
        imagenContenedor.classList.add("item-basura");

        imagenContenedor.addEventListener("dragstart", dragStart);
        imagenContenedor.addEventListener("dragend", dragEnd);

        let imagen = new Image();
        imagen.onload = function () {
            imagenContenedor.appendChild(imagen);
            contenedor.appendChild(imagenContenedor);
        };
        let imagenObj = obtenerIndiceAleatorio(imagenes);
        imagen.src = imagenObj.url;
        imagen.alt = imagenObj.tipo;
        imagen.width = "90";

        imagen.className;
        imagenContenedor.id = imagenObj.tipo;
    }
}
var audio = new Audio("../../sounds/enunciado_reciclaje.mp3");
audio.play();

const bins = document.querySelectorAll(".contenedor");

bins.forEach((bin) => {
    bin.addEventListener("dragover", dragOver);
    bin.addEventListener("dragenter", dragEnter);
    bin.addEventListener("dragleave", dragLeave);
    bin.addEventListener("drop", dragDrop);
});

function dragStart() {
    this.classList.add("dragging");
}

function dragEnd() {
    this.classList.remove("dragging");
}

function dragOver(e) {
    e.preventDefault();
}

function dragEnter(e) {
    e.preventDefault();
    this.classList.add("over");
}

function dragLeave() {
    this.classList.remove("over");
}

function dragDrop() {
    const binId = this.getAttribute("data-id");
    const item = document.querySelector(".dragging");
    const itemId = item.getAttribute("id");
    var basuras = document.getElementsByClassName("item-basura");
    var nbasura = basuras.length;

    if (binId === itemId) {
        score += 10;
        document.getElementById("img-mascota").src =
            "../../images/correcto.gif";

        this.classList.remove("over");
        item.remove();
        if (nbasura == 1) {
            $("#principal").fadeToggle(1000);
            $("#final").fadeToggle(1000);
            if (score <= 0) {
                var audio = new Audio("../../sounds/game_over.mp3");
                audio.play();
                document.getElementById("final").style.backgroundImage =
                    "url(../../images/derrota.gif)";
            } else {
                document.getElementById("final").style.backgroundImage =
                    "url(../../images/victoria.gif)";
                var audio = new Audio("../../sounds/victory.mp3");
                audio.play();
            }
            document.getElementById("texto_final").innerText =
                "Has obtenido " + score + " puntos";
        }
    } else {
        document.getElementById("img-mascota").src =
            "../../images/incorrecto.gif";
        score -= 5;
        this.classList.remove("over");
    }
}

$(document).ready(function () {
    let audio2 = new Audio("../../../sounds/fondo.mp3");
    audio2.play();
    audio2.volume = 0.2;

    mostrarImagenes();

    setTimeout(() => {
        $("#principal").fadeToggle(1000);
        $("#fondo_blanco").fadeToggle(3000);
        setTimeout(() => {
            const divAnimado = document.querySelector(".overlay");
            divAnimado.style.animationName = "moverDerecha";
            divAnimado.style.animationDirection = "normal";
            divAnimado.style.display = "block";
            setTimeout(() => {
                const divAnimado2 = document.querySelector(".nube");
                divAnimado2.style.animationName = "moverArriba";
                divAnimado2.style.animationDirection = "normal";
                divAnimado2.style.display = "block";
                setTimeout(() => {
                    divAnimado.style.backgroundImage =
                        "url(../../images/normal2.gif)";
                    maquina2(
                        "bienvenida",
                        "Hola, soy Genio. <br> En este juego debes clasificar los residuos (Aprovechables, no aprovechables y organicos) moviendolos a la caneca corrrespondiente.",
                        100,
                        1
                    );
                }, 3000);
            }, 2000);
        });
    }, 200);
});

function maquina2(contenedor, texto, intervalo, n) {
    var i = 0,
        // Creamos el timer
        timer = setInterval(function () {
            if (i < texto.length) {
                // Si NO hemos llegado al final del texto..
                // Vamos añadiendo letra por letra y la _ al final.
                $("#" + contenedor).html(texto.substr(0, i++) + "_");
            } else {
                // En caso contrario..
                // Salimos del Timer y quitamos la barra baja (_)
                clearInterval(timer);
                $("#" + contenedor).html(texto);
                if (!cerrardo) {
                    document.querySelector('#btnomitir').style.display = "none";
                    setTimeout(() => {
                        cerrar_anuncio();
                    }, 3000)
                }
                // Auto invocamos la rutina n veces (0 para infinito)
                if (--n != 0) {
                    setTimeout(function () {
                        maquina2(contenedor, texto, intervalo, n);
                    }, 3600);
                }
            }
        }, intervalo);
}

let cerrardo = false;
function cerrar_anuncio() {
    cerrardo = true;
    const divAnimado2 = document.querySelector('.nube');
    divAnimado2.style.animationName = 'moverabajo';
    const divAnimado = document.querySelector('.overlay');
    divAnimado.style.backgroundImage = "url(../../images/normal1.gif)";
    $('#fondo_blanco').fadeToggle(3000);
    setTimeout(function () {
        divAnimado.style.animationName = 'moverIzquierda';
        divAnimado.style.animationDirection = 'normal';
        setTimeout(() => {
            $('#principal').fadeToggle(1000);
        }, 2000)
    }, 2000);
}

