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
            "order": [[ 0, "desc" ]],
            "lengthChange": false
            // CON CSS PONEMOS INVISIBLE EL SEARCH

        });  
    });
</script>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 fondoAzul1 text-center text-white pt-3">
        <span class="font-600">SOLICITUDES</span>
    </div>
    <div class="col-md-3"></div>
</div>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 divhei1 br-10 pt-3 text-center">
        <form class="text-center form-inline f13" method="post" >
            <label class="my-1 mr-2">FECHA</label>
            <input type="date" name="fechaInicio">
            <input type="date" name="fechaFinal">
            
            <label class="my-1 mr-2 ml-2">ESTADO</label>
            <select class="my-1 mr-sm-2" name="id_estado_solicitud">
                <option value="" selected>ELEGIR...</option>
                <?php foreach($estado_solicitud_all as $key=>$value): ?>
                    <option value="<?php echo $value->id ?>"><?php echo $value->descripcion ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="boton mr-2 pl-3 pr-3 pt-2 pb-2 fondoRojo1 ml-2  my-1 br-20 text-white">BUSCAR</button>
            <a href="admin/tecnico/elegirProducto" class="boton fondoRojo1 text-white br-20 pl-2 pr-2 pt-2 pb-2 f13"><i class="fas fa-plus"></i> SOLICITUD</a>
        </form>
    </div>
  
</div>


<div class="row mt-3">
    <div class="col-md-12">
        <table class="table tablaSole">
            <thead class="fondoAzul1 text-white">
                <tr>
                    <th>FECHA REGISTRO</th>
                    <th>SOLICITUD</th>
                    <th>CLIENTE</th>
                    <th>PRODUCTO</th>
                    <th>ESTADO</th>
                    <th>ACCIÓN</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($solicitud_all as $key=>$value): ?>
                    <tr class="fondoBlanco1 f13">
                        <td><?php echo substr($value->fechaRegistro,0,10)  ?></td>
                        <td><?php echo $value->id ?></td>
                        <td><?php echo $value->nombresCompletos_cliente ?></td>
                        <td><?php echo $value->producto_descripcion ?></td>
                        <td><?php echo $value->estado_solicitud_descripcion ?></td>

                        <td>
                            <a  class="editar"><img id_usuario="<?php echo $value->id ?>" src="static/images/lapiz.png" style="height:16px" class="pr-1"></a>   
                            <a  class="eliminar"><img id_usuario="<?php echo $value->id ?>" src="static/images/tacho.png" style="height:16px" class="pr-1"></a>
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