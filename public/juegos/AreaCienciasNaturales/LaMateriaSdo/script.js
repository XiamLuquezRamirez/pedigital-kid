//Initial References
let draggableObjects;
let dropPoints;
const array_a = ["aguacate", "arandano", "avion", "agua", "almendra", "ardilla", "avestruz", "aji", "anillo", "aguila", "aguila", "arana", "avispa", "arcoiris", "arbol"]
const array_e = ["escoba", "escalera", "espejo", "estuche", "estufa", "esponja", "estrella", "escritorio", "elefante", "enano", "extintor", "empanada", "escuadra", "erizo", "escorpion"]
const array_i = ["iguana", "iman", "iglesia", "indio", "isla", "impresora", "insecto", "idea", "iglu", "incendio", "inodoro", "inyeccion", "ingeniero", "inflable", "inflable"]
const array_o = ["oso", "ojo", "olla", "oro", "oveja", "ocho", "oido", "oceano", "ogro", "ovni", "oruga", "ola", "ostra", "orca", "orquidea"]
const array_u = ["uniforme", "uva", "una", "unicornio", "uno", "universo", "utiles"]

let deviceType = "";
let initialX = 0, initialY = 0;
let currentElement = "";
let moveElement = false;

//Detect touch device
const isTouchDevice = () => {
  try {
    //We try to create Touch Event (It would fail for desktops and throw error)
    document.createEvent("TouchEvent");
    deviceType = "touch";
    return true;
  } catch (e) {
    deviceType = "mouse";
    return false;
  }
};


//Random value from Array
const randomValueGenerator = (vector) => {
  return vector.sort(function (a, b) { return (Math.random() - 0.5) });
};


//Drag & Drop Functions
function dragStart(e) {
  if (isTouchDevice()) {
    initialX = e.touches[0].clientX;
    initialY = e.touches[0].clientY;
    //Start movement for touch
    moveElement = true;
    currentElement = e.target;
  } else {
    //For non touch devices set data to be transfered
    e.dataTransfer.setData("text", e.target.id);
  }
}

//Events fired on the drop target
function dragOver(e) {
  e.preventDefault();
}

//For touchscreen movement
var top_o = 0;
var left_o = 0;
var id_sel = ""
const touchMove = (e) => {
  if (moveElement) {
    e.preventDefault();

    let newX = e.touches[0].clientX;
    let newY = e.touches[0].clientY;
    let currentSelectedElement = document.getElementById(e.target.id);

    if (top_o == 0 && left_o == 0) {
      id_sel = currentElement.id;
      var offsets = document.getElementById(currentElement.id).getBoundingClientRect();
      top_o = offsets.top;
      left_o = offsets.left;
    }

    currentSelectedElement.parentElement.style.top =
      currentSelectedElement.parentElement.offsetTop - (initialY - newY) + "px";
    currentSelectedElement.parentElement.style.left =
      currentSelectedElement.parentElement.offsetLeft -
      (initialX - newX) +
      "px";
    initialX = newX;
    initialY = newY;
  }
};

