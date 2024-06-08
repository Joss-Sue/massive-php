<nav>
    <section class="top-nav">
        <div class="container">
            <div class="row">
                <div class="col-3 name-page">
                    <a href="../dashboard/dashboard.php">
                        <img src="../../src/icons/Massive.svg" alt="">
                        <span class="bebas white-text">MASSIVE</span>
                    </a>
                </div>
                <div class="col-6 search-bar">
                    <form action="../products/products.php" method="POST">
                        <input type="text" name="search-bar" id="" placeholder="Busca algún producto">
                        <button type="submit"><img src="../../src/icons/mag-glass.svg" alt=""></button>
                    </form>
                </div>
                <div class="col-3 cart-user">
                    <a class="cart-icon" href="../userCart/userCart.php">
                        <img src="../../src/icons/whiteCart.svg" alt="">
                    </a>
                    <div class="user-menu">
                        <img src="../../src/icons/user.svg" alt="">
                        <div class="user-dropdown">
                            <p class="dropdown-item" id="user_name"></p>
                            <a class="dropdown-item" href="../userprofile/userprofile.php">Perfil</a>
                            <a class="dropdown-item" href="../cotizacionesAuth/cotizacionesAuth.php">Cotizaciones</a>
                            <a class="dropdown-item" href="../favorites/favorites.php">Favoritos</a>
                            <a class="dropdown-item" href="../orders/orders.php">Mis pedidos</a>
                            <a class="dropdown-item" href="../../config/cerrarSesion.php">Cerrar sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bottom-nav">
        <div class="container">
            <div class="row categories">
                <div class="col-2">
                </div>
                <div class="col-8 inter">
                    <form action="../products/products.php" method="POST">
                        <input type="hidden" name="categoryName" value="Electronica">
                        <button type="submit">Electronica</button>
                    </form>
                    <form action="../products/products.php" method="POST">
                        <input type="hidden" name="categoryName" value="Libros">
                        <button type="submit">Libros</button>
                    </form>
                    <a href="../products/products.php">Mostrar todos los productos</a>
                    <form action="../products/products.php" method="POST">
                        <input type="hidden" name="categoryName" value="Alimentos">
                        <button type="submit">Alimentos</button>
                    </form>
                    <form action="../products/products.php" method="POST">
                        <input type="hidden" name="categoryName" value="Deportes">
                        <button type="submit">Deportes</button>
                    </form>
                </div>
                <div class="col-2">
                </div>
            </div>
        </div>
    </section>
</nav>