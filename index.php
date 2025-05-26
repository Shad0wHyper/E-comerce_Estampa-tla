<!DOCTYPE html>
<html lang="es">
<head>
    <?php
    require_once 'includes/config.php';
    require_once 'includes/header.php';
    ?>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Estampa-TLA - Home</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>


<section class="hero" style="display: flex; max-width: 1200px; margin: auto;">
    <div class="left" style="flex: 1; background-color: #7c6b61; color: white; padding: 60px 40px;">
      <div class="icon">
        <img src="Imagenes/Iconos/Icon1.png" alt="Icono" style="width: 40px; height: 40px;" />
      </div>
      <p>Diseños exclusivos para cada persona</p>
      <h2>Tu estilo,<br>tu estampado,<br>tu esencia.</h2>
      <button>COMPRA AHORA</button>
    </div>
    <div class="right" style="flex: 2;">
      <img src="Imagenes/flat-lay-composition-different-sized-plates 1.png" alt="Foto" style="width: 100%; height: 100%; object-fit: cover;" />
    </div>
  </section>

<section class="categories">
  <div class="category-item">
    <img src="Imagenes/Caballero.png" alt="Caballero" />
    <span>CABALLERO</span>
  </div>
  <div class="category-item">
    <img src="Imagenes/Dama.png" alt="Dama" />
    <span>DAMA</span>
  </div>
  <div class="category-item">
    <img src="Imagenes/Ediciones_Limitadas.png" alt="Ediciones Limitadas" />
    <span>EDICIONES LIMITADAS</span>
  </div>
  <div class="category-item">
    <img src="Imagenes/Colecciones.png" alt="Colecciones" />
    <span>COLECCIONES</span>
  </div>
</section>

<section class="promo-section">
  <div class="promo-text">
    40% DE DESCUENTO EN EL ESTILO GÓTICO
    <a href="#">COMPRA AHORA</a>
  </div>
  <div class="promo-images">
    <img src="Imagenes/Descuento1.png" alt="Promo1" />
    <img src="Imagenes/Descuento2.png" alt="Promo2" />
    <img src="Imagenes/Descuento3.png" alt="Promo3" />
  </div>
</section>

<!-- Diseños Populares: dinámico desde BD -->
<section class="popular-designs">
    <h2>DISEÑOS POPULARES</h2>
    <div class="products-grid">
        <?php
        // Traer, por ejemplo, los 8 productos más vendidos o recientes
        $stmt = $pdo->query('SELECT id, name, price, image FROM products WHERE stock > 0 ORDER BY created_at DESC LIMIT 8');
        $featured = $stmt->fetchAll();
        if ($featured):
            foreach ($featured as $p): ?>
                <div class="product-card">
                    <a href="product.php?id=<?= $p['id'] ?>">
                        <img src="<?= htmlspecialchars($p['image'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($p['name'], ENT_QUOTES) ?>" />
                        <div class="product-info">
                            <h3><?= htmlspecialchars($p['name'], ENT_QUOTES) ?></h3>
                        </div>
                        <div class="product-price">$<?= number_format($p['price'], 2) ?></div>
                    </a>
                    <form method="post" action="add_to_cart.php">
                        <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn add-to-cart">AGREGAR AL CARRITO</button>
                    </form>
                </div>
            <?php
            endforeach;
        else: ?>
            <p>No hay productos populares disponibles.</p>
        <?php endif; ?>
    </div>
</section>
<section class="info-section">
  <div class="info-text">
    <h3>PERSONALIZACIÓN</h3>
    <p>Selecciona tu diseño, elige el tipo de estampado y añade tu toque personal.</p>
    <a href="#">LEER MÁS</a>
  </div>
  <div class="info-image">
    <img src="Imagenes/Perzonalizacion.png" alt="Personalización" />
  </div>
</section>

<section class="info-section" style="flex-direction: row-reverse;">
  <div class="info-text">
    <h3>¿QUIÉNES SOMOS?</h3>
    <p>En Estampa-Tla, nos especializamos en la creación de playeras personalizadas que reflejan tu estilo y personalidad. Desde temáticas geek hasta rockeras, tenemos algo para cada gusto.</p>
    <a href="#">LEER MÁS</a>
  </div>
  <div class="info-image">
    <img src="Imagenes/quienes_somos.png" alt="Quiénes Somos" />
  </div>
</section>

<section class="new-designs">
    <h2>NUEVOS DISEÑOS</h2>
    <div class="products-grid">
        <?php
        $stmt = $pdo->query('SELECT id, name, price, image, description FROM products WHERE stock > 0 ORDER BY created_at DESC LIMIT 4');
        $newDesigns = $stmt->fetchAll();
        if ($newDesigns):
            foreach ($newDesigns as $product): ?>
                <div class="product-card">
                    <a href="product.php?id=<?= $product['id'] ?>">
                        <img src="<?= htmlspecialchars($product['image'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES) ?>" />
                        <div class="product-info">
                            <h3><?= htmlspecialchars($product['name'], ENT_QUOTES) ?></h3>
                            <p><?= htmlspecialchars($product['description'], ENT_QUOTES) ?></p>
                        </div>
                        <div class="product-price">$<?= number_format($product['price'], 2) ?></div>
                    </a>
                    <form method="post" action="add_to_cart.php">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn add-to-cart">AGREGAR AL CARRITO</button>
                    </form>
                </div>
            <?php endforeach;
        else: ?>
            <p>No hay nuevos diseños disponibles.</p>
        <?php endif; ?>
    </div>
</section>

<section style="text-align:center; margin: 50px 20px;">
  <p>Inicia sesión con email</p>
  <h3>PARA NOTICIAS, COLECCIONES Y MAS</h3>
  <input type="email" placeholder="ingresa tu dirección de email" style="padding: 10px; width: 250px; margin-top: 10px;"/>
  <br/>
  <button style="margin-top: 15px; padding: 10px 25px; font-weight: 700; cursor: pointer;">REGÍSTRATE</button>
</section>


<?php require_once 'includes/footer.php'; ?>

</body>
</html>