let cont = 0;
let correctas = 0;
const drop = (e) => {
  e.preventDefault();
  //For touch screen
  if (isTouchDevice()) {
    moveElement = false;
    //Select country name div using the custom attribute
    const currentDrop = document.querySelector(`div[data-id='${e.target.id}']`);
    //Get boundaries of div
    const currentDropBound = currentDrop.getBoundingClientRect();
    //if the position of flag falls inside the bounds of the countru name
    if (
      initialX >= currentDropBound.left &&
      initialX <= currentDropBound.right &&
      initialY >= currentDropBound.top &&
      initialY <= currentDropBound.bottom
    ) {
      currentDrop.classList.add("dropped");
      //hide actual image
      currentElement.classList.add("hide");
      currentDrop.innerHTML = ``;
      //Insert new img element
      currentDrop.insertAdjacentHTML(
        "afterbegin",
        `<img src= "${currentElement.id}.png">`
      );
    }
  } else {
    //Access data
    const draggedElementData = e.dataTransfer.getData("text");
    //Get custom attribute value
    const droppableElementData = e.target.getAttribute("data-id");
    const draggedElement = document.getElementById(draggedElementData);
    let imagen_id = draggedElement.getAttribute('data-id');
    debugger
    if (e.target.innerHTML == "" && e.target.tagName != "IMG") {
      cont++;
      if (droppableElementData === imagen_id) {
        draggedElement.classList.add("hide");
        e.target.innerHTML = "";
        e.target.classList.add("dropped");
        e.target.insertAdjacentHTML(
          "afterbegin",
          `<img class='img_drag' style='height: 50pt; width: auto' src="img/${imagen_id}/${draggedElementData.split("_")[1]}.png">`
        );
        var audio = new Audio('../../sounds/ok.mp3');
        audio.play();
        correctas++;
      } else {
        e.target.innerHTML = "";
        draggedElement.classList.add("hide");
        var audio = new Audio('../../sounds/over.mp3');
        audio.play();
        e.target.classList.add("error");
        e.target.insertAdjacentHTML(
          "afterbegin",
          `<img class='img_drag' style='height: 50pt; width: auto' src="img/${imagen_id}/${draggedElementData.split("_")[1]}.png">`
        );
      }
    }
  }



  if (cont == 12) {

    setTimeout(() => {
      limpiar();
    }, 1700)

    $('#principal').fadeToggle(500);
    setTimeout(() => {
      $('#final').fadeToggle(1000);
    }, 500)
    if (correctas < 6) {
      document.getElementById("final").style.backgroundImage = "url(../../images/derrota.gif)";
    } else {
      document.getElementById("final").style.backgroundImage = "url(../../images/victoria.gif)";
    }

    document.getElementById("texto_final").innerText = "Has contestado correctamente " + correctas + " preguntas de 18"

    if (correctas >= 6) {
      var audio = new Audio('../../sounds/victory.mp3');
      audio.play();
    } else {
      var audio = new Audio('../../sounds/game_over.mp3');
      audio.play();
    }
  }
};

//Creates number and request
const creator = () => {

  correctas = 0;
  cont = 0;

  let gaseoso_ramdom = randomValueGenerator([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
  let liquido_random = randomValueGenerator([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]);
  let solido_random = randomValueGenerator([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]);

  let array_divs = [];
  for (let index = 0; index < 4; index++) {
    array_divs.push("<div class='col-4 draggable-image text-center' draggable='true'><img class='img_drag' data-id='gaseoso' style='height: 80pt; width: auto' id='gaseoso_" + gaseoso_ramdom[index] + "' src='img/gaseoso/" + gaseoso_ramdom[index] + ".png' alt='prueba.png'></div>")
  }

  for (let index = 0; index < 4; index++) {
    array_divs.push("<div class='col-4 draggable-image text-center' draggable='true'><img class='img_drag' data-id='liquido' style='height: 80pt; width: auto' id='liquido_" + liquido_random[index] + "' src='img/liquido/" + liquido_random[index] + ".png' alt='prueba.png'></div>")
  }

  for (let index = 0; index < 4; index++) {
    array_divs.push("<div class='col-4 draggable-image text-center' draggable='true'><img class='img_drag' data-id='solido' style='height: 80pt; width: auto' id='solido_" + solido_random[index] + "' src='img/solido/" + solido_random[index] + ".png' alt='prueba.png'></div>")
  }

  array_divs = randomValueGenerator(array_divs);

  div = "";
  for (let index = 0; index < array_divs.length; index++) {
    const element = array_divs[index];
    div += element;
  }

  document.getElementById("imagenes").innerHTML = "";
  document.getElementById("imagenes").innerHTML = div;
};

startGame = async () => {
  currentElement = "";
  await creator();

  dropPoints = document.querySelectorAll(".signo");
  draggableObjects = document.querySelectorAll(".draggable-image");

  draggableObjects.forEach((element) => {
    element.addEventListener("dragstart", dragStart);
    element.addEventListener("touchstart", dragStart);
    element.addEventListener("touchend", drop);
    element.addEventListener("touchmove", touchMove);
  });


  dropPoints.forEach((element) => {
    element.addEventListener("dragover", dragOver);
    element.addEventListener("drop", drop);
  });
}

$(document).ready(function () {
  setTimeout(function () {
    let audio = new Audio('../../sounds/fondo.mp3');
    audio.play();
    audio.volume = 0.2;

    var audio_2 = new Audio('../../sounds/la_materia.mp3');
    audio_2.play();

    startGame();
  }, 100);

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
          maquina2("bienvenida", 'Hola, soy Genio. <br> En este juego deberas arrastrar cada imagen al lugar correspondiente, segun el estado fisico en que se encuentre.<br> <br> ¡Tu Puedes!', 50, 1);
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


function limpiar() {
  divs = document.getElementsByClassName('signo');
  for (let index = 0; index < divs.length; index++) {
    const element = divs[index];
    element.classList.remove("dropped");
    element.classList.remove("error");
    element.innerHTML = "";
  }
}