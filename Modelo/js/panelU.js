$(document).ready(function(){
    $(".eliminar").click(function(){
        $(this).parent('td').parent('tr').remove();
        $.post('../admin/ejecuta.php',{
            Caso:'EliminarU',
            Id:$(this).attr('data-id')
        },function(e){
            alert(e);
        });
        window.location.replace("http://localhost/ProjectoPHP/Modelo/login/cerrar.php");
    });
    $(".modificar").click(function(){
        var nombre=$(this).parent('td').parent('tr').find('.nombre').val();
        var apellido=$(this).parent('td').parent('tr').find('.apellido').val();
        var usuario=$(this).parent('td').parent('tr').find('.usuario').val();
        var password=$(this).parent('td').parent('tr').find('.password').val();
        $.post('../admin/ejecuta.php',{
            Caso:'ModificarU',
            Id:$(this).attr('data-id'),
            Nombre:nombre,
            Apellido:apellido,
            Usuario:usuario,
            Password:password
        },function(e){
            alert(e);
        });
    });
});