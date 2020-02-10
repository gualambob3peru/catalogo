<style>
    .miImagen{cursor:pointer}
    .dataTables_wrapper .row:first-child {display:none}
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(function(){
       
    })
</script>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 fondoAzul1 text-center text-white pt-3">
        <a href="admin/tecnico"><i class="text-white fas fa-arrow-left float-left f20 pt-1"></i></a>
        <span class="font-600">ELEGIR PRODUCTO</span>
    </div>
    <div class="col-md-3"></div>
</div>

<div class="row mt-2 f12">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form class="form-inline text-center" method="post" >
            <label class="my-1 mr-2">NOMBRE/DETALLE PRODUCTO: </label>
            <input type="text" name="fechaInicio">
            <label class="my-1 mr-2 ml-2" >SKU DE PRODUCTO: </label>
            <input type="text" name="fechaFinal" size="8">

            <button type="submit" class="boton pl-4 pr-4 pt-2 pb-2 fondoRojo1 ml-3  my-1 br-20 text-white">BUSCAR</button>
        </form>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <table class="table tablaSole f13">
            <thead  class="fondoAzul1 text-white">
                <tr>
                    <th>SKU</th>
                    <th>FOTO</th>
                    <th>NOMBRE PRODUCTO</th>
                    <th>FICHA TECNICA</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                
            <?php foreach($producto_all as $key=>$value): ?>
                <tr class="fondoBlanco1 ">
                    <td><?php echo $value->sku ?></td>
                    <td><?php echo $value->imagen ?></td>
                    <td><?php echo $value->descripcion ?></td>
                    <td><?php echo $value->fichaTecnica ?></td>
                    <td></td>
                </tr>    
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>