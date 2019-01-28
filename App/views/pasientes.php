<?php $pasientesItem = 'active'?>
<?php include(dirname(__FILE__) . '/partials/headerPP.php');  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php $tituloMod = 'Pacientes <small>Histórico</small>'?>
    <?php $items[] = ['label' => 'Pacientes', 'icon' => 'fa-users', 'active' => 1]?>
    <?php include(dirname(__FILE__) . '/partials/ustedEstaAqui.php')?>

    <style>

        .cabeceras
        {
            font-weight: bold;
            text-align: center;
            padding-top: 2px;
        }

        .historico-pasientes .row .col-md-2,
        .historico-pasientes .row .col-md-1
        {
            border: 1px solid #9E9E9E;
            height: 55px !important;
        }

        .historico-pasientes {
            margin-right: 5px !important;
            margin-left: 5px !important;
        }

    </style>

    <!-- Main content -->
    <section class="content">

        <!-- Histórico de usuarios-->
        <div class="box box-default">
            <div class="box-header ">
                <h3></h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="<?php $_domain?>/pacientes/formularioCreacion">
                        <i class="fa fa-plus"></i> Crear Paciente
                    </a>
                </div>
            </div>

            <div class="box-header">
                <h3 class="box-title">Pacientes registrados</h3>
            </div>
            <div class="box-body">

                <div class="row historico-pasientes">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2 cabeceras">Nombres</div>
                            <div class="col-md-2 cabeceras">Apellidos</div>
                            <div class="col-md-1 cabeceras">Tipo de documento</div>
                            <div class="col-md-2 cabeceras">Número de documento</div>
                            <div class="col-md-2 cabeceras">Ciudad de residencia</div>
                            <div class="col-md-2 cabeceras">Dirección</div>
                            <div class="col-md-1 cabeceras">Teléfono</div>
                        </div>

                        <?php if(isset($pasientes)) : ?>
                            <?php foreach($pasientes as $pasiente):?>
                                <div class="row">
                                    <div class="col-md-2"><?php echo $pasiente['nombres']?></div>
                                    <div class="col-md-2"><?php echo $pasiente['apellidos']?></div>
                                    <div class="col-md-1"><?php echo $pasiente['tpo_identificacion']?></div>
                                    <div class="col-md-2"><?php echo $pasiente['identificacion']?></div>
                                    <div class="col-md-2"><?php echo $pasiente['ciudad']?></div>
                                    <div class="col-md-2"><?php echo $pasiente['direccion']?></div>
                                    <div class="col-md-1"><?php echo $pasiente['telefono']?></div>
                                </div>
                            <?php endforeach?>
                        <?php endif?>


                    </div>
                </div>
                <br>
                <!-- /.Histórico de usuarios-->

            </div>

            <div class="box-header with-boder">
                <h3 class="box-title"></h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nombres y Apellidos</th>
                            <?php if(isset($pasientes)) : ?>
                            <?php foreach($pasientes as $pasiente):?>
                            <td><?php echo $pasiente['nombres']?> <?php echo $pasiente['apellidos']?></td>
                            <?php endforeach?>
                            <?php endif?>
                        </tr>

                        <tr>
                            <th>Documento</th>
                            <?php if(isset($pasientes)) : ?>
                                <?php foreach($pasientes as $pasiente):?>
                                    <td><?php echo $pasiente['tpo_identificacion'] . $pasiente['identificacion']?></td>
                                <?php endforeach?>
                            <?php endif?>
                        </tr>

                        <tr>
                            <th>Dirección y teléfono</th>
                            <?php if(isset($pasientes)) : ?>
                                <?php foreach($pasientes as $pasiente):?>
                                    <td><?php echo $pasiente['ciudad'] .' '. $pasiente['direccion'] .', '. $pasiente['telefono']?></td>
                                <?php endforeach?>
                            <?php endif?>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include(dirname(__FILE__) . '/partials/footer.php');  ?>
