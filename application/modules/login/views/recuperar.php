<script>
    $(function(){
        $("#enviar").click(function(){
            if($("#usuario").val()==""){
                _modalMensaje("¡Aviso!","Debe escribir un correo electrónico","Aceptar");
                return false;
            }else{
                return true;
            }
        });
    });
</script>

<div class="container">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 divAzul text-center text-white divLogin1">
            <span><img src="static/images/candado1.png" width="24px"> RECUPERAR CONTRASEÑA</span>
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

                        <?php if (isset($error)): ?>

                        <div class="form-group">
                            <span class="badge badge-danger text-center"><?php echo $error ?></span>
                        </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="usuario">Correo electrónico</label>
                            <input type="email" class="form-control" id="usuario" name="usuario" required>
                        </div>



                        <div class="form-group">
                            <div style="margin:0 auto">
                                <div class="row">
                                    <div class="col-md-6"><input id="enviar" type="submit" class="boton" value="RECUPERAR"
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
                    INICIAR SESIÓN</a></span></div>
        <div class="col-md-3"></div>

    </div>



</div>