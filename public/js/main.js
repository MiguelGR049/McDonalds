function validar_campos(arreglo) {
    for (let i = 0; i < arreglo.length; i++) {
        if ($("#" + arreglo[i]).val() == "") {
            alert(`El campo ${$("[for=" + arreglo[i] + "]").text()} no puede ir vacio!!!`);
            return false;
        }
    }
    return true;
}

function solicitar_datos() {
    $.ajax({
        url: "./app/controller/consulta.php",
        success: function (respuesta) {
            let respuesta_json = JSON.parse(respuesta);
            let contenido = ``;
            if (respuesta_json[0] == '1') {
                for (let i = 0; i < respuesta_json[1].length; i++) {
                    contenido += `
                        <tr>
                            <th>${respuesta_json[1][i].id_anime}</th>
                            <td>${respuesta_json[1][i].nombre}</td>
                            <td>${respuesta_json[1][i].temporada}</td>
                            <td>${respuesta_json[1][i].capitulos}</td>
                            <td>${respuesta_json[1][i].genero}</td>
                            <td>${respuesta_json[1][i].visto}</td>
                            <td>${respuesta_json[1][i].fecha}</td>
                            <td>
                            <button type="button" class="btn btn-warning" onclick="precargar(${respuesta_json[1][i].id_anime})">
                            <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger" onclick="eliminar(${respuesta_json[1][i].id_anime})">
                            <i class="fa-regular fa-trash-can"></i>
                            </button>
                            </td>
                        </tr>`;
                }
                $("#contenido_tabla").html(contenido);
            } else {
                contenido = respuesta_json[1];
            }
        }
    });
}

function eliminar(id) {
    let elimina = confirm("Seguro que quieres eliminar este producto?");
    if (elimina) {
        $.ajax({
            type: "GET",
            url: "./app/controller/eliminar_anime.php?id=" + id,
            success: function (respuesta) {
                let respuesta_json = JSON.parse(respuesta);
                if (respuesta_json[0] == '1') {
                    solicitar_datos();
                } else {
                    alert(respuesta_json[1]);
                }
            }
        });
    }
}

function precargar(id) {
    $.ajax({
        type: "GET",
        url: "./app/controller/precarga_anime.php?id=" + id,
        success: function (respuesta) {
            let respuesta_json = JSON.parse(respuesta);
            if (respuesta_json[0] == '1') {
                $("#id_act_anime").val(respuesta_json[1].id_anime);
                $("#act_nombre").val(respuesta_json[1].nombre);
                $("#act_temporada").val(respuesta_json[1].temporada);
                $("#act_capitulos").val(respuesta_json[1].capitulos);
                $("#act_genero").val(respuesta_json[1].genero);
                $("#act_visto").val(respuesta_json[1].visto);
                $("#editarModal").modal('show');
            } else {
                alert(respuesta_json[1]);
            }
        }
    });
}

function actualizar() {
    if (validar_campos([])) {

        let datos = [
            $("#id_act_anime").val(),
            $("#act_nombre").val(),
            $("#act_temporada").val(),
            $("#act_capitulos").val(),
            $("#act_genero").val(),
            $("#act_visto").val(),
        ];

        $.ajax({
            type: "POST",
            url: "./app/controller/actualizar_anime.php",
            data: { "datos": datos },
            success: function (respuesta) {
                let respuesta_json = JSON.parse(respuesta);
                if (respuesta_json[0] == 1) {
                    solicitar_datos();
                    $("#editarModal").modal('hide');
                }
                alert(respuesta_json[1]);
            }
        });
    }
}

function agregar_datos() {
    let contenido;
    contenido = [
        $("#agre_nombre").val(),
        parseInt($("#agre_temporada").val()),
        parseInt($("#agre_capitulos").val()),
        $("#agre_genero").val(),
        $("#agre_visto").val()
    ];
    let anime = JSON.stringify(contenido);
    $.ajax({
        type: "POST",
        url: "./app/controller/agregar_anime.php",
        data: { "anime": anime },
        success: function (respuesta) {
            let respuesta_json = JSON.parse(respuesta);
            console.log(respuesta_json);
            $("#agregarModal").modal('hide');
            document.getElementById('agre_nombre').value = '';
            document.getElementById('agre_temporada').value = '';
            document.getElementById('agre_capitulos').value = '';
            document.getElementById('agre_genero').value = '';
            document.getElementById('agre_visto').value = '';
            solicitar_datos();
        }
    });
}

