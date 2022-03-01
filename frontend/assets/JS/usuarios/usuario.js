$(document).ready(function () {
    $(document).on('click', '#boton-login', function () {
        Usuarios.listado_empleados();
    });
});
var Usuarios = {

    listado_empleados: function () {
        $('#tbodyTableroEmpleados').html('<tr><td colspan="6" style="text-align: center"><span class="spinner-border"></span>Procesando Datos</td></tr>');
        $.ajax({
            type: 'get',
            url: URL_BACKEND + 'peticion=usuarios&funcion=individual&usuario='+ $('#username-email').val()+'&password='+$('#password').val(), // url de consumo del servicio
           //url: URL_BACKEND + 'peticion=usuarios&funcion=individual',
           data: {},
            dataType: 'json',
            success: function (respuestaAjax) {
                if(respuestaAjax.success){
                    $(location).attr('href','/Empleados_backend/frontend/page/home.html');
                }else{
                    var html_msg_error = '<div class="alert alert-warning">';
                    respuestaAjax.msg.forEach(function(elemento){
                        html_msg_error += '<li>'+elemento+'</li>';
                    });
                    html_msg_error += '</div>';
                    $('#mensajes_sistema').html(html_msg_error);
                    setTimeout(function(){
                        $('#mensajes_sistema').html('');
                    },5000);
                }
            },
            error: function (error) {
                console.log(error);
                alert('error en el catalogo');
            }
        });
    },
};