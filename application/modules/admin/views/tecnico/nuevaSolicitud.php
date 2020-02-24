<style>
    .miImagen{cursor:pointer}
    .dataTables_wrapper .row:first-child {display:none}
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<style>
    .divRadio{
        height:32px;
        width:72px;
        background:#CCD2E0;
        border-radius:100px;
        position:relative;
        cursor:pointer;
    }
    .checkRedondo{
        height:27px;
        width:27px;
        background:white;
        border-radius:100px;
        position:absolute;
        left:3px;
        top:3px;
    }
</style>

<script>
    $(function(){
        let check = 1;
        $(".divRadio").click(function(){
            if(check==1){
                $(".checkRedondo").css("left","42px");
                check=0;
            }else if(check==0){
                $(".checkRedondo").css("left","3px");
                check=1;
            }
            $("#garantia").val(check);
        });

        $(".btnListado").click(function(){
            if($("#orden").val()=="" || $("#cliente").val()==""){
                _modalMensaje("Mensaje", "Debe llenar los campos", "Aceptar","fondoRojo1");
            }else{
                $("#miForm").attr("action","admin/tecnico/listadoRep");
                $("#miForm").submit();
            }

            return false;
        })

        $(".btnGrafica").click(function(){
            if($("#orden").val()=="" || $("#cliente").val()==""){
                _modalMensaje("Mensaje", "Debe llenar los campos", "Aceptar","fondoRojo1");
            }else{
                $("#miForm").attr("action","admin/tecnico/grafica");
                $("#miForm").submit();
            }

            return false;
        })  
    })
</script>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 fondoAzul1 text-center text-white pt-3">
        <a href="admin/tecnico/elegirProducto"><i class="text-white fas fa-arrow-left float-left f20 pt-1"></i></a>
        <span class="font-600">NUEVA SOLICITUD</span>
    </div>
    <div class="col-md-3"></div>
</div>


<div class="row mt-2">
    <div class="col-md-3"></div>
    <div class="col-md-6 divhei1 br-10 f13 fondoBlanco1 pt-3 pl-5 h-auto">
        <form action="" method="post" id="miForm">
            <div class="form-group row">
                <label for="" class="col-sm-1"></label>
                <label for="orden" class="col-sm-4 col-form-label">Orden de Servicio</label>
                <div class="col-sm-6">
                    <input type="text" class="" id="orden" name="orden">
                </div>
                <label for="" class="col-sm-1"></label>
            </div>

            <div class="form-group row">
                <label for="" class="col-sm-1"></label>
                <label for="cliente" class="col-sm-4 col-form-label">Cliente</label>
                <div class="col-sm-6">
                    <input type="text" class="" id="cliente" name="cliente">
                </div>
                <label for="" class="col-sm-1"></label>
            </div>

            <div class="form-group row">
                <label for="" class="col-sm-1"></label>
                <label for="cliente" class="col-sm-5 col-form-label">¿Producto en garantía?</label>
                <div class="col-sm-5">
                    <div class="float-left colorAzul1 font-weight-bold mt-1">SI</div>
                    <div class="float-left ml-2 mr-2">
                        <div class="divRadio">
                            <input type="hidden" id="garantia" name="garantia" value="1">
                            <input type="hidden" id="id_producto" name="id_producto" value="1">
                            <div class="checkRedondo br-10"></div>
                        </div>
                    </div>
                    <div class="float-left colorAzul1  font-weight-bold mt-1">NO</div>
                </div>
                <label for="" class="col-sm-1"></label>
            </div>

            <div class="form-group row">
                <label for="" class="col-sm-1"></label>
                <label class="colorPlomo1 f13 col-sm-11 font-600">¿CÓMO DESEA SELECCIONAR SUS COMPONENTES?</label>
            </div>

            <div class="form-group row mt-2 mb-4">
                <label for="" class="col-sm-1"></label>
                <div class="col-sm-5 text-center">
                    <a href="#" class="btnListado fondoRojo1 text-white br-20 pl-5 pr-5 pt-2 pb-2">LISTADO</a>
                </div>
                <div class="col-sm-5 text-center">
                    <a href="#" class="btnGrafica fondoRojo1 text-white br-20 pl-5 pr-5 pt-2 pb-2">GRÁFICA</a>
                </div>
            </div>

            <br>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>