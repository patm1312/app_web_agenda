document.addEventListener("DOMContentLoaded",(e)=>{
    let $container_registros = document.getElementById("elemento");
    let numero = $container_registros.getAttribute('value');
    if (numero == 0) {
        const $selectores = document.querySelectorAll("[data-show]")
        $selectores.forEach(element => {
            element.classList.add("show");
        })
    }
    let $reg_dest = document.getElementById("elemento_destacados");
    let numero_reg = $reg_dest.getAttribute('value');
    if (numero_reg == 0) {
        const $selectores_dest = document.querySelectorAll("[data-show-dest]")
        $selectores_dest.forEach(element => {
            element.classList.add("show");
        })
    }

})
// para mostrar el boton desttacdao del item de la paginacion, antes debo evaluar si existe los input de items de paginacion,  consultando la base de datos:

//localizar todos los imput con id enlace, se almacenan en un array
const $enlace = document.querySelectorAll('#enlace');
//localizo el input tipo hiddedn que tiene ciomo valor y el numero item que se dio click
const $input_item = document.querySelector('#input_item');
//en la variable valor almaceno el atributo value o numero item de ese input hidden,
//el inpiut hidden almacena el numero de item que di click para acceder a el input correspondiente almacenado posteriormente en un array en javascript
let valor = $input_item.getAttribute('value');
//le resto -1, porque necesito identifiar la posicion de un array con ese numero.
valor = valor -1;
//en la variable item_seleccion guardo la posicion del input seleccionado
item_selection = $enlace[valor]
if(document.querySelector(".enlace")){
    console.log("localizado");
    //a ese impiut le agregio la clase para destacarlo con color.
    item_selection.classList.add('enlace_select')
}else{
    console.log("no")
}

// validar datos a travez del cliente

const agregar = document.getElementById('agregar');
const $destacar = document.getElementById('destacar');
const $eliminar = document.getElementById('eliminar');
const $eliminar_todo = document.getElementById('eliminar-todo');
const $quitar = document.getElementById('quitar');
const $error = document.getElementById('error');
const $form = document.getElementById("form");
const texto = document.querySelector(".diary__section-textarea");
//guarda todos los inputs de cehcbox para luego evaluar si han sidio seleccionados
const checkbox = document.querySelectorAll(".identificador");

$form.addEventListener("click", (e)=>{
    //al momento de hacer click en cuialquier parte del formulario evalua todos los checkeds si
    //esta alguno seleccionado
    let input_valido = false
for(let i=0; i<checkbox.length; i++){
    //si hay algun checked seleccionado es verdadero, es decir, puedo usar los botones de eliminar , destacar o quitar
    if(checkbox[i].checked){
         input_valido = true
        break;
    }else{
        console.log("no hay ninguno seleccionado")
    }
}
//guardo eltexto quie quiero moistrar
    let parrafo =  "";
    //si el click coincide con la clase del boton de agregar
    if(e.target.matches(".bottons-agregar-one")){
        // console.log("selecciono agregar");
        //si el texto es menor que 8 caracteres
        if(texto.value.length < 8){
            e.preventDefault();
            parrafo = `Escribe una nota con mas de una palabra...<br> `;
            $error.innerHTML = parrafo
            $error.classList.remove("error_hidden");
            setTimeout(() => {
                $error.classList.add("error_hidden");
            }, 6000);
        };
    }else if(e.target.matches(".bottons-agregar-two")){
        console.log("selecciono eliminar nota ");
        if(input_valido){
        }else{
            e.preventDefault();
            parrafo = `Selecciona al menos una opcion para eliminar...<br> `;
            $error.innerHTML = parrafo
            $error.classList.remove("error_hidden");
            $error.classList.add("ubication_eliminar");
            setTimeout(() => {
                console.log("por aqui")
                $error.classList.add("error_hidden");
                $error.classList.remove("ubication_eliminar");
            }, 6000);
        }
    }else if(e.target.matches(".bottons-agregar-dos")){
        console.log("selecciono eliminar todo");
        var opcion = confirm("SE eliminaran todos los registros, ¿quieres eliminar todo?")
        if(!opcion){
            e.preventDefault();
        }
    }else if(e.target.matches(".destacar")){
        console.log("selecciono destacar");
        if(input_valido){
        }else{
            e.preventDefault();
            console.log("no selecciono ninguno")
            parrafo = `Selecciona al menos una opcion para destacar...<br> `;
            $error.innerHTML = parrafo
            $error.classList.remove("error_hidden");
            $error.classList.add("ubication_eliminar");
            setTimeout(() => {
                $error.classList.add("error_hidden");
                $error.classList.remove("ubication_eliminar");
            }, 6000);

        }

    }else if(e.target.matches(".quitar")){
        console.log("selecciono quitar")
        if(input_valido){
        }else{
            e.preventDefault();
            parrafo = `Selecciona al menos una opcion para quitar...<br> `;
            $error.innerHTML = parrafo
            $error.classList.remove("error_hidden");
            $error.classList.add("ubication_eliminar");
            setTimeout(() => {
                $error.classList.add("error_hidden");
                $error.classList.remove("ubication_eliminar");
            }, 6000);
        
        }
    };

})