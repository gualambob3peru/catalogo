<script>
    /****** Creado por Franz Gualambo ***************/
/***** Email : gualambo@gmail.com  *****************/
(function(a){a.fn.validCampoFranz=function(b){a(this).on({keypress:function(a){var c=a.which,d=a.keyCode,e=String.fromCharCode(c).toLowerCase(),f=b;(-1!=f.indexOf(e)||9==d||37!=c&&37==d||39==d&&39!=c||8==d||46==d&&46!=c)&&161!=c||a.preventDefault()}})}})(jQuery);

    $(function(){
        $("#nroDocumento").validCampoFranz("1234567890");
    });

</script>


<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 fondoAzul1 text-center text-white pt-3">
        <span class="font-600">EDITAR USUARIO</span>
    </div>
    <div class="col-md-3"></div>
</div>

<div class="row mt-2">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 fondoBlanco1 br-10 pt-3 text-center h-auto">
        <form action="" method="post" enctype="multipart/form-data">
    
            <div>
                <label for="nombres" class="f13">NOMBRES</label> 
                <br><?php echo form_error('nombres', '<span class="colorRojo1">', '</span>'); ?>
            </div>

            <div class="mb-3">
                <input type="text" name="nombres" id="nombres" class="w-75" required value="<?php echo $usuario->nombres ?>"> 
            </div>

            <div>
                <label for="apellidoPaterno" class="f13">APELLIDO PATERNO</label>
                <br><?php echo form_error('apellidoPaterno', '<span class="colorRojo1">', '</span>'); ?>
            </div>

            <div class="mb-3">
                <input type="text" name="apellidoPaterno" id="apellidoPaterno" class="w-75" required value="<?php echo $usuario->apellidoPaterno ?>"> 
            </div>

            <div>
                <label for="apellidoMaterno" class="f13">APELLIDO MATERNO</label>
                <br><?php echo form_error('apellidoMaterno', '<span class="colorRojo1">', '</span>'); ?>
            </div>

            <div class="mb-3">
                <input type="text" name="apellidoMaterno" id="apellidoMaterno" class="w-75" required value="<?php echo $usuario->apellidoMaterno ?>"> 
            </div>

            <div>
                <label for="idTipoDocumento" class="f13">TIPO DE DOCUMENTO</label>
                <br><?php echo form_error('idTipoDocumento', '<span class="colorRojo1">', '</span>'); ?>
            </div>
            

            <div class="mb-3">
                <select name="idTipoDocumento" id="idTipoDocumento" class="w-75" required>
                    <option value="">Elegir</option>
                    <?php foreach($tipoDocumentos as $key=>$value): ?>
                        <?php
                            if($value->id == $usuario->idTipoDocumento){
                                $selected = "selected";
                            }    else{
                                $selected = "";
                            }
                        ?>
                        <option <?php echo $selected ?> value="<?php echo $value->id ?>">
                            <?php echo $value->descripcion ?>
                        </option>
                    <?php endforeach; ?>
                </select> 
            </div>

            <div>
                <label for="nroDocumento" class="f13">Nro Documento</label>
                <br><?php echo form_error('nroDocumento', '<span class="colorRojo1">', '</span>'); ?>
            </div>

            <div class="mb-3">
                <input type="text" name="nroDocumento" id="nroDocumento" class="w-75" required value="<?php echo $usuario->nroDocumento ?>"> 
            </div>

            <div>
                <label for="email" class="f13">USUARIO / EMAIL</label>
                <br><?php echo form_error('usuario', '<span class="colorRojo1">', '</span>'); ?>
            </div>

            <div class="mb-3">
                <input type="email" name="usuario" id="email" class="w-75" required value="<?php echo $usuario->usuario ?>"> 
            </div>

            <div>
                <label for="contrasena" class="f13">CONTRASEÑA</label>
                <br><?php echo form_error('contrasena', '<span class="colorRojo1">', '</span>'); ?>
            </div>

            <div class="mb-4">
                <input type="password" name="contrasena" id="contrasena" class="w-75"> 
            </div>

            <div class="custom-file w-75 mb-4 mt-2">
                <input type="file" name="miFile" class="custom-file-input" id="customFile"  lang="es" >
                <label class="custom-file-label" for="customFile">Elegir Archivo</label>
            </div>

            
            <div class="mb-5">
                <button type="submit" class="w-35 boton fondoRojo1 br-20 text-white pl-3 pr-3 pt-1 pb-1 mr-3">EDITAR</button>
                <a href="admin/usuario" class="w-35 boton fondoRojo1 br-20 text-white pl-3 pr-3 pt-1 pb-1">REGRESAR</a>
            </div>
        </form>

       

    </div>
    <div class="col-md-3"></div>
</div>

