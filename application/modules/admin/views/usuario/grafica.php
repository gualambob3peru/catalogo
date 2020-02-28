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
    .punto{position:absolute;border-radius: 100px;border:1px solid red;}
    .puntoRep{position:absolute;border-radius: 100px;border:1px solid blue;width:40px;height: 40px}
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

        let creaPunto = function(div,x,y){
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
            
            creaPunto($(this),porX+"px",porY+"px");
        });


        $("#btnAgregarRep").click(function(e){

            if($("#sku").val()=="" || $("#descripcion").val() == ""){
                _modalMensaje("Mensaje", "Debe llenar todos los campos", "Aceptar","fondoRojo1 p-2");
                return;
            }
           
            let x = $(this).attr("x"),
                y = $(this).attr("y"),
                ipi = $(this).attr("id_producto_imagen"),
                id_producto = $(this).attr("id_producto");
            
          
            let punto = $("<div class='puntoRep' x='"+x+"' y='"+y+"'></div>");

            punto.css({left:x,top:y,width:WI,height:HE});
            $(".marcoImagen[id_producto_imagen='"+ipi+"']").append(punto);

            $.ajax({
                url: "admin/usuario/ajaxAddRepuesto",
                type : "post",
                dataType: "json",
                data : {
                    sku : $("#sku").val(),
                    ipi : ipi,
                    id_producto : id_producto,
                    descripcion : $("#descripcion").val(),
                    x : x,
                    y : y
                },
                success : function(){

                }
            })
        });

    });
</script>

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
                        <div class="puntoRep" x="<?php echo $value2->x?>" y="<?php echo $value2->y?>" sku="<?php echo $value2->sku?>" descripcion="<?php echo $value2->descripcion?>" style="top:<?php echo $value2->y ?>px;left:<?php echo $value2->x ?>px"></div>
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
        <div class="mt-4 text-center">
            <span class="colorRojo1 f13 font-weight-bold">AÑADIR REPUESTO</span>            
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
        </div>
    </div>
</div>