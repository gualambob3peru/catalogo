<div class="row">
    <div class="col-md-12">
        <a href="admin/vehiculo/agregar" class="btn btn-outline-info"><i class="fa fa-plus" aria-hidden="true"></i>
            Vehículo</a>
    </div>
</div>

<br>
<br>
<div class="row">
    <div class="offset-md-4 col-md-4">
        <form method="post" class="needs-validation" novalidate>
            <br>

            <?php helper_form_text("placa","Placa","","text","Escribir placa del vehículo ...","required") ?>
            <?php helper_form_text("marca","Marca","","text","Elegir Marca","required") ?>
            <?php helper_form_text("modelo","Modelo","","text","Elegir Marca","required") ?>


            <div class="form-group text-right">
                <input type="submit" class="btn btn-success" value="INICIAR SESIÓN">
            </div>
            <br>
        </form>
    </div>
</div>