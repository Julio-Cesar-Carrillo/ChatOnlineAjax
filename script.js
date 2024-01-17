// ----------------------
// LISTAR AMIGOS
// ----------------------

ListarAmigos('');

function ListarAmigos() {
    var listaamigos = document.getElementById('listaamigos');
    var formdata = new FormData();
    var ajax = new XMLHttpRequest();

    ajax.open('POST', './conexion/amigos.php');
    ajax.onload = function () {
        if (ajax.status === 200) {
            var json = JSON.parse(ajax.responseText);
            var tabla = '';

            json.forEach(function (item) {
                var str = "<tr>";
                str += "<td>" + item.user_user + "</td>";
                str += "<td>" + item.nom_user + " " + item.cognom_user + "</td>";
                str += "<td><button type='button' class='btn btn-success' onclick='Chat(" + item.id_u + ", \"" + item.user_user + "\")'>Chat</button>";
                str += " <button type='button' class='btn btn-danger' onclick='Eliminar(" + item.id_s + ", \"" + item.user_user + "\")'>Eliminar</button>";
                str += '</td></tr>';
                tabla += str;
            });

            listaamigos.innerHTML = tabla;
        } else {
            listaamigos.innerText = 'Error al cargar los amigos, estamos trabajando en ello';
        }
    };

    ajax.send(formdata);
}

// ----------------------
// ELIMINAR AMIGO
// ----------------------

function Eliminar(id, user_user) {
    Swal.fire({
        title: '¿Está seguro de eliminar a ' + user_user + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'NO'
    }).then((value) => {
        if (value.isConfirmed) {
            var formdata = new FormData();
            formdata.append('id', id);

            var ajax = new XMLHttpRequest();
            ajax.open('POST', './acciones/eliminar.php');

            ajax.onload = function () {
                if (ajax.status === 200) {
                    if (ajax.responseText === "ok") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Eliminado',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            ListarAmigos('');
                        });
                    }
                }
            };

            ajax.send(formdata);
        }
    });
}

// ----------------------
// Ver mensajes
// ----------------------

function Chat(id_u, user_user) {

    let Mensajes = document.getElementById('mensajes');
    let formdata32 = new FormData();
    let ajax = new XMLHttpRequest();
    formdata32.append('id_u', id_u);

    ajax.open('POST', './conexion/mensajes.php');

    ajax.onload = function () {

        if (ajax.status === 200) {
            json = JSON.parse(ajax.responseText);
            let msjchat = "<div style='background-color: #f5f5f5; padding: 10px; border-radius: 8px; margin-bottom: 10px;'>";
            msjchat += "<h2 style='color: #333;'>Conversación con: " + user_user + "</h2>";

            json.forEach(function (item) {
                if (item.user_emi_chat === id_u) {
                    msjchat += "<p style='text-align: left; color: #333; margin: 5px 0;'>" + item.fecha + " " + item.historial_chat + "</p>";
                } else {
                    msjchat += "<p style='text-align: right; color: #333; margin: 5px 0;'>" + item.historial_chat + " " + item.fecha + "</p>";
                }
            });

            let formulario = "<div style='background-color: white; padding: 10px; border-radius: 8px;'>";
            formulario += "<form>";
            formulario += '<input type="text" id="msj" style="width: 70%; padding: 5px;" placeholder="Mensaje de 100 caracteres" oninput="validarMensaje()">';
            formulario += "<button type='button' style='background-color: #3498db; color: #fff; padding: 5px 10px; border: none; border-radius: 4px;' onclick='enviarMensaje(" + id_u + ", \"" + user_user + "\")'>Enviar</button>";
            formulario += '<p id="mensajeError" style="color: red; font-size: 12px;"></p>'; // Nuevo span para mensajes de error
            formulario += "</form></div>";
            // Concatenar los párrafos y el formulario en el contenedor
            msjchat += formulario;

            Mensajes.innerHTML = msjchat;
        } else {
            Mensajes.innerText = 'Error en la solicitud AJAX';
        }
    };

    ajax.send(formdata32);
}
function validarMensaje() {
    var mensajeInput = document.getElementById('msj');
    var mensajeError = document.getElementById('mensajeError');
    var mensaje = mensajeInput.value;

    mensajeError.innerHTML = ''; // Limpiar mensajes de error anteriores

    if (mensaje.trim() === '') {
        mensajeError.innerHTML = 'El mensaje no puede estar vacío.';
        mensajeInput.value = ''; // Limpiar el campo si está vacío
        return;
    }

    if (mensaje.length > 100) {
        mensajeError.innerHTML = 'El mensaje no puede tener más de 100 caracteres.';
        mensajeInput.value = mensaje.substring(0, 100); // Trunca el mensaje si es demasiado largo
    }
}
// ----------------------
// Enviar mensaje
// ----------------------

