<section class="content-header">
    <h1>
        <?php echo (@$tituloMod ?: '.: :.')?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo  $_domain?>/home/inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <?php if(isset($items)) : ?>
            <?php foreach($items as $item):?>
                <?php if(! isset($item['active'])):?>
                    <li>
                        <a href="<?php echo  $item['url']?>">
                            <i class="fa <?php echo $item['icon']?>"></i> <?php echo $item['label']?>
                        </a>
                    </li>
                <?php else:?>
                    <li class="active">
                        <i class="fa <?php echo $item['icon']?>"></i> <?php echo $item['label']?>
                    </li>
                <?php endif?>
            <?php endforeach?>
        <?php endif?>
    </ol>
</section>