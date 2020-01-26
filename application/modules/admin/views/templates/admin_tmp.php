<!DOCTYPE HTML>

<html>

<head>
    <title>Administraci&oacute;n</title>
    <base href="<?php echo base_url(); ?>">
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="static/modules/admin/estilo.css">

    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Exo">

    <script src="https://kit.fontawesome.com/8cb5e7477f.js" crossorigin="anonymous"></script>
    <!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="icon" href="osinerg.ico" type="image/ico">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin/vehiculo">Vehículos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="admin/mantenimiento">Mantenimiento</a>
                </li>   
               
                
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <span class="mr-4 text-light"><?php echo $this->session->userdata("usuario") ?></span>
                <a class="btn btn-outline-danger" href="admin/logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
            </form>
        </div>
    </nav>


    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <br>
                
                <?php echo $body; ?>
            </div>
        </div>

    </div>
</body>

</html>