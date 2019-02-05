$(document).ready(function(){
    $(".eliminar").click(function(){
        $(this).parent('td').parent('tr').remove();
        $.post('../Modelo/admin/ejecuta.php',{
            Caso:'EliminarU',
            Id:$(this).attr('data-id')
        },function(e){
            alert(e);
        });

    });
    $(".modificar").click(function(){
        var nombre=$(this).parent('td').parent('tr').find('.nombre').val();
        var apellido=$(this).parent('td').parent('tr').find('.apellido').val();
        var usuario=$(this).parent('td').parent('tr').find('.usuario').val();
        var password=$(this).parent('td').parent('tr').find('.password').val();
        $.post('../Modelo/admin/ejecuta.php',{
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