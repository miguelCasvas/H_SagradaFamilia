<?php $tratamientosItem = 'active'?>
<?php include(dirname(__FILE__) . '/partials/headerPP.php');  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Control de errores -->
    <?php include(dirname(__FILE__) . '/partials/errorGeneral.php')?>

    <!-- Control de success -->
    <?php include(dirname(__FILE__) . '/partials/successGeneral.php')?>

    <!-- Content Header (Page header) -->
    <?php $tituloMod = 'Tratamientos <small>histórico</small>'?>
    <?php $items[] = ['label' => 'Tratamientos', 'icon' => 'fa-medkit', 'active' => 1]?>
    <?php include(dirname(__FILE__) . '/partials/ustedEstaAqui.php')?>

    <style>
        .table-bordered>thead>tr>th,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>tbody>tr>td,
        .table-bordered>tfoot>tr>td {
            border: 1px solid #9E9E9E;
        }
    </style>

    <!-- Main content -->
    <section class="content">

        <!-- Histórico de usuarios-->
        <div class="box box-default">
            <div class="box-header ">
                <h3></h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="<?php $_domain?>/tratamientos/formularioCreacion">
                        <i class="fa fa-plus"></i> Crear Tratamiento
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <table class="table table-bordered">

                            <tr>
                                <th>Tratamiento</th>
                                <th>Valor</th>
                                <th>Aplica Dto.</th>
                                <th>Acciones</th>
                            </tr>

                            <tbody>
                                <?php if(isset($tratamientos)) : ?>
                                    <?php foreach($tratamientos as $tratamiento):?>
                                        <tr>
                                            <td><?php echo $tratamiento['nombre']?></td>
                                            <td><?php echo $tratamiento['valor']?></td>
                                            <td><?php echo $tratamiento['txt_aplicaDto']?></td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-align-justify"></i> <span class="caret"></span> </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="<?php echo $_domain?>/tratamientos/editar/<?php echo $tratamiento['id']?>">Editar</a></li>
                                                        <li><a href="<?php echo $_domain?>/tratamientos/eliminar/<?php echo $tratamiento['id']?>">Eliminar</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach?>
                                <?php endif?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include(dirname(__FILE__) . '/partials/footer.php');  ?>