function enviarMensaje(id_u, user_user) {
    var formDataChat = new FormData();
    formDataChat.append('id_u', id_u);
    formDataChat.append('msj', document.getElementById('msj').value);

    var ajax = new XMLHttpRequest();
    ajax.open('POST', './acciones/envmensaje.php');

    ajax.onload = function () {
        if (ajax.status === 200) {
            if (ajax.responseText === "ok") {
                ListarPendientes('');
                Chat(id_u, user_user);
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Error al enviar el mensaje, Vuelve a intentarlo más tarde',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    ListarPendientes('');
                    Chat(id_u, user_user);
                });
            }
        }
    };

    ajax.send(formDataChat);
}

// ----------------------
// LISTAR BUSQUEDA AMIGO
// ----------------------

buscar.addEventListener("keyup", function () {
    const valor = buscar.value;
    if (valor !== "") {
        ListarBusqueda(valor);
    }
});

function ListarBusqueda(valor) {
    var busquedaresult = document.getElementById('busquedaresult');
    var formdata3 = new FormData();
    formdata3.append('busqueda', valor);
    var ajax = new XMLHttpRequest();
    ajax.open('POST', './conexion/amigos.php');
    ajax.onload = function () {
        if (ajax.status == 200) {
            var json = JSON.parse(ajax.responseText);
            var formulario = '<form id="frmañadir">';
            json.forEach(function (item) {
                formulario += '<tr style="width: fit-content;">';
                formulario += '<td><input style="width: fit-content; border: none; outline: none; background: transparent; color: white; text-align: center;" type="text" id="id" value="' + item.user_user + '" readonly></td>';
                formulario += '<td><input style="width: fit-content; border: none; outline: none; background: transparent; color: white; text-align: center;" type="text" id="nom_user" value="' + item.nom_user + " " + item.cognom_user + '"readonly "></td>';
                formulario += "<td><button type='button' class='btn btn-success' style='width: fit-content' onclick='agregar(" + item.id + ",\"" + item.user_user + "\")'>Agregar</button></td>";
                formulario += '</tr>';
            });
            formulario += '</form>';
            busquedaresult.innerHTML = formulario;
        } else {
            busquedaresult.innerText = 'Error';
        }
    }
    ajax.send(formdata3);
}

// ----------------------
// Agregar amigo
// ----------------------

function agregar(id, user_user) {
    Swal.fire({
        title: '¿Está seguro de agregar a ' + user_user + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'NO'
    }).then((value) => {
        if (value.isConfirmed) {
            var formdata = new FormData();
            formdata.append('id', id);

            var ajax = new XMLHttpRequest();
            ajax.open('POST', './acciones/agregar.php');

            ajax.onload = function () {
                if (ajax.status === 200) {
                    if (ajax.responseText === "ok") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Solicitud enviada',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            ListarBusqueda();
                            ListarPendientes('');
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Ya tienes agregado a este usuario',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            ListarBusqueda();
                            ListarPendientes('');
                        });
                    }
                }
            };
            ajax.send(formdata);
        }
    });
}

// ----------------------
// LISTAR SOLICITUDES PENDIENDES
// ----------------------

ListarPendientes('');

function ListarPendientes() {
    var pendientes = document.getElementById('pendientes');
    var formdata4 = new FormData();
    var ajax = new XMLHttpRequest();
    ajax.open('POST', './conexion/solicitud.php');
    ajax.onload = function () {
        var str = "";
        if (ajax.status == 200) {
            var json = JSON.parse(ajax.responseText);
            var tabla = '';
            json.forEach(function (item) {
                str = "<tr><td>" + item.user_user + "</td>";
                str = str + "<td>" + item.nom_user + "</td>";
                str = str + "<td><button type='button' class='btn btn-success' onclick='aceptar_amigo(" + item.id + ", \"" + item.user_user + "\")'>Aceptar</button>";
                str = str + " <button type='button' class='btn btn-danger' onclick=" + "Eliminar(" + item.id + ")>Rechazar</button></td></tr>";
                tabla += str;
            });
            pendientes.innerHTML = tabla;
        } else {
            pendientes.innerText = 'Error al cargar los Solocitudes, estamos trabajando en ello';
        }
    }
    ajax.send(formdata4);
}

function aceptar_amigo(id, user_user) {
    Swal.fire({
        title: '¿Está seguro de aceptar a ' + user_user + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'NO'
    }).then((value) => {
        if (value.isConfirmed) {
            var formdata = new FormData();
            formdata.append('id', id);

            var ajax = new XMLHttpRequest();
            ajax.open('POST', './acciones/aceptar_amigo.php');

            ajax.onload = function () {
                if (ajax.status === 200) {
                    if (ajax.responseText === "ok") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Ahora eres amigo de ' + user_user + '',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            ListarPendientes('');
                            ListarAmigos('');
                        });
                    }
                }
            };
            ajax.send(formdata);
        }
    });
}