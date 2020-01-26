<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>



<script>
    $(function(){
        $('#miTabla').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });
    });
</script>


<div class="row">
    <div class="col-md-12">
        <a href="admin/vehiculo/agregar" class="btn btn-outline-info"><i class="fa fa-plus" aria-hidden="true"></i> Vehículo</a>
    </div>
</div>

<br>
<br>
<div class="row">
    <div class="col-md-12">
        
        <table id="miTabla" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>Cliente</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($vehiculos as $key=>$value): ?>
                <tr>
                    <td><?php echo $value->placa; ?></td>
                    <td><?php echo $value->nombresCompletos; ?></td>
                    <td><?php echo $value->descripcion_marca; ?></td>
                    <td><?php echo $value->descripcion_modelo; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>



    </div>
</div>