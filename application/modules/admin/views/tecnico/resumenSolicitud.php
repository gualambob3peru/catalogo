

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 fondoAzul1 text-center text-white pt-3">
        <a href="admin/tecnico/listadoRep"><i class="text-white fas fa-arrow-left float-left f20 pt-1"></i></a>
        <span class="font-600">RESUMEN DE SOLICITUD</span>
    </div>
    <div class="col-md-3"></div>
</div>




<div class="row mt-3">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 h-auto f15 fondoBlanco1 pt-4 pl-5 pr-5">
        <!-- <table class="table table-borderless table-sm">
            <tbody>
                <tr>
                    <td>Orden de Servicio</td>
                    <td><?php echo $orden ?></td>
                </tr>
                <tr>
                    <td>Cliente</td>
                    <td><?php echo $orden ?></td>
                </tr>
                <tr>
                    <td>Producto</td>
                    <td><?php echo $producto->descripcion ?></td>
                </tr>
                <tr>
                    <td>Archivos</td>
                    <td>1.pfg</td>
                </tr>
            </tbody>
        </table> -->
        <div>
            <span class="font-weight-bold">Orden de Servicio: </span> <span><?php echo $orden ?></span>
        </div>
        <div>
            <span class="font-weight-bold">Cliente: </span> <span><?php echo $orden ?></span>
        </div>
        <div>
            <span class="font-weight-bold">Producto: </span> <span><?php echo $producto->descripcion ?></span>
        </div>
        <div>
            <span class="font-weight-bold">Archivos: </span> <span>1.pdf</span>
        </div>
           
        <br>

        <div class="text-center">
            <span class="colorAzul1 f15 font-weight-bold">COMPONENTES SELECCIONADOS</span>
        </div>

        <table class="table table-borderless table-sm">
            <thead>
                <tr class="colorRojo1 font-weight-bold f16">
                    <td>SKU</td>
                    <td>DESCRIPCION</td>
                    <td>UNIDADES</td>
                    <td>STOCK</td>
                </tr>
            </thead>

            <tbody>
                <?php foreach($repuesto_all as $key=>$value): ?>
                <tr class="f13">
                    <td><?php echo $value->sku ?></td>
                    <td><?php echo $value->descripcion ?></td>
                    <td><?php echo $value->cantidad ?></td>
                    <td><?php echo intval($value->stock) ?></td>
                 
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        
    </div>
    
</div>
<br>
<div class="text-center mt-2">
    <a href="admin/tecnico/enviarSolicitud" class="boton fondoRojo1 text-white pl-3 pr-3 pt-2 pb-2 br-20">CONFIRMAR Y NOTIFICAR</a>
</div>