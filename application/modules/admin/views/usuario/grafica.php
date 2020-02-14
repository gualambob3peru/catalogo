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
</style>

<script>
    $(function(){
        let num = $("#divMayor").attr("num"),
            max = $("#divMayor").attr("max");

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
                    <img style="max-height:650px" src="static/images/producto/<?php echo $producto->id ?>/<?php echo $value ?>" class="img-fluid">
                </div>

                <div class="paginado colorAzul1 f13 font-weight-bold">
                    <?php echo (int)$value ?>/<?php echo count($imagenes) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="col-md-3 fondoPlomo1 rounded-right  ">
        <div class="mt-4 text-center">
            <span class="colorRojo1 f13 font-weight-bold">COMPONENTES SELECCIONADOS</span>            
        </div>

        <div>
            <table class="table table-borderless table-sm">
                <thead>
                    <tr class="colorAzul1 f11">
                        <th>SKU</th>
                        <th>DESCRIPCION</th>
                        <th>UM</th>
                        <th>CANTIDAD</th>
                    </tr>
                </thead>

                <tbody id="repuestos">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>