<?php
// includes/header.php
require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Estampa TLA</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Búsqueda inline */
        .search-form {
            display: none;
            position: absolute;
            top: 100%;
            right: 2rem;
            background: #fff;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .search-form input {
            border: 1px solid #ccc;
            padding: 0.25rem 0.5rem;
            width: 200px;
        }
        .search-form button {
            background: #7c6b61;
            color: #fff;
            border: none;
            padding: 0.25rem 0.75rem;
            cursor: pointer;
            margin-left: 0.25rem;
        }
        .search-icon {
            cursor: pointer;
            position: relative;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <a href="index.php">
            <img src="Imagenes/Logo estampa-tla 1.png" alt="Estampa-TLA" />
            <span>ESTAMPA-TLA</span>
        </a>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
    <div class="icons">
        <div class="search-icon">
            <img src="Imagenes/Iconos/Search.png" alt="Buscar" class="icon" id="toggle-search" />
            <form action="shop.php" method="get" class="search-form" id="search-form">
                <input type="text" name="q" placeholder="Buscar productos..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                <button type="submit">OK</button>
            </form>
        </div>
        <?php if(!isset($_SESSION['user'])): ?>
            <a href="login.php"><img src="Imagenes/Iconos/Avatar.png" alt="Perfil" class="icon" /></a>
        <?php else: ?>
            <a href="profile.php"><img src="Imagenes/Iconos/Avatar.png" alt="Mi Perfil" class="icon" /></a>
        <?php endif; ?>
        <a href="#"><img src="Imagenes/Iconos/Heart.png" alt="Favoritos" class="icon" /></a>
        <a href="cart.php"><img src="Imagenes/Iconos/Shopping cart.png" alt="Carrito" class="icon" /></a>
    </div>
</header>
<main>

    <script>
        const icon = document.getElementById('toggle-search');
        const form = document.getElementById('search-form');

        // Clic simple: abre si está cerrado
        icon.addEventListener('click', function(e) {
            e.stopPropagation();
            if (form.style.display !== 'block') {
                form.style.display = 'block';
                form.querySelector('input[name="q"]').focus();
            }
        });

        // Doble clic: cierra si está abierto
        icon.addEventListener('dblclick', function(e) {
            e.stopPropagation();
            if (form.style.display === 'block') {
                form.style.display = 'none';
            }
        });
    </script>
