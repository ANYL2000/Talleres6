/*$(document).ready(function(){
$(document).on("click","#buscar",function(){

    var id = $("#codigo").val();

    let cod = $("#cod").text();
    let name = $("#name").text();
    let carrera = $("#carrer").text();

   // $('#suscribeModal').modal('show');
console.log(cod);
console.log(name);
console.log(carrera);

    $('#recipient-codigo').val(cod);
    $('#recipient-nombre').val(name);
    $('#recipient-carrera').val(carrera);

});

});

function mostrar(cod){
    var codigo = $('#codigo').val();

    //console.log(codigo);
   
}


if(document.getElementById("btnModal")){
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("btnModal");
    var span = document.getElementsByClassName("close")[0];
    var body = document.getElementsByTagName("body")[0];

    btn.onclick = function() {
        modal.style.display = "block";

        body.style.position = "static";
        body.style.height = "100%";
        body.style.overflow = "hidden";
    }

    span.onclick = function() {
        modal.style.display = "none";

        body.style.position = "inherit";
        body.style.height = "auto";
        body.style.overflow = "visible";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";

            body.style.position = "inherit";
            body.style.height = "auto";
            body.style.overflow = "visible";
        }
    }
}*/

