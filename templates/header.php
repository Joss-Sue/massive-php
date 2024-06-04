<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Massive</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="./../styles.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <nav>
        <div class="header">
            <div class="one-col"></div>
            <div class="two col name-page">
                <img src="./../Massive.svg" alt="">
                <span class="bebas white-text">MASSIVE</span>
            </div>
            <div class="six-col search-bar">
                <span>
                    <input type="text" name="" id="" placeholder="Busca algún producto">
                    <a href=""><img src="./../mag-glass.svg" alt=""></a>
                </span>
            </div>
            <div class="two col cart-user">
                <img src="./../whiteCart.svg" alt="">
                <img src="./../user.svg" alt="">
            </div>
            <div class="one-col"></div>
        </div>
        <div class="categories">
            <div class="three-col"></div>
            <div class="six-col inter">
                <a href="">Electronica</a>
                <a href="">Libros</a>
                <a href="">Alimentos</a>
                <a href="">Hogar</a>
                <a href="">Deportes</a>
            </div>
            <div class="three-col"></div>
        </div>
    </nav>
    <section class="home-body">
        <div class="container">
            <div class="row banner">
                <div class="col-2"></div>
                <div class="col-2">
                    <img src="./../Massive.svg" alt="">
                </div>
                <div class="col-5 white-text bebas">
                    <span>TODO,</span>
                    <span>AHORA,</span>
                    <span>EN TUS MANOS</span>
                </div>
                <div class="col-3"></div>
            </div>
            <div class="row cards-section">
                <div class="col-4 card-custom">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="headphones.png" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title">Audifonos Negros</h5>
                        <p class="card-text">ENVÍO GRATIS</p>
                        <p class="card-text">$800</p>
                        <a class="bebas cart-button" href="">Agregar al carrito</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 card-custom">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="shoes.png" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title">Zapatos Negros</h5>
                        <p class="card-text">ENVÍO GRATIS</p>
                        <p class="card-text">$400</p>
                        <a class="bebas cart-button" href="">Agregar al carrito</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 card-custom">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="cactus.png" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title">Cactus</h5>
                        <p class="card-text">ENVÍO GRATIS</p>
                        <p class="card-text">$200</p>
                        <a class="bebas cart-button" href="">Agregar al carrito</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>