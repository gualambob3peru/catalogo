<style>
    .miImagen{cursor:pointer}
    .dataTables_wrapper .row:first-child {display:none}
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


<script>
    $(function(){
        let miTabla = $(".tablaSole").DataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            },
            "lengthChange": false
            // CON CSS PONEMOS INVISIBLE EL SEARCH

        });
        


        $('#txtBuscar').on( 'keyup', function () {
            miTabla.search( this.value ).draw();
        } );

        $(".miImagen").click(function(){
            $(".modalImagen").modal();
            $("#fotoModal").attr("src",$(this).attr("src"));
        });

        $(".eliminar").click(function(){
            let id = $(this).find("img").attr("id_usuario");
            console.log(id);
            
            $("#btnEliminar").attr("id_usuario",id);
            $(".modalEliminar").modal();

            return false;
        });

        $("#btnEliminar").click(function(){
            let $this = $(this);

            $this.prop("disabled",true);
            let id = $this.attr("id_usuario");
            console.log(id);
            
            $.ajax({
                url : "admin/usuario/ajaxDelete",
                type : "post",
                dataType : "json",
                data : {
                    id : id
                },
                error : function(a,b){
                    $this.prop("disabled",false);
                },
                success : function(response){
                    $this.prop("disabled",false);
                    if(response.respuesta==1){
                        _modalMensaje("Mensaje", "Usuario Eliminado Correctamente", "Aceptar","fondoAzul1");
                        $(".modalEliminar").modal("hide");
                        setTimeout(function(){
                            location.reload();
                        },1000);
                    }else{
                        _modalMensaje("Mensaje", "No se pudo eliminar el usuario", "Aceptar","fondoRojo1");
                        $(".modalEliminar").modal("hide");
                    }
                    
                }
            });
        });
    });
</script>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 fondoAzul1 text-center text-white pt-3">
        <a href="admin/usuario/menu"><i class="text-white fas fa-arrow-left float-left f20 pt-1"></i></a>
        <span class="font-600">USUARIOS / TÉCNICOS</span>
    </div>
    <div class="col-md-3"></div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 pt-3 text-center">
        <span class="f12 mr-2">NOMBRE DE USUARIO:</span>
        <input type="text" class="mr-2" id="txtBuscar">
        <button class="boton fondoRojo1 text-white br-20 pl-4 pr-4 pt-2 pb-2 f13">BUSCAR</button>
        <a href="admin/usuario/nuevoUsuario" class="boton fondoAzul1 text-white br-20 pl-2 pr-2 pt-2 pb-2 f13"><i class="fas fa-plus"></i> Usuario</a>
    </div>
    <div class="col-md-3"></div>
</div>


<div class="row mt-3">
    <div class="col-md-12">
        <table class="table tablaSole">
            <thead class="fondoAzul1 text-white">
                <tr>
                    <th>ID</th>
                    <th>FOTO</th>
                    <th>NOMBRES</th>
                    <th>APELLIDOS</th>
                    <th>PERFIL</th>
                    <th>DNI</th>
                    <th>CORREO</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($usuarios as $key=>$value): ?>
                    <tr class="fondoBlanco1 ">
                        <td><?php echo $value->id ?></td>
                        <td><img class="miImagen" style="height:38px" src="static/images/usuario/<?php echo $value->id ?>/<?php echo $value->foto ?>" onerror="_imgError(this);"></td>
                        <td><?php echo strtoupper($value->nombres) ?></td>
                        <td><?php echo strtoupper($value->apellidoPaterno." ".$value->apellidoMaterno) ?></td>
                        <td><?php echo $value->tipo_usuario_desc ?></td>
                        <td><?php echo $value->nroDocumento ?></td>
                        <td><?php echo $value->usuario ?></td>
                        <td>
                            <a href="admin/usuario/editar/<?php echo $value->id ?>" class="editar"><img id_usuario="<?php echo $value->id ?>" src="static/images/lapiz.png" style="height:16px" class="pr-1"></a>  
                            <a href="#" class="eliminar"><img id_usuario="<?php echo $value->id ?>" src="static/images/tacho.png" style="height:16px" class="pr-1"></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>


<div class="modal modalImagen" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Foto de Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <img id="fotoModal" src="" class="img-fluid" alt="Foto de usuario">
        </div>
        <div class="modal-footer">
           
            <button type="button" class="fondoAzul1 text-white boton br-10 pl-3 pr-3 pt-2 pb-2" data-dismiss="modal">Aceptar</button>
        </div>
        </div>
    </div>
</div>

<div class="modal modalEliminar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Eliminar Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            ¿Esta seguro que desea eliminar el usuario?
        </div>
        <div class="modal-footer">
            <button id="btnEliminar" type="button" class="fondoAzul1 text-white boton br-10 pl-3 pr-3 pt-2 pb-2">Aceptar</button>
            <button type="button" class="fondoRojo1 text-white boton br-10 pl-3 pr-3 pt-2 pb-2" data-dismiss="modal">Cancelar</button>
        </div>
        </div>
    </div>
</div>