<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 fondoAzul1 text-center text-white pt-3">
        <span class="font-600">NUEVO TÉCNICO</span>
    </div>
    <div class="col-md-3"></div>
</div>

<div class="row mt-2">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 fondoBlanco1 br-10 pt-3 text-center h-auto">
        <form action="" method="post">
    
            <div>
                <label for="nombres" class="f13">NOMBRES</label> 
                <br><?php echo form_error('nombres'); ?>
            </div>

            <div class="mb-3">
                <input type="text" name="nombres" id="nombres" class="w-75"> 
            </div>

            <div>
                <label id="apellidoPaterno" class="f13">APELLIDO PATERNO</label>
                <br><?php echo form_error('apellidoPaterno'); ?>
            </div>

            <div class="mb-3">
                <input type="text" name="apellidoPaterno" id="apellidoPaterno" class="w-75"> 
            </div>

            <div>
                <label id="apellidoMaterno" class="f13">APELLIDO MATERNO</label>
                <br><?php echo form_error('apellidoMaterno'); ?>
            </div>

            <div class="mb-3">
                <input type="text" name="apellidoMaterno" id="apellidoMaterno" class="w-75"> 
            </div>

            <div>
                <label id="dni" class="f13">DNI</label>
                <br><?php echo form_error('nroDocumento'); ?>
            </div>

            <div class="mb-3">
                <input type="text" name="nroDocumento" id="dni" class="w-75"> 
            </div>

            <div>
                <label id="email" class="f13">USUARIO / EMAIL</label>
                <br><?php echo form_error('nroDocumento'); ?>
            </div>

            <div class="mb-3">
                <input type="text" name="usuario" id="email" class="w-75"> 
            </div>

            <div>
                <label id="contrasena" class="f13">CONTRASEÑA</label>
                <br><?php echo form_error('contrasena'); ?>
            </div>

            <div class="mb-4">
                <input type="password" name="contrasena" id="contrasena" class="w-75"> 
            </div>

            <div class="mb-5">
                <button type="submit" class="w-35 boton fondoRojo1 br-20 text-white pl-3 pr-3 pt-1 pb-1 mr-3">CREAR USUARIO</button>
                <button type="reset" class="w-35 boton fondoRojo1 br-20 text-white pl-3 pr-3 pt-1 pb-1">LIMPIAR DATOS</button>
            </div>
        </form>

       

    </div>
    <div class="col-md-3"></div>
</div>

