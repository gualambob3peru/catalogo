<style>
    .paginado{
        position:absolute;
        bottom:20px;
        left:20px; 
        z-index:1;  
    }
    .divFlechas{
        position:absolute;
        top:20px;
        left:20px;   
        z-index:1;
    }
    .divImagen{
        display:none;
    }
    .divImagen:first-child{
        display:block;
    }
    .punto{position:absolute;border-radius: 100px;border:1px solid red;width:auto}
    .puntoRep{position:absolute;cursor:pointer;border-radius: 100px;border:1px solid blue;width:40px;height: 40px}

    .puntoRep:hover .puntoDiv{
        display:block;
    }

    .puntoDiv{border-radius:10px;padding:9px;background:#CCD2E0; border:2px solid #004184;position:absolute;top:30px;left:30px;display:none;text-align:left}
    .puntoDiv .sku{color:#E1001A;font-size:13px;}
    .puntoDiv .descripcion{font-weight:bold;font-size:16px;}

    .borraRep{position:absolute;right:-6px;top:-34px}
</style>

<script>
    $(function(){
        let num = $("#divMayor").attr("num"),
            WI = 40,
            HE = 40;

        $(".siguiente").click(function(){
            num = parseInt(num) + 1;
            $(".divImagen").css("display","none");

            $(".row"+num).css("display","block");
            return false;
        });

        $(".anterior").click(function(){
            num = parseInt(num) - 1;
            $(".divImagen").css("display","none");

            $(".row"+num).css("display","block");
            return false;
        });

        let creaPuntoDiv = function(sku,descripcion,id_repuesto){
            let puntoDiv = '<div class="puntoDiv">';
         
            puntoDiv += '<div class="sku">SKU:'+sku+'</div>';
            puntoDiv += '<div class="descripcion">'+descripcion+'</div>';
            puntoDiv += '</div>';


            return puntoDiv;
        }

        let creaPunto = function(div,x,y){
            //limpiando detalles
            $(".textoDetalles").text("AÑADIR REPUESTO");
            $("#btnUpdateRep").css("display","none");
            $("#btnRemoveRep").css("display","none");
            $("#btnAgregarRep").css("display","inline-block");
            $("#sku").val("");
            $("#descripcion").val("");
            ////////////////////////////////////////////////


            $(".punto").remove();

            let punto = $("<div class='punto' x='"+x+"' y='"+y+"'></div>");

            punto.css({left:x,top:y,width:WI,height:HE});
            $(div).append(punto)

            $("#btnAgregarRep").attr({x:x,y:y})
            $("#btnAgregarRep").attr({id_producto_imagen:div.attr("id_producto_imagen")})
            $("#sku").focus()
        }


        $(".marcoImagen").click(function(e){
            let x = e.offsetX;
                y = e.offsetY;

            let porX = x-WI/2;
            let porY = y-HE/2;
            
            $(".divEdicion").css("display","block");
            creaPunto($(this),porX+"px",porY+"px");
        });

        $("body").on("click",".puntoRep",function(){
            $(".textoDetalles").text("ACTUALIZAR REPUESTO");
            $("#btnAgregarRep").css("display","none");

            $("#btnUpdateRep").css("display","inline-block");
            $("#btnUpdateRep").attr("id_repuesto",$(this).attr("id_repuesto"));

            $("#btnRemoveRep").css("display","inline-block");
            $("#btnRemoveRep").attr("id_repuesto",$(this).attr("id_repuesto"));

            $("#sku").val($(this).attr("sku"));
            $("#descripcion").val($(this).attr("descripcion"));

            $(".divEdicion").css("display","block");
        });

        $("#btnUpdateRep").click(function(){
            let id_repuesto = $(this).attr("id_repuesto"),
                sku = $("#sku").val(),
                descripcion = $("#descripcion").val();

            $.ajax({
                url: "admin/usuario/ajaxUpdateRepuesto",
                type : "post",
                dataType: "json",
                data : {
                    sku : sku,
                    descripcion : descripcion,
                    id_repuesto : id_repuesto
                },
                success : function(response){
                    let puntoRep = $(".puntoRep[id_repuesto='"+id_repuesto+"']");
                    puntoRep.attr("sku",sku);
                    puntoRep.find(".sku").text("SKU: "+sku);
                    puntoRep.attr("descripcion",descripcion);
                    puntoRep.find(".descripcion").text(descripcion);
                    
                    if(response.respuesta==1){
                        _modalMensaje("Mensaje", "Se modificó correctamente", "Aceptar","fondoAzul1 p-2");
                    }
                    
                    $("#sku").val("");
                    $("#descripcion").val("");
                    $(".divEdicion").css("display","none");
                }
            })
        });

        $("#btnRemoveRep").click(function(){
            let id_repuesto = $(this).attr("id_repuesto"),
                sku = $("#sku").val(),
                descripcion = $("#descripcion").val();

            $.ajax({
                url: "admin/usuario/ajaxRemoveRepuesto",
                type : "post",
                dataType: "json",
                data : {
                    id_repuesto : id_repuesto
                },
                success : function(response){
                    if(response.respuesta==1){
                        $(".puntoRep[id_repuesto='"+id_repuesto+"']").remove();
                        _modalMensaje("Mensaje", "Se eliminó correctamente", "Aceptar","fondoAzul1 p-2");
                    }
                    
                    $("#sku").val("");
                    $("#descripcion").val("");
                    $(".divEdicion").css("display","none");
                }
            })
        });

        $("#btnAgregarRep").click(function(e){

            if($("#sku").val()=="" || $("#descripcion").val() == ""){
                _modalMensaje("Mensaje", "Debe llenar todos los campos", "Aceptar","fondoRojo1 p-2");
                return;
            }
           
            let x = $(this).attr("x"),
                y = $(this).attr("y"),
                ipi = $(this).attr("id_producto_imagen"),
                id_producto = $(this).attr("id_producto"),
                descripcion = $("#descripcion").val(),
                sku = $("#sku").val();
            
            $.ajax({
                url: "admin/usuario/ajaxAddRepuesto",
                type : "post",
                dataType: "json",
                data : {
                    sku : sku,
                    ipi : ipi,
                    id_producto : id_producto,
                    descripcion : descripcion,
                    x : x,
                    y : y
                },
                success : function(response){
                    console.log(response);
                    let id_repuesto = response.id_repuesto;
                    
                    let puntoDiv = creaPuntoDiv(sku,descripcion,id_repuesto);
                    let punto = $("<div class='puntoRep' id_repuesto='"+id_repuesto+"' sku='"+sku+"' descripcion='"+descripcion+"' x='"+x+"' y='"+y+"'>"+puntoDiv+"</div>");

                    punto.css({left:x,top:y,width:WI,height:HE});
                    $(".marcoImagen[id_producto_imagen='"+ipi+"']").append(punto);

                    $(".divEdicion").css("display","none");
                }
            })
        });

    });
</script>

<a href="admin/usuario/elegirProducto" class="fondoAzul1 text-white f12 br-20 pl-3 pr-3 pt-2 pb-2"><i class="fas fa-arrow-left"></i>Atrás</a>

<br>
<br>
<div class="row">
    <div class="col-md-9 fondoBlanco1 rounded-left" num="0" max="<?php count($imagenes) ?>" id="divMayor">
        <?php foreach($imagenes as $key=>$value): ?>
            <div class="row row<?php echo $key ?> divImagen position-relative" >
                <div class="divFlechas">
                    <?php if ($key!=0): ?>
                    <a href="#" class="anterior fondoAzul1 text-white f12 br-20 pl-3 pr-3 pt-2 pb-2"><i class="fas fa-arrow-left"></i> ANTERIOR PÁGINA </a>
                    <?php endif; ?>

                    <?php if ($key+1!=count($imagenes)): ?>
                    <a href="#" class="siguiente fondoAzul1 text-white f12 br-20 pl-3 pr-3 pt-2 pb-2">SIGUIENTE PÁGINA <i class="fas fa-arrow-right"></i></a>
                    <?php endif; ?>    
                </div>
                

                <div class="col-md-12 text-center">
                    <div class="marcoImagen" style="position:relative;overflow-x:auto;overflow-y:auto;max-height:650px" id_producto_imagen="<?php echo $value->id ?>">

                    <?php foreach($value->repuesto as $key2=>$value2): ?>
                        <div class="puntoRep" id_repuesto="<?php echo $value2->id ?>" x="<?php echo $value2->x?>" y="<?php echo $value2->y?>" sku="<?php echo $value2->sku?>" descripcion="<?php echo $value2->descripcion?>" style="top:<?php echo $value2->y ?>px;left:<?php echo $value2->x ?>px">


                        <div class="puntoDiv">
                           
                            <div class="sku">SKU:<?php echo $value2->sku ?></div>
                            <div class="descripcion"><?php echo $value2->descripcion ?></div>
                            </div>
                        </div>


                    <?php endforeach; ?>    

                        <img src="static/images/producto/<?php echo $producto->id ?>/<?php echo $value->nombre_archivo ?>">
                    </div>
                </div>

                <div class="paginado colorAzul1 f13 font-weight-bold">
                    <?php echo ($key+1) ?>/<?php echo count($imagenes) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="col-md-3 fondoPlomo1 rounded-right  ">
        <div class="divEdicion">
            <div class="mt-4 text-center">
                <span class="colorRojo1 f13 font-weight-bold textoDetalles">AÑADIR REPUESTO</span>            
            </div>

            
            <div class="form-group">
                <label for="exampleInputEmail1">SKU</label>
                <input type="text" class="form-control" id="sku" aria-describedby="sku">
            </div>
            <div class="form-group">
                <label for="descripcion">DESCRIPCION</label>
                <input type="text" class="form-control" id="descripcion">
            </div>
            
            <div>
                <button type="button" id_producto="<?php echo $producto->id ?>" class="boton fondoAzul1 text-white br-10 p-2" id="btnAgregarRep">Agregar</button>

                <button type="button" id_producto="<?php echo $producto->id ?>" class="boton fondoAzul1 text-white br-10 p-2" style="display:none" id="btnUpdateRep">Guardar</button>

                <button type="button" id_producto="<?php echo $producto->id ?>" class="boton fondoRojo1 text-white br-10 p-2" style="display:none" id="btnRemoveRep">Eliminar</button>
            </div>
        </div>

        
    </div>
</div>