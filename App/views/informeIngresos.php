<?php $informesItem = 'active'?>
<?php include(dirname(__FILE__) . '/partials/headerPP.php');  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php $tituloMod = 'Informes'?>
    <?php $items[] = ['label' => 'Informes', 'icon' => 'fa-bar-chart-o', 'active' => 1]?>
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
            </div>
            <div class="box-body">
                <div class="row">

                    <div class="col-md-4 col-md-offset-1">
                        <p class="text-center">
                            <strong>Ranking Razón de visita</strong>
                        </p>

                        <?php
                            $backGround = [
                                'progress-bar-green',
                                'progress-bar-aqua',
                                'progress-bar-yellow',
                                'progress-bar-red',
                            ];

                            $count = 0;
                        ?>

                        <?php foreach ($rankingRazonV as $reg):?>

                            <div class="progress-group">
                                <span class="progress-text"><?php echo $reg['tpoTratamiento']?></span>
                                <span class="progress-number">
                                    <b><?php echo $reg['cant_tratamientos']?></b>/
                                    <?php echo $totalIngreso['totalTratamientos']?>
                                </span>

                                <div class="progress sm">
                                    <div class="progress-bar <?php echo $backGround[$count]?>" style="width: 80%"></div>
                                </div>
                            </div>

                            <?php if (($count + 1) == count($backGround)) $count = 0; else $count++?>
                        <?php endforeach?>

                    </div>

                    <div class="col-md-5 col-md-offset-1">
                        <p class="text-center">
                            <strong>Informe Ingresos</strong>
                        </p>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Tipo Tratamiento</th>
                                <th>Ingresos en el mes</th>
                            </tr>

                            <?php if(isset($tabla_1)):?>
                                <?php foreach ($tabla_1 as $reg):?>
                                    <tr>
                                        <td><?php echo $reg['cant_tratamientos']?></td>
                                        <td><?php echo $reg['tpoTratamiento']?></td>
                                        <td>$<?php echo number_format($reg['ingresos'])?></td>
                                    </tr>
                                <?php endforeach?>
                            <?php endif;?>

                        </table>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <div class="row">

                    <?php foreach ($informeXmes as $key => $reg):?>

                        <div class="col-sm-3 col-xs-6 <?php echo (($key == 0) ? 'col-sm-offset-1' : '') ?>">
                            <div class="description-block border-right">
                                <span class="description-percentage text-green"><i class="fa fa-caret-right"></i>
                                    <?php echo $reg['anio']?>
                                </span>
                                <h5 class="description-header"><?php echo $reg['mes']?></h5>
                                <span class="description-text">
                                    TOTAL PACIENTES
                                    <span data-toggle="tooltip" title="" class="badge bg-default" data-original-title="3 New Messages">
                                       <?php echo $reg['cant_pacientes']?>
                                    </span>
                                </span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->

                    <?php endforeach?>

                </div>
                <!-- /.row -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include(dirname(__FILE__) . '/partials/footer.php');  ?>
