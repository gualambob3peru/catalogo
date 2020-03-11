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
        $("body").on("click",".eliminaRep",function(){
            $(this).parents("tr").eq(0).remove();
        });

        $(".btnGuardarRep").click(function(e){
            let a = 0
            if($(".miCant").length!=0){
                $(".miCant").each(function(key,val){
                    if($(val).val()==""){
                       
                        
                        a=1
                    }
                })

                if(a==1){
                    console.log('ddd');
                    return false;
                }
                console.log('aaa');
                return true;
            }
            console.log('bbb');
            return true;
        });

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



        let crearFilaRep = function(sku,descripcion,id_repuesto){
            let fila= "<tr>";
            fila+='<td>'+sku+' <input type="checkbox" style="display:none" checked value="'+id_repuesto+'" name="check['+id_repuesto+']"> </td>';
            fila+='<td>'+descripcion+'</td>';
            fila+='<td><input type="number" class="miCant" style="width:50px;height:25px" size="2"  pattern="\d*" maxlength="2" name="cantidad['+id_repuesto+']"></td>';
            fila+='<td> <button class="eliminaRep boton fondoRojo1 p-1 text-white br-4"  id_repuesto="'+id_repuesto+'"> <i class="far fa-trash-alt"></i>  </button> </td>';
            fila+='</tr>';

            $(".table_repuestos").append(fila);
        }

        $("body").on("click",".puntoRep",function(){
            let sku = $(this).attr("sku"),
                descripcion = $(this).attr("descripcion"),
                id_repuesto = $(this).attr("id_repuesto");
                crearFilaRep(sku,descripcion,id_repuesto);
        
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
                           
                                <div class="sku">SKU: <?php echo $value2->sku ?></div>
                                <div class="descripcion"><?php echo $value2->descripcion ?></div>
                                <div class="stock">stock: <?php echo intval($value2->stock) ?></div>
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
                <span class="colorRojo1 f12 font-weight-bold textoDetalles">COMPONENTES SELECCIONADOS</span>            
            </div>
            <form action="admin/tecnico/resumenSolicitud" method="post" id="miForm">
                <div>
                    <table class="table table_repuestos table-borderless table-sm f11">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>DESCRIPCIÓN</th>
                                <th>CANTIDAD</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    
                </div>
            
            <!-- <div class="form-group">
                <label for="exampleInputEmail1">SKU</label>
                <input type="text" class="form-control" id="sku" aria-describedby="sku">
            </div>
            <div class="form-group">
                <label for="descripcion">DESCRIPCION</label>
                <input type="text" class="form-control" id="descripcion">
            </div> -->
                        <br>
                        <br>
                        <br>
                <div>
                

                    <!-- <button type="submit" id_producto="<?php echo $producto->id ?>" class="boton fondoAzul1 text-white br-10 p-2"  id="btnUpdateRep">Guardar</button> -->

                    <button type="submit" class="btnGuardarRep boton fondoAzul1 text-white br-10 p-2">Guardar</button>

                </div>
            </form>
        </div>

        
    </div>
</div>