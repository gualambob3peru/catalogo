<script>
/****** Creado por Franz Gualambo ***************/
/***** Email : gualambo@gmail.com  *****************/
(function(a) {
    a.fn.validCampoFranz = function(b) {
        a(this).on({
            keypress: function(a) {
                var c = a.which,
                    d = a.keyCode,
                    e = String.fromCharCode(c).toLowerCase(),
                    f = b;
                (-1 != f.indexOf(e) || 9 == d || 37 != c && 37 == d || 39 == d && 39 != c ||
                    8 == d || 46 == d && 46 != c) && 161 != c || a.preventDefault()
            }
        })
    }
})(jQuery);

$(function() {
    $("#nroDocumento").validCampoFranz("0123456789");
    $("#telefono").validCampoFranz("0123456789");


});
</script>



<div class="container">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 divAzul text-center text-white divLogin1">
            <span><img src="static/images/perfil2.png" width="24px"> NUEVA CUENTA DE USUARIO</span>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-6 divLogin">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">

                    <form method="post">
                        <br>
                        <div class="form-group">
                            <label for="usuario">Correo electrónico</label>
                            <input type="email" class="form-control" id="usuario" name="usuario" required value="<?php echo set_value('usuario') ?>">
                            <?php echo form_error('usuario', '<div class="badge badge-danger">', '</div>'); ?>
                        </div>
                        
                        <div class="form-group">
                            <div class="divInputs">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="apellidoPaterno">Apellido Paterno</label><br>
                                        <input class="form-control" name="apellidoPaterno" id="apellidoPaterno"
                                            type="text" style="width:165px" required value="<?php echo set_value('apellidoPaterno') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="apellidoMaterno">Apellido Materno</label><br>
                                        <input class="form-control" name="apellidoMaterno" id="apellidoMaterno"
                                            type="text" style="width:165px" required value="<?php echo set_value('apellidoMaterno') ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombres</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo set_value('nombre') ?>"> 
                        </div>

                        <div class="form-group">
                            <label for="nombre">Tipo de documento identidad</label>
                            <select name="tipoDocumento" class="form-control" id="tipoDocumento" required>
                                <option value="">-- Seleccione --</option>
                                <?php foreach($tipo_documentos as $key=>$value): ?>
                                <option value="<?php echo $value->id ?>"><?php echo $value->descripcion ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="nroDocumento">Número de documento identidad</label>
                            <input type="text" class="form-control" id="nroDocumento" name="nroDocumento" required value="<?php echo set_value('nroDocumento') ?>">
                        </div>



                        <div class="form-group">
                            <label for="telefono">Teléfono 1/ Celular</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required value="<?php echo set_value('telefono') ?>">
                        </div>

                        <div class="form-group">
                            <label for="telefono2">Teléfono 2/ Celular</label>
                            <input type="text" class="form-control" id="telefono2" name="telefono2">
                        </div>

                        <div class="form-group">
                            <label for="telefono3">Teléfono 3/ Celular</label>
                            <input type="text" class="form-control" id="telefono3" name="telefono3">
                        </div>



                        <div class="form-group">
                            <label for="contrasena">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                        </div>

                        <div class="form-group form-check divInputs">
                            <input type="checkbox" class="form-check-input" id="check" required>
                            <label class="form-check-label text-justify" for="check"
                                style="font-size:10px;color:#999">Autorizo a Sole a enviarme información, publicidad
                                y ofertas promocionales. Puedes cancelar la suscripción en cualquier
                                momento.</label>
                        </div>

                        <br>

                        <div class="form-group">
                            <div class="divInputs">
                                <div class="row">
                                    <div class="col-md-6"><input type="submit" class="boton" value="CREAR CUENTA"
                                            style="width:165px"></div>
                                    <div class="col-md-6"><input type="reset" class="boton" value="LIMPIAR DATOS"
                                            style="width:165px"></div>
                                </div>
                            </div>
                        </div>


                        <br>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>

        </div>
        <div class="col-md-3"></div>
    </div>
    <br>
    <div class="row divCentro f12">
        <div class="col-md-3"></div>
        <div class="col-md-6">¿TIENES UNA CUENTA? <span class="rojo font-weight-bold"><a class="rojo" href="login">IR A
                    INICIAR SESIÓN</a></span>
        </div>
        <div class="col-md-3"></div>

    </div>

</div>