function buscarAnime() {
    let nombre = $('#buscar').val().toLowerCase();
    $.ajax({
        type: "POST",
        url: "./app/controller/buscar_anime.php",
        data: { "nombre": nombre },
        success: function (respuesta) {
            let respuesta_json = JSON.parse(respuesta);
            console.log(respuesta_json);
            let contenido = ``;
            if (respuesta_json[0] == '1') {
                for (let i = 0; i < respuesta_json[1].length; i++) {
                    contenido += `
                            <tr>
                            <th>${respuesta_json[1][i].id_anime}</th>
                            <td>${respuesta_json[1][i].nombre}</td>
                            <td>${respuesta_json[1][i].temporada}</td>
                            <td>${respuesta_json[1][i].capitulos}</td>
                            <td>${respuesta_json[1][i].genero}</td>
                            <td>${respuesta_json[1][i].visto}</td>
                            <td>${respuesta_json[1][i].fecha}</td>
                            <td>
                            <button type="button" class="btn btn-warning" onclick="precargar(${respuesta_json[1].id_anime})">
                            <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger" onclick="eliminar(${respuesta_json[1].id_anime})">
                            <i class="fa-regular fa-trash-can"></i>
                            </button>
                            </td>
                            </tr>
                        `;
                    $("#offcanvasDarkNavbar").offcanvas('hide');
                    document.getElementById('buscar').value = '';
                    $("#contenido_tabla").html(contenido);
                }
            } else {
                alert(respuesta_json[1]);
            }
        },
        error: function () {
            alert("No se encontró el Anime");
        }
    });
}

$('#item_genero').on('click', '.dropdown-item', function () {
    let genero = $(this).data('genero');
    $.ajax({
        type: "POST",
        url: "./app/controller/buscar_genero.php",
        data: { "genero": genero },
        success: function (respuesta) {
            let respuesta_json = JSON.parse(respuesta);
            console.log(respuesta_json);
            let contenido = ``;
            if (respuesta_json[0] == '1') {
                for (let i = 0; i < respuesta_json[1].length; i++) {
                    contenido += `
                        <tr>
                            <th>${respuesta_json[1][i].id_anime}</th>
                            <td>${respuesta_json[1][i].nombre}</td>
                            <td>${respuesta_json[1][i].temporada}</td>
                            <td>${respuesta_json[1][i].capitulos}</td>
                            <td>${respuesta_json[1][i].genero}</td>
                            <td>${respuesta_json[1][i].visto}</td>
                            <td>${respuesta_json[1][i].fecha}</td>
                            <td>
                            <button type="button" class="btn btn-warning" onclick="precargar(${respuesta_json[1][i].id_anime})">
                            <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger" onclick="eliminar(${respuesta_json[1][i].id_anime})">
                            <i class="fa-regular fa-trash-can"></i>
                            </button>
                            </td>
                        </tr>`;
                }
                $("#offcanvasDarkNavbar").offcanvas('hide');
                $("#contenido_tabla").html(contenido);
            } else {
                contenido = respuesta_json[1];
            }
        },
        error: function () {
            alert("No se encontró el genero");
        }
    });
});

$('#item_visto').on('click', '.dropdown-item', function () {
    let visto = $(this).data('visto');
    $.ajax({
        type: "POST",
        url: "./app/controller/buscar_visto.php",
        data: { "visto": visto },
        success: function (respuesta) {
            let respuesta_json = JSON.parse(respuesta);
            console.log(respuesta_json);
            let contenido = ``;
            if (respuesta_json[0] == '1') {
                for (let i = 0; i < respuesta_json[1].length; i++) {
                    contenido += `
                        <tr>
                            <th>${respuesta_json[1][i].id_anime}</th>
                            <td>${respuesta_json[1][i].nombre}</td>
                            <td>${respuesta_json[1][i].temporada}</td>
                            <td>${respuesta_json[1][i].capitulos}</td>
                            <td>${respuesta_json[1][i].genero}</td>
                            <td>${respuesta_json[1][i].visto}</td>
                            <td>${respuesta_json[1][i].fecha}</td>
                            <td>
                            <button type="button" class="btn btn-warning" onclick="precargar(${respuesta_json[1][i].id_anime})">
                            <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger" onclick="eliminar(${respuesta_json[1][i].id_anime})">
                            <i class="fa-regular fa-trash-can"></i>
                            </button>
                            </td>
                        </tr>`;
                }
                $("#offcanvasDarkNavbar").offcanvas('hide');
                $("#contenido_tabla").html(contenido);
            } else {
                contenido = respuesta_json[1];
            }
        },
        error: function () {
            alert("No se encontró el visto");
        }
    });
});

$(document).on('click', '#home, #navbar_brand', function () {
    solicitar_datos();
});

$('#btn_buscar',).on('click', function (event) {
    event.preventDefault();
    buscarAnime();
});

$('#buscar').on('keypress', function (e) {
    if (e.which === 13) {
        buscarAnime();
    }
});

$('#btn_actualizar').on('click', function () {
    actualizar();
});

solicitar_datos();
