<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 fondoAzul1 text-center text-white pt-3">
        <span class="font-600">CUENTAS DE <?php echo $tipo->descripcion ?></span>
    </div>
    <div class="col-md-3"></div>
</div>

<div class="row mt-2">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 fondoBlanco1 br-10 pt-3">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Escribir correo electrónico" aria-label="Recipient's username" aria-describedby="button-addon2" style="height:38px">
            <div class="input-group-append">
                <button class="btn btn-outline-danger" type="button" id="button-addon2">+</button>
            </div>
        </div>
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
                        <a id_noti="<?php echo $value->id  ?>"><img class="pr-3" style="height:25px" src="static/images/tacho.png" alt=""></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-3"></div>
</div>


