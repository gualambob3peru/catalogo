<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 fondoAzul1 text-center text-white pt-3">
        <span class="font-600">USUARIOS / TÉCNICOS</span>
    </div>
    <div class="col-md-3"></div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 pt-3 text-center">
        <span class="f12 mr-4">NOMBRE DE USUARIO:</span>
        <input type="text" class="mr-4">
        <button class="boton fondoRojo1 text-white br-20 pl-4 pr-4 pt-2 pb-2 f13">BUSCAR</button>
    </div>
    <div class="col-md-3"></div>
</div>


<div class="row mt-3">
    <div class="col-md-12">
        <table class="table tablaSole">
            <thead class="fondoAzul1 text-white">
                <tr>
                    <th>ID</th>
                    <th>FOTO</th>
                    <th>NOMBRES</th>
                    <th>APELLIDOS</th>
                    <th>PERFIL</th>
                    <th>DNI</th>
                    <th>CORREO</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($usuarios as $key=>$value): ?>
                    <tr class="fondoBlanco1">
                        <td><?php echo $value->id ?></td>
                        <td><img src="static/images/<?php echo $value->foto ?>" alt=""></td>
                        <td><?php echo strtoupper($value->nombres) ?></td>
                        <td><?php echo strtoupper($value->apellidoPaterno." ".$value->apellidoMaterno) ?></td>
                        <td><?php echo $value->tipo_usuario_desc ?></td>
                        <td><?php echo $value->nroDocumento ?></td>
                        <td><?php echo $value->email ?></td>
                        <td>
                            <img src="static/images/lapiz.png" alt="" style="height:16px" class="pr-1">
                            <img src="static/images/tacho.png" alt="" style="height:16px" class="pr-1">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>