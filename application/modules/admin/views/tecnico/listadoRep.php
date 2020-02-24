<style>
    .miImagen{cursor:pointer}
    .dataTables_wrapper .row:first-child {display:none}
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


<script>
    $(function(){
        $(".siguiente").click(function(){
            let a = 0;
            $(".cantidad").each(function(key,value){
                let cantidad = $(this).val(),
                    miCheck  = $(".miCheck").eq(key).is(":checked");
                   

                if(cantidad!="" && miCheck){
                    a = 1;
                }
                
            });

            if(a==0){
                _modalMensaje("Mensaje", "Debe llenar al menos una cantidad y repuesto", "Aceptar","boton fondoRojo1");
                
            }else{
                $("#miForm").submit();
            }
            return false;
        });


    });
</script>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 fondoAzul1 text-center text-white pt-3">
        <a href="admin/tecnico/nuevaSolicitud"><i class="text-white fas fa-arrow-left float-left f20 pt-1"></i></a>
        <span class="font-600">LISTADO DE COMPONENTES</span>
    </div>
    <div class="col-md-3"></div>
</div>

<div class="row mt-2">
    <div class="col-md-2"></div>
    <div class="col-md-8 divhei1 br-10 fondoBlanco1 text-center pt-3 f13">
        <div class="row">
            <div class="col-md-9 mt-1">
                <span class="font-600 colorRojo1">PRODUCTO ASOCIADO: </span>
                <span class="font-600 colorAzul1"> <?php echo $producto->descripcion ?> </span>
            </div>
            <div class="col-md-3">
                <a href="#" class="siguiente text-right boton fondoRojo1 text-white br-20 pl-3 pr-3 pt-2 pb-2">Siguiente</a>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

<div class="row mt-3">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form action="admin/tecnico/resumenSolicitud" method="post" id="miForm">
            <table class="table tablaSole f12">
                <thead class="fondoAzul1 text-white">
                    <tr>
                        <th>SKU</th>
                        <th>DESCRIPCION</th>
                        <th>UM</th>
                        <th>STOCK</th>
                        <th>CANTIDAD</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($repuesto_all as $key=>$value): ?>
                        <tr class="fondoBlanco1 f13">
                            <td><?php echo $value->sku  ?></td>
                            <td><?php echo $value->descripcion_repuesto ?></td>
                            <td><?php echo $value->um ?></td>
                            <td><?php echo $value->stock ?></td>
                            <td>
                                <input type="text" size="4" name="cantidad[<?php echo $value->id?>]" class="cantidad">    
                            </td>

                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="check[<?php echo $value->id?>]" class="custom-control-input miCheck" id="check<?php echo $value->id?>">
                                    <label class="custom-control-label" for="check<?php echo $value->id?>"></label>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
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