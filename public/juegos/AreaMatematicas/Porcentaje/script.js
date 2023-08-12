$(document).ready(function () {
  let audio2 = new Audio('../../sounds/fondo.mp3');
  audio2.play();
  audio2.volume = 0.2;
  generarDatos();
  setTimeout(() => {
    $('#principal').fadeToggle(1000);
    $('#fondo_blanco').fadeToggle(3000);
    setTimeout(() => {
      const divAnimado = document.querySelector('.overlay');
      divAnimado.style.animationName = 'moverDerecha';
      divAnimado.style.animationDirection = 'normal';
      divAnimado.style.display = 'block';
      setTimeout(() => {
        const divAnimado2 = document.querySelector('.nube');
        divAnimado2.style.animationName = 'moverArriba';
        divAnimado2.style.animationDirection = 'normal';
        divAnimado2.style.display = 'block';
        setTimeout(() => {
          divAnimado.style.backgroundImage = "url(../../images/normal2.gif)"
          maquina2("bienvenida", 'Hola, soy Genio. <br> Toma como base el número que esta en la cabeza de la araña para calcular los porcentajes que se te piden y luego arrastra cada número a su lugar correspondiente, responde mas de el 60% de las preguntas correctamente para ganar. <br> ¡Tu Puedes!', 50, 1);
        }, 3000)
      }, 2000)
    })
  }, 200)
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

let bandera = true;
function generarDatos() {
  let numeroGeneradoDevalores = Math.floor(Math.random() * (100 - 10 + 1) + 10) * 10;
  numeroGeneradoDevalores = numeroGeneradoDevalores % 2 === 0 ? numeroGeneradoDevalores : numeroGeneradoDevalores + 1;

  document.getElementById("numero_generado").innerText = numeroGeneradoDevalores;

  var puntos = document.querySelectorAll(".punto");
  puntos.forEach((punto) => {
    punto.addEventListener("dragover", permitirSoltar);
    punto.addEventListener("drop", soltarNombre);
  });

  let arrayValores = [];
  let arrayMulti = []
  for (let index = 2; index <= 7; index++) {
    let porcen = Math.floor(Math.random() * (20 - 1 + 1) + 1) * 5;
    let valor_r = (numeroGeneradoDevalores * porcen) / 100;

    if (!arrayValores.includes(porcen) && Number.isInteger(valor_r)) {
      arrayValores.push(porcen);
      arrayMulti.push(valor_r);
      document.getElementById("punto" + index).setAttribute("data-id", (numeroGeneradoDevalores * porcen) / 100);
      document.getElementById("punto" + index).innerHTML = porcen + "%";
    } else {
      index--;
    }
  }

  let divs = "";
  let i = 1;
  arrayMulti.forEach(element => {
    divs += "<div class='opcion' id='nombre" + i + "' data-id='" + element + "' draggable='true'><h2>" + element + "</h2></div>"
    i++;
  });

  document.getElementById("numeros").innerHTML = "";
  document.getElementById("numeros").innerHTML = divs;

  var nombres = document.querySelectorAll(".opcion");

  nombres.forEach((nombre) => {
    nombre.addEventListener("dragstart", arrastrar);
    nombre.addEventListener("dragend", soltar);
  });

}

let elemento_sel = ""
function arrastrar(evento) {
  evento.dataTransfer.setData("text", evento.target.id);
  evento.target.style.opacity = "0.5";
  elemento_sel = evento.target;
}

function soltar(evento) {
  evento.target.style.opacity = "1";
}

function permitirSoltar(evento) {
  evento.preventDefault();
}

let cont = 0;
let correctas = 0;
function soltarNombre(evento) {
  evento.preventDefault();

  // Obtenemos el ID del nombre que se está soltando
  var idNombre = evento.dataTransfer.getData("text");

  // Obtenemos el ID del punto donde se soltó el nombre
  var idPunto = evento.target.id;
  var Ubicacion = evento.target.getAttribute("data-id");

  // Obtenemos el elemento del nombre
  var nombre = document.getElementById(idNombre);
  const hab_animal = nombre.getAttribute("data-id");

  // Lo movemos al punto donde se soltó
  debugger
  if (evento.target.childElementCount == 0 && evento.target.tagName != "H2") {
    evento.target.innerHTML += nombre.innerHTML;

    // Centramos el nombre dentro del punto
    nombre.style.display = "none";

    // Verificamos si el nombre ha sido soltado en el punto correcto

    if (Ubicacion == hab_animal) {
      correctas++;
      nombre.draggable = false;
      document.getElementById(idPunto).style.backgroundColor = "#167713";
      document.getElementById(idPunto).style.color = "#fff";
    } else {
      nombre.draggable = false;
      document.getElementById(idPunto).style.backgroundColor = "#FF0000";
      document.getElementById(idPunto).style.color = "#fff";
    }

    cont++;
  }else{
    elemento_sel.style.opacity = "1";
  }

  if (cont == 6) {
    $('#principal').fadeToggle(500);
    setTimeout(() => {
      $('#final').fadeToggle(1000);
    }, 500)
    if (correctas < 4) {
      document.getElementById("final").style.backgroundImage = "url(../../images/derrota.gif)";
    } else {
      document.getElementById("final").style.backgroundImage = "url(../../images/victoria.gif)";
    }

    document.getElementById("texto_final").innerText = "Has contestado correctamente " + correctas + " preguntas de 6"

    if (correctas >= 4) {
      var audio = new Audio('../../sounds/victory.mp3');
      audio.play();
    } else {
      var audio = new Audio('../../sounds/game_over.mp3');
      audio.play();
    }
  }
}