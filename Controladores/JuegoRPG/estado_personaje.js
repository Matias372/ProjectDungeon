//==========BARRA DE VIDA==========
const barraVida = document.getElementById('barra-vida');
const vidaActual = PJ_active.HP;
const vidaMaxima = PJ_active.HPMax;
const porcentajeVida = (vidaActual / vidaMaxima) * 100;
barraVida.style.width = porcentajeVida + '%';
barraVida.textContent = vidaActual + '/' + vidaMaxima;

//==========BARRA DE MANA==========
const barraMana = document.getElementById('barra-mana');
const manaActual = PJ_active.MP;
const manaMaxima = PJ_active.MPMax;
const porcentajeMana = (manaActual / manaMaxima) * 100;
barraMana.style.width = porcentajeMana + '%';
barraMana.textContent = manaActual + '/' + manaMaxima;

//==========IMAGEN CLASE==========
// Obtener la referencia a la etiqueta de imagen por su ID
var imgElement = document.getElementById("personajeImagen");

// Construir la ruta de la imagen
var rutaImagen = "../../../Vistas/Recursos/img/Character/" + PJ_active.Clase + ".png";

// Establecer la ruta de la imagen en la etiqueta <img>
imgElement.src = rutaImagen;


// Script para cargar los datos del personaje desde PJ_active y mostrarlos en el escenario
const nombrePersonajeElement = document.getElementById('nombrePersonaje');
const nivelPersonajeElement = document.getElementById('nivelPersonaje');


// Cargar los datos del personaje desde PJ_active
nombrePersonajeElement.textContent = PJ_active.Nombre;
nivelPersonajeElement.textContent = PJ_active.Nivel;