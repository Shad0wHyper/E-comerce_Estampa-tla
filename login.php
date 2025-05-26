<?php
// login.php
require_once 'includes/config.php';

// Si ya está logueado, redirigir al inicio
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';

    // Validación básica
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email no válido.';
    } else {
        // Buscar usuario en la BD
        $stmt = $pdo->prepare('SELECT id, name, email, password, role FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($pass, $user['password'])) {
            // Iniciar sesión
            unset($user['password']);
            $_SESSION['user'] = $user;
            header('Location: index.php');
            exit;
        } else {
            $error = 'Email o contraseña incorrectos.';
        }
    }
}

require_once 'includes/header.php';
?>

<main>
    <style>
        .alt-action {
            text-align: center;
            margin-top: 1.5rem;       /* Separación desde el botón */
            font-size: 0.95rem;       /* Ligera atención a la tipografía */
            color: #555;              /* Gris suave para el texto */
        }

        /* Enlace azul que pasa a marrón al hover */
        .alt-action a {
            color: #007BFF;           /* Azul vivo por defecto */
            font-weight: 600;         /* Un poco más de peso para que destaque */
            text-decoration: none;
            transition: color 0.2s;
        }

        .alt-action a:hover {
            color: #7c6b61;           /* Marrón de la paleta al pasar el ratón */
        }
    </style>
    <section class="client-interface login">
        <h2>Iniciar Sesión</h2>

        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error, ENT_QUOTES) ?></p>
        <?php endif; ?>

        <form class="registration-form login-form" method="post" action="login.php">
            <div class="input-group">
                <input type="email" name="email" placeholder="Correo electrónico" required />
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Contraseña" required />
            </div>
            <button type="submit">Entrar</button>
        </form>

        <p class="alt-action">
            ¿No tienes cuenta? <a href="register.php">Regístrate aquí</a>
        </p>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>
