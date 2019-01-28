<?php $pasienteTratamientoItem = 'active'?>
<?php include(dirname(__FILE__) . '/partials/headerPP.php');  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Control de errores -->
    <?php include(dirname(__FILE__) . '/partials/errorGeneral.php')?>

    <!-- Control de success -->
    <?php include(dirname(__FILE__) . '/partials/successGeneral.php')?>

    <!-- Content Header (Page header) -->
    <?php $tituloMod = 'Tratamientos Aplicados<small>histórico</small>'?>
    <?php $items[] = ['label' => 'pacientes', 'icon' => 'fa-users', 'url' => $_domain . '/pacientes/historico']?>
    <?php $items[] = ['label' => 'Tratamientos Aplicados', 'icon' => 'fa-medkit', 'active' => 1]?>
    <?php include(dirname(__FILE__) . '/partials/ustedEstaAqui.php')?>

    <!-- Main content -->
    <section class="content">

        <!-- Histórico de usuarios-->
        <div class="box box-default">
            <div class="box-header ">
                <h3></h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="<?php $_domain?>/home/inicio">
                        <i class="fa fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <form>
                            <div class="form-group">
                                <label>Tipo identificación</label>
                                <select name="tpoIdentificacion" id="" class="form-control">
                                    <option value="">Seleccionar</option>
                                    <option value="T.I">T.I</option>
                                    <option value="C.C">C.C</option>
                                    <option value="C.E">C.E</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Identificación</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="identificacion">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="btnConsultar">Consultar!</button>
                                    </span>
                                </div><!-- /input-group -->
                            </div>
                            <div class="alertaConsulta">

                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Tratamientos</label>
                                <select name="idTratamiento" id="tratamientos" class="form-control">
                                    <option value="">Selección</option>
                                    <?php if(isset($tratamientos)) : ?>
                                    <?php foreach($tratamientos as $tratamiento):?>
                                            <option
                                                    value="<?php echo $tratamiento['id']?>"
                                                    data-valor="<?php echo $tratamiento['valor']?>"
                                                    data-aplica-dto="<?php echo $tratamiento['aplicaDto']?>"
                                            >
                                                <?php echo $tratamiento['nombre']?>
                                            </option>
                                    <?php endforeach?>
                                    <?php endif;?>
                                </select>
                            </div>

                            <div class="form-group">
                                <p class="form-control-static text-muted">
                                    Valor $ <span id="view_Valor">0.00</span> /
                                    Descuento <span id="view_descuento">__</span>

                                    <div class="alert alert-info">
                                        paciente con ciudad diferente a Bogotá, se le aplicará un
                                        descuento de 10% si el tratamiento tiene descuento
                                    </div>
                                </p>
                                <input type="hidden" name="valorTratamiento">
                                <input type="hidden" name="dtoTratamiento">
                                <input type="hidden" name="idPaciente">
                                <input type="hidden" name="idCiudadPaciente">

                            </div>

                            <div id="erroresCampos"></div>
                            <div class="pull-right">
                                <button type="button" id="btnRelacionTratamiento" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-8">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th colspan="3">Paciente</th>
                                <th colspan="2">Tratamientos</th>
                            </tr>

                            <tr>
                                <th>Identificación</th>
                                <th>Nombres y apellidos</th>
                                <th>Ciudad</th>
                                <th>Nombre</th>
                                <th>Valor</th>
                            </tr>

                            <tbody id="regTratamientos">
                                <td colspan="5" align="center">
                                    Consulta de tratamientos asignados a un paciente!
                                </td>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
            <div class="box-footer"></div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include(dirname(__FILE__) . '/partials/footer.php');  ?>

<script>
    var TratamientosAplicados = function(){};

    TratamientosAplicados.prototype = {

        consultarPaciente :function(){

            tpoIde = $('select[name="tpoIdentificacion"]').val();
            ide = $('input[name="identificacion"]').val();

            if(tpoIde == '' || ide == ''){
                $('.alertaConsulta')
                    .addClass('alert')
                    .addClass('alert-warning')
                    .html('Campos Tipo Identificación e Identificación necesarios!');
            }
            else{
                $('.alertaConsulta').removeClass('alert').removeClass('alert-warning').html('');

                $.ajax({
                    url: '<?php echo $_domain ?>/pacientes/tratamientosPaciente',
                    data: {tpoIdentificacion:tpoIde, identificacion:ide},
                    success: function(data){
                        $('#regTratamientos').html(data);
                    }
                });

            }

        },

        //Visualizacion de valor del tratamiento y si tiene Dto.
        cargarValorTratamiento:function(select){

            option = $(select).find(":selected");
            dto = 'No';

            if($(option).data('aplica-dto') == 1){
                dto = 'Si';
            }

            $('#view_Valor').html($(option).data('valor'));
            $('input[name="valorTratamiento"]').val($(option).data('valor'));

            $('#view_descuento').html(dto);
            $('input[name="dtoTratamiento"]').val($(option).data('aplica-dto'));


        },

        // Envio de nuevo tratamiento para paciente
        relacionarTratamientoPaciente : function(){

            idPaciente      = $('#regTratamientos').find('tr:first').data('idpaciente');
            idCiudadP       = $('#regTratamientos').find('tr:first').data('idciudadp');
            idTratamiento   = $('select[name="idTratamiento"]').val();
            vlrTratamiento  = $('input[name="valorTratamiento"]').val();
            dtoTratamiento  = $('input[name="dtoTratamiento"]').val();


            if(
                ! this.validarCampo( idPaciente + ' == undefined', 'Debe generar la consulta a un paciente!') ||
                ! this.validarCampo( '"' + idTratamiento + '" == ""', 'Debe seleccionar un tratamiento!')
            )
                return false;

            $('#btnRelacionTratamiento')
                .html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>')
                .prop('disabled', true);


            dataSend = {
                idPaciente : idPaciente,
                idCiudad : idCiudadP,
                idTratamiento : idTratamiento,
                vlrTratamiento : vlrTratamiento,
                dtoTratamiento : dtoTratamiento
            };

            $.ajax({
                url: '<?php echo $_domain?>/pacientes/nuevoTratamiento',
                data : dataSend,
                success: function(response){

                    objTratamientosAp.validarCampo('false', '');
                    objTratamientosAp.consultarPaciente();

                    $('#btnRelacionTratamiento').html('Enviar').prop('disabled', false);
                },
                error: function(response){
                    objTratamientosAp.validarCampo('true', response.responseText);
                    $('#btnRelacionTratamiento').html('Enviar').prop('disabled', false);
                }
            });

            console.log(idPaciente, idCiudadP, idTratamiento, vlrTratamiento, dtoTratamiento);
        },

        // Validacion de campos
        validarCampo : function(valid, label){

            if(eval(valid))
            {
                $('#erroresCampos')
                    .addClass('alert')
                    .addClass('alert-warning')
                    .html(label);

                return false;
            }

            $('#erroresCampos').removeClass('alert').removeClass('alert-warning').html('');
            return true;
        }


    };

    var objTratamientosAp = new TratamientosAplicados();

    $(document).ready(function(){

        //Consultar paciente
        $('#btnConsultar').click(function(){
            objTratamientosAp.consultarPaciente();
        });

        $('#tratamientos').select2();

        $('select[name="idTratamiento"]').change(function(){
            objTratamientosAp.cargarValorTratamiento($(this));
        });

        $('#btnRelacionTratamiento').click(function(){
            objTratamientosAp.relacionarTratamientoPaciente();
        });

    });

</script>