<div class="alerta">
    <?php
    if (isset($alertas['error'])) { ?>
        <p class="error"><?php echo $alertas['error']; ?></p>
    <?php } elseif(isset($alertas['exito'])) { ?>
        <p class="exito"><?php echo $alertas['exito']; ?></p>
    <?php } ?>
</div>