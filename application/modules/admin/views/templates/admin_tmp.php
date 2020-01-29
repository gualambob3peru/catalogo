<!DOCTYPE HTML>

<html>

<head>
    <title>Administraci&oacute;n</title>
    <link rel="icon" type="image/png" href="static/images/ico.ico">
    <base href="<?php echo base_url(); ?>">
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css"
        integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8cb5e7477f.js" crossorigin="anonymous"></script>


    <!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->


    <link rel="stylesheet" href="static/main/css/estilo.css">

    <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
    <script type="text/javascript" src="static/main/jquery.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js"
        integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous">
    </script>



    <link rel="icon" href="osinerg.ico" type="image/ico">
    <script>
    moment.locale('es');
    let _creaCheckbox = function(id, name, value, label) {
        let miCheckbox = $($("#_divCheckbox").html());
        miCheckbox.find("input:checkbox").attr({
            id: id,
            value: value,
            name: name
        });
        miCheckbox.find("label").text(label);
        miCheckbox.find("label").attr("for", id);

        $("#_almacen").html("");
        $("#_almacen").append(miCheckbox.clone()).html();
        return $("#_almacen").html();
    }

    let _creaRadio = function(id, name, value, label) {
        let miRadio = $($("#_divRadio").html());
        miRadio.find("input:radio").attr({
            id: id,
            value: value,
            name: name
        });
        miRadio.find("label").text(label);
        miRadio.find("label").attr("for", id);

        $("#_almacen").html("");
        $("#_almacen").append(miRadio.clone()).html();
        return $("#_almacen").html();
    }

    let _modalMensaje = function(titulo, texto, boton) {
        let miModal = $($("#_divModal").html());
        miModal.find('.modal-title .modal-textT').text(titulo);
        miModal.find('.modal-body p').text(texto);
        miModal.find('.modal-footer button').val(boton);
        miModal.modal();
    }

    let _imgError = function(image) {
        image.onerror = "";
        image.src = "static/images/no-photo.png";
        return true;
    }

    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $("#miLogo").click(function() {
            
            location.href = 'login';
        });

    });
    </script>

</head>

<body>

    <nav class="navTemplate fondoBlanco1">
        <img class="mt-3" src="static/images/logo.png" alt="">
    </nav>

    
   
    <div class="lineaNav">
        <div class="w-50 float-left fondoRojo1"></div>
        <div class="w-50 float-left fondoAzul1"></div>
    </div>

    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-12 divhei1 fondoBlanco1 br-10 pt-3">
                <div class="row">
                    <div class="col-md-6">
                        <span class="f14 pl-3 colorRojo1 font-weight-bold">ADMINISTRADOR: </span>
                        <span><?php echo strtoupper($this->session->userdata("nombresCompletos")) ?></span>
                    </div>
                    <div class="col-md-6 text-right">
                        <img src="static/images/cerrarSesion.png" alt="" style="height:17px">
                        <a href="admin/logout" class="f13 colorRojo1 pr-3">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    
    <div class="container">
        <?php echo $body; ?>
    </div>


    <div style="display:none">
        <div id="_divCheckbox">
            <div class="custom-control custom-checkbox plantCheckbox">
                <input type="checkbox" class="custom-control-input">
                <label class="custom-control-label"></label>
            </div>
        </div>

        <div id="_divRadio">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input">
                <label class="custom-control-label"></label>
            </div>
        </div>

        <div id="_divModal">
            <div class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title azul"><span></span><span class="modal-textT"></span></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="rojo"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="">Modal body text goes here.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="boton" data-dismiss="modal">Aceptar</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="_almacen">

    </div>
</body>

</html>