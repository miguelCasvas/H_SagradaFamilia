<?php if(isset($_error)):?>
<div style="padding: 20px 30px; background: rgb(243, 156, 18); z-index: 999999; font-size: 16px; font-weight: 600;">
    <a href="https://themequarry.com" style="color: rgba(255, 255, 255, 0.9); display: inline-block; margin-right: 10px; text-decoration: none;">
        <?php echo $_error->getMessage()?>
    </a>
</div>
<?php endif;?>