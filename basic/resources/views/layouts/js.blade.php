<script type="text/javascript">
    $( document ).ready(function() {
        $('.entidad-select').change(function () {

            $('.selectpicker')
                .find('option')
                .remove()
                .end()
                .append('<option value="0" disabled selected>Escoge...</option>')
                .val('0');

            entidad = $('.entidad-select').val();

            $.ajax({url: "/api/"+entidad, success: function(result){

                option = '';
                texto = '';

                $.each( result, function( key, entity ){
                    if (entidad === 'mensajes')
                    {
                        texto = 'Mensaje de '+entity.nombre;
                    }else{
                        texto = 'Usuario '+entity.name;
                    }
                    option += '<option value="'+entity.id+'">'+texto+'</option>';
                    console.log(option);
                });

                $('.selectpicker').append(option);
                $('.selectpicker').selectpicker('refresh');
            }});

        });
    });
</script>
