<div class="confirm-container">

    <div class="confirm-card">

        <div class="confirm-header">
            <img class="logo-card" src="/assets/img/taskly-logo.png" alt="Logo Taskly">
            <h1 class="card-title"><?php echo $error ? "Cuenta no confirmada" :  "Cuenta Confirmada"; ?></h1>
            <?php
            require_once __DIR__ . '/../components/alertas.php';
            if($error) {
                return;
            }
            ?>
        </div>

        <div class="confirm-footer">
            <a class="btn-confirm" href="/">Inicia Sesión</a>
        </div>
        
    </div>
</div>