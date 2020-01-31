<br>
<br>
<br>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 text-white text-center fondoAzul1 divhei1 br-10 pt-3">
        <img src="static/images/candado1.png" class="mb-2" style="height:25px">
        <span class="f18 font-600">RECUPERAR USUARIO</span>
    </div>
    <div class="col-md-3"></div>
</div>

<form action="" method="post">
    <div class="row mt-2 h-auto ">
        <div class="col-md-3"></div>
        <div class="col-md-6 fondoBlanco1 text-center br-10 pt-3">
            <span class="colorRojo1"><?php echo $error ?></span> <br>
            <span class="f13">CORREO ELECTRÓNICO</span>
           
            <input class="mt-3 form-control w330 mauto text-center" type="email" name="usuario">
            
            <input type="submit" value=" RECUPERAR " class="mt-3 mr-3 mb-3 f13 pl-4 pr-4 boton fondoRojo1 text-white br-20 "> 
            <input type="reset" value="LIMPIAR DATOS" class="mt-3 ml-3 mb-3 f13 pl-3 pr-3 boton fondoRojo1 text-white br-20 "> 
            
            <br>
            <span class="f12">¿Tienes usuario?</span> <a href="login" class="f12 colorRojo1">INICIAR SESIÓN</a>

            <br>
            <br>

        </div>
        <div class="col-md-3"></div>
    </div>
</form>