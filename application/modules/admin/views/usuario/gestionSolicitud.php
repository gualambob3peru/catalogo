<style>
    .miImagen{cursor:pointer}
    .dataTables_wrapper .row:first-child {display:none}
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


<script>
    $(function(){
        $(".opcion").click(function(){
            let opcion = $(this).attr("opcion"),
                id_solicitud = $(this).attr("id_solicitud"),
                mensaje = "";
            
            $(".modalCambioEstado").attr({opcion:opcion,id_solicitud:id_solicitud});
            $(".modalCambioEstado").find(".modal-title").text("¿Desea realizar acción?")

            switch (opcion) {
                case "1":
                    mensaje = "¿Desea aprobar la solicitud?";
                    break;
                case "2":
                    mensaje = "¿Desea rechazar la solicitud?";
                    break;
                case "2":
                    mensaje = "¿Desea eliminar la solicitud?";
                    break;    
                default:
                    break;
            }
            $(".modalCambioEstado").find(".modal-body p").text(mensaje)
            
            $(".modalCambioEstado").modal();
            

            return false;
        });

        $(".btnCambioEstado").click(function(){
            let modal = $(this).parents(".modalCambioEstado").eq(0),
                opcion = modal.attr("opcion"),
                id_solicitud = modal.attr("id_solicitud");
            
            $.ajax({
                url : "admin/usuario/ajaxCambioEstadoSolicitud",
                type:"post",
                dataType : "json",
                data : {
                    id_solicitud : id_solicitud,
                    id_estado_solicitud : opcion 
                },
                error : function(ee){
                    console.log(ee);
                },
                success : function(response){
                    if(response.respuesta==1){
                        $(".modalCambioEstado").modal("hide");
                        _modalMensaje("Mensaje", "Resultado exitoso", "Aceptar","fondoAzul1");
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }else{
                        $(".modalCambioEstado").modal("hide");
                        _modalMensaje("Mensaje", "No se pudo realizar la acción", "Aceptar","fondoRojo1");
                    }

                }
            })
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

<div class="row mt-2">
    <div class="col-md-12">
        <form class="form-inline f13" method="post" >
            <label class="my-1 mr-2">FECHA</label>
            <input type="date" name="fechaInicio">
            <input type="date" name="fechaFinal">

            <label class="my-1 mr-2 ml-2">SOLICITUD</label>
            <input type="text" placeholder="SOLICITUD" size="6" name="solicitud">
            
            <label class="my-1 mr-2 ml-2">ESTADO</label>
            <select class="my-1 mr-sm-2" name="id_estado_solicitud">
                <option value="" selected>ELEGIR...</option>
                <?php foreach($estado_solicitud_all as $key=>$value): ?>
                    <option value="<?php echo $value->id ?>"><?php echo $value->descripcion ?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" placeholder="TÉCNICO" size="16" name="tecnico">
            <input type="text" class="ml-2" placeholder="CLIENTE" size="16" name="cliente">

            <button type="submit" class="boton pl-3 pr-3 pt-2 pb-2 fondoRojo1 ml-2  my-1 br-20 text-white">BUSCAR</button>
        </form>
    </div>
</div>


<div class="row mt-3">
    <div class="col-md-12">
        <table class="table tablaSole f14">
            <thead class="fondoAzul1 text-white">
                <tr>
                    <th>FECHA SOLICITUD</th>
                    <th>FECHA ESTADO</th>
                    <th>SOLICITUD</th>
                    <th>TÉCNICO</th>
                    <th>CLIENTE</th>
                    <th>UBICACIÓN</th>
                    <th>ESTADO</th>
                    <th>ACCIÓN</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($solicitud_all as $key=>$value): ?>
                    <tr class="fondoBlanco1 ">
                        <td><?php echo substr($value->fechaRegistro,0,10)  ?></td>
                        <td><?php echo substr($value->fechaEstado,0,10) ?></td>
                        <td><?php echo $value->id ?></td>
                        <td><?php echo $value->nombresCompletos_usuario ?></td>
                        <td><?php echo $value->nombresCompletos_cliente ?></td>
                        <td><?php echo $value->distrito ?></td>
                        <td><?php echo $value->estado_solicitud_descripcion ?></td>
                        
                        <td>

                            <a href="#" id_solicitud="<?php echo $value->id ?>" opcion="1" class="opcion"><img id_usuario="<?php echo $value->id ?>" src="static/images/check.png" style="height:16px" class="pr-1"></a> 

                            <a href="#" id_solicitud="<?php echo $value->id ?>" opcion="2" class="opcion"><img id_usuario="<?php echo $value->id ?>" src="static/images/equis.png" style="height:16px" class="pr-1"></a>

                            <a href="#" id_solicitud="<?php echo $value->id ?>" opcion="3" class="opcion"><img id_usuario="<?php echo $value->id ?>" src="static/images/tacho.png" style="height:16px" class="pr-1"></a>

                            <a href="#" id_solicitud="<?php echo $value->id ?>" class="detalle"><img id_usuario="<?php echo $value->id ?>" src="static/images/lupa.png" style="height:16px" class="pr-1"></a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>



<div class="modal modalCambioEstado" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="boton fondoAzul1 br-10 text-white p-2 btnCambioEstado">Aceptar</button>
        <button type="button" class="boton fondoRojo1 br-10 text-white p-2" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


