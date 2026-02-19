function cerrar_sesion() {
    $.ajax({
        url: "./app/controller/cerrar_login.php",
        success: function (respuesta) {
            let respuesta_json = JSON.parse(respuesta);
            if (respuesta_json[0] == 1) {
                alert(respuesta_json[1]);
                location.reload(true);
                windows.location = "./login.php";
            }else{
                alert(respuesta_json);
            }
        }
    });  
}
$('#btn_cerrar_sesion').on('click', function(event){
    event.preventDefault();
    cerrar_sesion();
});