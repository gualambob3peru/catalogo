<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 fondoAzul1 text-center text-white pt-3">
        <span class="font-600">ADMINISTRADOR DE CUENTAS PARA NOTIFICACIÓN</span>
    </div>
    <div class="col-md-3"></div>
</div>

<?php foreach($tn as $key=>$value): ?>
<div class="row mt-2">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 fondoBlanco1 br-10 pt-3 text-center h-auto">
        <div class="fondoBlanco1">
            <div class="row pb-3 pt-2">
                <div class="col-md-4 f13 font-weight-bold">
                    <?php echo $value->descripcion ?>
                </div>
                <div class="col-md-6">
                    <div class="f17 pl-2 pr-2" style="background:#2195DB;border-radius:10px;color:white"><?php echo $value->email ?></div>
                </div>
                <div class="col-md-2">
                    <a href="admin/usuario/agregaNoti/<?php echo $value->id  ?>"><img class="pr-3" style="height:25px" src="static/images/lapiz.png" alt=""></a>
                </div>
            </div>
          
        </div>


    </div>
    <div class="col-md-3"></div>
</div>
<?php endforeach; ?>


