//==========BARRA DE VIDA==========
const barraVida = document.getElementById('barra-vida');
const vidaActual = PJ_active.getHP_actual();
const vidaMaxima = PJ_active.getHPMax();
const porcentajeVida = (vidaActual / vidaMaxima) * 100;
barraVida.style.width = porcentajeVida + '%';
barraVida.textContent = vidaActual + '/' + vidaMaxima;

//==========BARRA DE MANA==========
const barraVida = document.getElementById('barra-mana');
const manaActual = PJ_active.getMP_actual();
const manaMaxima = PJ_active.getMPMax();
const porcentajeMana = (manaActual / manaMaxima) * 100;
barraMana.style.width = porcentajeMana + '%';
barraMana.textContent = manaActual + '/' + manaMaxima;


// Script para cargar los datos del personaje desde PJ_active y mostrarlos en el escenario
const nombrePersonajeElement = document.getElementById('nombrePersonaje');
const nivelPersonajeElement = document.getElementById('nivelPersonaje');


// Cargar los datos del personaje desde PJ_active
nombrePersonajeElement.textContent = PJ_active.nombre;
nivelPersonajeElement.textContent = PJ_active.nivel;