<?php
// register.php
require_once 'includes/config.php';

// Si ya está logueado, redirige a la página de inicio
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger y sanitizar datos
    $name         = trim($_POST['name'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $password     = $_POST['password'] ?? '';
    $confirm_pass = $_POST['confirm_password'] ?? '';

    // Validaciones básicas
    if ($password !== $confirm_pass) {
        $error = 'Las contraseñas no coinciden.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email no válido.';
    } elseif (empty($name)) {
        $error = 'El nombre no puede estar vacío.';
    } else {
        // Comprobar si el email ya existe
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = 'Este correo ya está registrado.';
        } else {
            // Insertar nuevo usuario
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare(
                'INSERT INTO users (name, email, password) VALUES (?, ?, ?)'
            );
            $stmt->execute([$name, $email, $hash]);

            // Loguear automáticamente
            $_SESSION['user'] = [
                'id'    => $pdo->lastInsertId(),
                'name'  => $name,
                'email' => $email,
                'role'  => 'customer'
            ];

            header('Location: index.php');
            exit;
        }
    }
}

require_once 'includes/header.php';
?>

<main>
    <section class="client-interface registration">
        <h2>Registro de Usuario</h2>
        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error, ENT_QUOTES) ?></p>
        <?php endif; ?>

        <form class="registration-form" method="post" action="register.php">
            <div class="input-group">
                <input type="text" name="name" placeholder="Nombre completo" required />
            </div>
            <input type="email" name="email" placeholder="Correo electrónico" required />
            <input type="password" name="password" placeholder="Contraseña" required />
            <input type="password" name="confirm_password" placeholder="Confirmar Contraseña" required />
            <button type="submit">REGISTRARSE</button>
        </form>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>
