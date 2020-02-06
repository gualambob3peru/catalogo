<script>
    $(function(){
        $(".eliminar").click(function(){

            
            let id_noti = $(this).attr("id_noti");
            $(".modalEliminar").modal();

            $("#urlEliminar").attr("href","admin/usuario/eliminarCorreo/"+id_noti);

            return false;
        });
    })
</script>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 fondoAzul1 text-center text-white pt-3">
        <a href="admin/usuario/administraNotificacion"><i class="text-white fas fa-arrow-left float-left f20 pt-1"></i></a>
        <span class="font-600">CUENTAS DE <?php echo $tipo->descripcion ?></span>
    </div>
    <div class="col-md-3"></div>
</div>

<div class="row mt-2">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 fondoBlanco1 br-10 pt-3 h-auto">
        <form action="" method="post">
            <?php echo form_error('email', '<div class="colorRojo1">', '</div>'); ?>
            <br>
            <div class="input-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Escribir correo electrónico" aria-label="Correo" aria-describedby="button-addon2" style="height:38px" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-danger" type="submit" id="button-addon2">+</button>
                </div>
                
            </div>
            
        </form>
    </div>
    <div class="col-md-3"></div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <table class="table tablaSole">
            <tbody class="fondoBlanco1">
                <?php foreach($correos as $key=>$value): ?>
                <tr>
                    <td>
                        <?php echo $value->email ?>
                    </td>
                    <td>
                        <a href="#" class="eliminar" id_noti="<?php echo $value->id  ?>"><img class="pr-3" style="height:25px" src="static/images/tacho.png" alt=""></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-3"></div>
</div>


<div class="modal modalEliminar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar correo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Desea Eliminar?</p>
      </div>
      <div class="modal-footer">
        <a href="" id="urlEliminar" class="fondoRojo1 text-white br-10 boton p-2">Aceptar</a>
        <button type="button" class="fondoAzul1 text-white br-10 boton p-2" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>