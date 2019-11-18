function stateButton(state){
    if(state == true){
        $('#info_data').show();
        //$('.userCodigo').show();
        $('#btn_consultar').prop('disabled', true);
        $('#btn_consultar').css('background', 'gray');
        $('#btn_nuevaBusqueda').show();
        //$('.informacion').show();
        $('.infoTareas').show();
        //$('.guia').show();
        //$('#info_data').show();
    }
    else{
        $('#btn_nuevaBusqueda').hide();
        $('#info_data').hide();
        $('.infoTareas').hide();
        $('.codigo_user').show();
    }
}
$(document).ready(function(){
    $("#btn_nuevaBusqueda").click(function(event){
        location = location;
    });
});

$(document).ready(function(){
    $("#btn_guardar").click(function(event){
        location = location;
    });
});

$(document).ready(function(){
    $("#btn_consultar").click(function(event){
        var codigo = document.getElementById("codigo").value;
        if(validacion(codigo)){
            $('.codigo_user').show();
            $(".txt_codigo").load("archivosPHP/obtenerTarea.php?codigo="+codigo);
            stateButton(true);
            $('.infoTareas').show();
            buscaMaterias(codigo);
        }else{
            alert("digita tu codigo, recuerda que debe ser un numero");
        }
    });
});

$(document).ready(function(){
    $("#btn_guardar").click(function(event){
        var tarea = document.getElementById("nomTarea").value;
        var codigoUser = document.getElementById("codUser").value;
        $.ajax({
            type: "POST",   
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            url: "archivosPHP/agregar.php",
            data: {nombre: tarea, codigo: codigoUser},
            complete: function(){
                
            },
        });
    });
});

function validacion(codigo){
    var valido = true;
    if(codigo == "" || isNaN(codigo)){
        valido = false;
    }
    return valido;
}



window.onload = function load(){    
    stateButton(false);
}

function buscaMaterias(codigo){

    function getMaterias(codigo){
        $(document).ready(function(){
            jQuery.getJSON("archivosJson/"+codigo+".json", function(data){
                for (let i = 0; i < data.length; i++) {
                    var materias = data[i];
                    var datos_materia = Object.values(materias);
                    organizaMaterias(datos_materia);
                }
                // borramos el primer div con id 'aclonar' 
                var elem = document.getElementById("aclonar");
                elem.parentNode.removeChild(elem);
            });
        }); 
    } 
    
    function getEstados(codigo){
        $(document).ready(function(){
            jQuery.getJSON("archivosJson/"+codigo+".json", function(estadoMateria){
                for (let i = 0; i < estadoMateria.length; i++) {
                    var estado = estadoMateria[i];
                    info_estado = Object.values(estado);
    
                    if(info_estado[2] == true){
                        console.log(info_estado[2]);
                        document.getElementById("materia_"+info_estado[0]).style.backgroundColor = 'gray';
                    }
                }
            });
        }); 
    } 
    
    $.when(getMaterias(codigo)).then(getEstados(codigo));
}

function organizaMaterias(datos_materia){
    var el = document.querySelector('.tareas');
    var clone = el.cloneNode(false);
    clone.id = "materia_"+datos_materia[0];
    clone.addEventListener('click', cambiaEstado); 
    
    var materia = document.createElement("p");
    var m =  document.createTextNode(datos_materia[0]);
    materia.appendChild(m);
    materia.id = "materia_"+datos_materia[0];
    
    var credito = document.createElement("p");
    var c = document.createTextNode(datos_materia[1]);
    credito.appendChild(c);
    credito.id = "creditos"; 
    
    clone.appendChild(materia);
    clone.appendChild(credito);
    document.getElementById("tareas").appendChild(clone);
    
}

function cambiaEstado(){
    var idMateria = event.target.id;
    idMateria = idMateria.substring(8);
    var codigo = document.getElementById("codigo").value;
    if(this.style.backgroundColor == 'gray'){
        this.style.backgroundColor = '#43A047';
        estado = false;
    }else{
        this.style.backgroundColor = 'gray';
        estado = true; 
    }
    //var datos = {nombreTarea: idMateria, codigoUsuario: codigo, state: estado};
    /* enviamos la actualizacion al servidor */
    $.ajax({
        type: "POST",   
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        url: "archivosPHP/actualizarTarea.php",
        data: {nombreTarea: idMateria, codigoUsuario: codigo, state: estado} ,
        complete: function (result) {

        },
    });
}