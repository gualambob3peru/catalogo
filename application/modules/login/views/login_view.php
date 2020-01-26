
    <div class="container">
        <br>

        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 text-center">
                <h2> INICIO DE SESIÓN</h2>
            </div>
            <div class="col-sm-3"></div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form method="post"  class="needs-validation" novalidate>
                            <br>

                            <?php helper_form_text("usuario","Usuario","admin","text","Escribir usuario ...","required") ?>
                            <?php helper_form_text("contrasena","Contraseña","123456","password","Escribir contraseña ...","required") ?>

    
                            <div class="form-group text-right">
                                <input type="submit" class="btn btn-success" value="INICIAR SESIÓN">
                            </div>
                            <br>
                        </form>
                    </div>
                    <div class="col-md-2"></div>
                </div>

            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>