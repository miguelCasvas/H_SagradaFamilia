<?php $tratamientosItem = 'active'?>
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
    <?php $tituloMod = 'Tratamientos <small>creación</small>'?>
    <?php $items[] = ['label' => 'Tratamientos', 'icon' => 'fa-medkit', 'active' => 1]?>
    <?php include(dirname(__FILE__) . '/partials/ustedEstaAqui.php')?>

    <!-- Main content -->
    <section class="content">

        <!-- Histórico de usuarios-->
        <div class="box box-default">
            <div class="box-header ">
                <h3></h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="<?php $_domain?>/tratamientos/historico">
                        <i class="fa fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form action="<?php echo $urlForm?>" class="form form-horizontal" id="formTratamiento" method="post">

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre del tratamiento"
                                           value="<?php echo @$tratamiento['nombre']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Valor</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="valor" placeholder="Valor del tratamiento"
                                           value="<?php echo @$tratamiento['valor']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Apl. descuento</label>
                                <div class="col-sm-10">
                                    <select name="aplicaDto" id="" class="form-control">
                                        <option value="">Seleccione</option>
                                        <option value="1" <?php echo (@ ($tratamiento['aplicaDto'] == 1) ? 'selected' : '') ?>>Si</option>
                                        <option value="0" <?php echo (@ ($tratamiento['aplicaDto'] == 0) ? 'selected' : '') ?>>No</option>
                                    </select>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
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
                    <button class="btn btn-primary" id="btnEnviarTratamiento">Enviar</button>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include(dirname(__FILE__) . '/partials/footer.php');  ?>

<script>
    var FormTratamiento = function(){};

    FormTratamiento.prototype = {

        keyNumbers : function(evt){

            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;

        },

        enviarFormulario : function(){

            var banderaTratamientos = true;
            var txtError = '';


            $.each([
                $('input[name="nombre"]'),
                $('input[name="valor"]'),
                $('select[name="descuento"]'),
            ], function(index, element){

                if ($(element).val() == ''){
                    banderaTratamientos = false;
                    txtError = 'Debe diligenciar todos los campos';
                }
            });

            if(banderaTratamientos){
                $('#formTratamiento').submit();
            }else{
                $('#divAlertas').removeClass('alert-info').addClass('alert-warning');
                $('#alertas').html('Debe diligenciar todos los campos');
            }

        },

    };

    var objTratamiento = new FormTratamiento();

    $(document).ready(function(){
       $('#btnEnviarTratamiento').click(function(){objTratamiento.enviarFormulario();});
       $('input[name="valor"]').keypress(objTratamiento.keyNumbers);


    });

</script>