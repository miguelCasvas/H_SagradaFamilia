<?php $pasientesItem = 'active'?>
<?php include(dirname(__FILE__) . '/partials/headerPP.php');  ?>

<style>
    .control-label::before{
        content: '*';
        padding-right: 5px;
        color: #C62828;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Control de errores -->
    <?php include(dirname(__FILE__) . '/partials/errorGeneral.php')?>

    <!-- Content Header (Page header) -->
    <?php $tituloMod = 'Pacientes <small>formulacio de creación</small>'?>
    <?php
        $items[] = ['label' => 'Pacientes', 'icon' => 'fa-users', 'url' => $_domain . '/pacientes/historico'];
        $items[] = ['label' => 'Formulario creación', 'icon' => 'fa-pencil', 'active' => 1];
    ?>
    <?php include(dirname(__FILE__) . '/partials/ustedEstaAqui.php')?>

    <!-- Main content -->
    <section class="content">

        <div class="box box-default">
            <div class="box-header ">
                <h3></h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="<?php $_domain?>/pacientes/historico">
                        <i class="fa fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
            <div class="box-body">
                <!-- Formulario creación de usuarios-->
                <div class="row">
                    <div class="col-md-6 col-md-offset-1">

                        <form action="<?php echo $_domain?>/pacientes/crear" class="form form-horizontal" id="formPasiente" method="post">

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Tpo. identificación</label>
                                <div class="col-sm-10">
                                    <select name="tpo_identificacion" id="" class="form-control">
                                        <option value="">Seleccione</option>
                                        <option value="T.I">T.I</option>
                                        <option value="C.C">C.C</option>
                                        <option value="C.E">C.E</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Identificación</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="identificacion" placeholder="Identificación">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Nombres</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nombres" placeholder="Nombres">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Apellidos</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="apellidos" placeholder="Apellidos">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Ciudad</label>
                                <div class="col-sm-10">
                                    <select name="id_ciudad" id="" class="form-control">
                                        <option value="">Seleccione</option>
                                        <?php if(isset($ciudades)) : ?>
                                            <?php foreach($ciudades as $ciudad):?>
                                                <option value="<?php echo $ciudad['id']?>"><?php echo $ciudad['ciudad']?></option>
                                            <?php endforeach?>
                                        <?php endif?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Dirección</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="direccion" placeholder="Dirección">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Teléfono</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="telefono" placeholder="Teléfono">
                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="col-md-5">
                        <div class="alert alert-info" id="divAlertas">
                            <h4>
                            <i class="fa fa-info-circle"></i>
                                Todos los campos son obligatorios
                            </h4>
                            <p id="alertas"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <div class="pull-right">
                    <button class="btn btn-primary" id="enviarFormPasiente">Enviar</button>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include(dirname(__FILE__) . '/partials/footer.php');  ?>

<script>
    var FormularioPasientes = function(){};

    FormularioPasientes.prototype  = {

        keyNumbers : function(evt){

            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;

        },

        enviarFormulario : function(){

            var banderaEnvio = true;

            $.each([
                $('select[name="tpo_identificacion"]'),
                $('input[name="identificacion"]'),
                $('input[name="nombres"]'),
                $('input[name="apellidos"]'),
                $('input[name="direccion"]'),
                $('input[name="telefono"]'),

            ], function(index, element){

                    if($(element).val() == '' || $(element).val() == undefined)
                        banderaEnvio = false;

            });

            if(banderaEnvio){
                $('#formPasiente').submit();
            }else{
                $('#divAlertas').removeClass('alert-info').addClass('alert-warning');
                $('#alertas').html('Debe diligenciar todos los campos');
            }

        }

    };

    var objClassFormPasiente = new FormularioPasientes();

    $(document).ready(function(){

        $('#enviarFormPasiente').click(function(){
            objClassFormPasiente.enviarFormulario();
        });

            /* Validacion campos numericos*/
        $('input[name="identificacion"]').keypress(function($event){ return objClassFormPasiente.keyNumbers($event);});
        $('input[name="telefono"]').keypress(function($event){ return objClassFormPasiente.keyNumbers($event);});

    });

</script>