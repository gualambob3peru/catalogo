$(function() {
    habilitar = 0;

    $("#geo").click(function() {
        habilitar = 1;
    });

    $("#departamento,#provincia,#id_ubigeo,#id_tipo_via").change(function() {
        if ($(this).val() != "") {
            habilitar = 0;
        }
    });

    $("#nombre_via,#nro_via").keyup(function() {
        habilitar = 0
    });

    $("#confirmar").click(function() {


        let departamento = $("#departamento").val(),
            provincia = $("#provincia").val(),
            id_ubigeo = $("#id_ubigeo").val(),
            id_tipo_via = $("#id_tipo_via").val(),
            nombre_via = $("#nombre_via").val(),
            nro_via = $("#nro_via").val()

        if (!departamento) {
            _modalMensaje("¡Aviso!", "¡Elegir un departamento!", "Aceptar");
            return false;
        };
        if (!provincia) {
            _modalMensaje("¡Aviso!", "¡Elegir una provincia!", "Aceptar");
            return false;
        };
        if (!id_ubigeo) {
            _modalMensaje("¡Aviso!", "¡Elegir un distrito!", "Aceptar");
            return false;
        };
        if (!id_tipo_via) {
            _modalMensaje("¡Aviso!", "¡Elegir un tipo de vía!", "Aceptar");
            return false;
        };
        if (!nombre_via) {
            _modalMensaje("¡Aviso!", "¡Elegir un nombre de vía!", "Aceptar");
            return false;
        };
        if (!nro_via) {
            _modalMensaje("¡Aviso!", "¡Elegir un número de vía!", "Aceptar");
            return false;
        };

        if (habilitar == 0) {
            _modalMensaje("¡Aviso!", "¡Falta Geolocalizar!", "Aceptar");
            return false;
            // alert('Falta Geolocalizar'); return false;
        }

        $("form").submit();
        return false;
    });

    $("#departamento").change(function() {
        let departamento = $(this).val();

        $.ajax({
            url: "admin/servicio/ajaxGetProvincias",
            type: "post",
            dataType: "json",
            data: {
                departamento: $("#departamento").val()
            },
            success: function(response) {
                let options = '<option value="">Elegir</option>',
                    provincias = response.provincias;

                for (let ind in provincias) {
                    options += '<option value="' + provincias[ind].provincia + '">' +
                        provincias[ind].provincia + '</option>';
                }

                $("#provincia").html(options);
            }
        });
    });

    $("#provincia").change(function() {
        let provincia = $(this).val();

        $.ajax({
            url: "admin/servicio/ajaxGetDistritos",
            type: "post",
            dataType: "json",
            data: {
                provincia: $("#provincia").val()
            },
            success: function(response) {
                let options = '<option value="">Elegir</option>',
                    distritos = response.distritos;

                for (let ind in distritos) {
                    options += '<option value="' + distritos[ind].id + '">' +
                        distritos[ind].distrito + '</option>';
                }

                $("#id_ubigeo").html(options);
            }
        });
    });
});