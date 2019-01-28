<?php include(dirname(__FILE__) . '/partials/headerPP.php');  ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?php $tituloMod = 'Escritorio <small>Panel de Control</small>'?>
        <?php include(dirname(__FILE__) . '/partials/ustedEstaAqui.php')?>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>150</h3>

                            <p>Ingresos totales</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-exit"></i>
                        </div>
                        <a href="<?php echo $_domain?>/informes/ingresos" class="small-box-footer">Detalle <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>53</h3>

                            <p>Visitas</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">Detalle <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

<?php include(dirname(__FILE__) . '/partials/footer.php');  ?>
