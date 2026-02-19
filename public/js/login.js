

$(document).ready(function() {
    const input = ["usuario", "password"];
 
    function enviar_datos(datos_usuario) {
        let datos = JSON.stringify(datos_usuario);
        $.ajax({
            type: "POST",
            url: "./app/controller/login_usuario.php",
            data: { "datos": datos },
            success: function (respuesta) {
                let respuesta_json = JSON.parse(respuesta);
                alert(respuesta_json[1]);
                if (respuesta_json[0] == '1') {
                    location.reload(true);
                }else{
                    windows.location = "./login.php";
                    document.getElementById('usuario').value = '';
                    document.getElementById('password').value = '';
                }
            }
        });  
    }

    function capturar_datos(){
        let datos = [];

        for (let i = 0; i < input.length; i++) {
            const valor = $("#" + input[i]).val();
            if (valor !== undefined && valor !== "") {
                datos[i] = valor;
            } else {
                alert("El campo " + $("[for=" + input[i] + "]").text() + " es obligatorio");
                $("#" + input[i]).focus();
                return;
            }
        }
        enviar_datos(datos);
    }

    function validar_vacios(){
        for (let i = 0; i < input.length; i++) {
            if ($("#" + input[i]).val() == "") {
                alert("El campo " + $("[for=" + input[i] + "]").text() + " es obligatorio");
                $("#" + input[i]).focus();
                break;
            }else{
            }
        }
        capturar_datos();
    }

    $('#btn_login').on('click', function(event){
        event.preventDefault();
        validar_vacios();
    });

    $('#password').on('keypress', function (e) {
        if (e.which === 13) {
            validar_vacios();
        }
    });

});