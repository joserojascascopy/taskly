<div class="login-container">

    <div class="login-card">

        <div class="login-header">
            <img class="logo-card" src="/assets/img/taskly-logo.png" alt="Logo Taskly">
            <h1 class="card-title">Iniciar Sesion</h1>
            <?php include_once __DIR__ . '/../components/btnGoogle.php'; ?>
            <p class="card-description">Ingresa tus credenciales para acceder a tu cuenta</p>
            <?php require_once __DIR__ . '/../components/alertas.php'; ?>
        </div>

        <form action="/" method="POST" class="login-form">
            <div class="form-group">
                <div class="email-header">
                    <label for="email">Correo electrónico</label>
                </div>
                <input type="email" id="email" name="email" placeholder="correo@ejemplo.com">
            </div>
            <div class="form-group">
                <div class="password-header">
                    <label for="password">Contraseña</label>
                    <a href="/forgot-password" class="forgot">¿Olvidaste tu contraseña?</a>
                </div>
                <input type="password" id="password" name="password">
            </div>
            <input type="submit" value="Iniciar Sesión" class="btn-login">
        </form>

        <div class="login-footer">
            <p class="register-link">¿No tienes una cuenta? <a href="/registrarse">Registrate</a></p>
        </div>

    </div>
</div>

<!-- En tu layout o vista principal -->
<script type="module" src="https://www.gstatic.com/firebasejs/10.9.0/firebase-app.js"></script>
<script type="module" src="https://www.gstatic.com/firebasejs/10.9.0/firebase-auth.js"></script>
<script type="module">
    import signInWithGoogle from '/assets/js/firebase.js';

    const apiKey = "<?php echo API_KEY; ?>"
    const authDomain = "<?php echo AUTH_DOMAIN; ?>"
    const projectId = "<?php echo PROJECT_ID; ?>"
    const storageBucket = "<?php echo STORAGE_BUCKET; ?>"
    const messagingSenderId = "<?php echo MESSAGING_SENDER_ID; ?>"
    const appId = "<?php echo APP_ID; ?>"

    document.querySelector(".btnGoogle").addEventListener("click", async () => {
        signInWithGoogle({
            apiKey,
            authDomain,
            projectId,
            storageBucket,
            messagingSenderId,
            appId
        });
    });
</script>