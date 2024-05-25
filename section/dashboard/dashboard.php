<?php // /massive/src/icons/
    require("../../config/sessionVerif.php");
    $titlename = "Massive-Home";
    $stylename = "home.css";
    $javascript = "script.js";
   
    require_once("../../templates/cabecera.php");
    switch($_SESSION['usuario_tipo']){
        case "comprador":
            require_once("../../templates/nav.php");
            break;
        case "vendedor":
            require_once("../../templates/navVendedor.php");
            break;
        case "admin":
            require_once("../../templates/navAdmin.php");
            break;
        default:
            header("Location:../login/login.php");
            break;
    }
    
 ?>
    
<section class="home-body">
        <div class="container">
            <div class="row banner">
                <div class="col-2"></div>
                <div class="col-2">
                    <img src="../../src/icons/Massive.svg" alt="">
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
    <div id=apiContenedor>api</div>
    
    <script>
        let data;
        async function obtenerClima() {
    const url = 'https://yahoo-weather5.p.rapidapi.com/weather?lat=25.725599072163917&long=-100.31504363210348&format=json&u=c';
    const options = {
        method: 'GET',
        headers: {
            //'X-RapidAPI-Key': '7ef6144718msh60afd44daf6e513p1596fcjsn01bb91265d48',
            'X-RapidAPI-Host': 'yahoo-weather5.p.rapidapi.com'
        }
    };

    try {
        const response = await fetch(url, options);
        const result = await response.json(); // Cambia 'response.text()' a 'response.json()'
        //console.log(result);
        return result; // Devuelve el resultado para poder usarlo fuera de la función
    } catch (error) {
        console.error(error);
    }
}

obtenerClima().then(data => {
    console.log(data); // Aquí puedes acceder al objeto JSON
    actualizarTemperaturas(data);
});


//let data=obtenerClima();
console.log(data);
let datos= {
    "location": {
        "city": "San Nicolás de los Garza",
        "region": "Nuevo León",
        "woeid": 144793,
        "country": "Mexico",
        "lat": 25.760031,
        "long": -100.273514,
        "timezone_id": "America/Monterrey"
    },
    "current_observation": {
        "pubDate": 1716649240,
        "wind": {
            "chill": 36,
            "direction": "North",
            "speed": 2
        },
        "atmosphere": {
            "humidity": 74,
            "visibility": 10,
            "pressure": 1008.5
        },
        "astronomy": {
            "sunrise": "5:51 AM",
            "sunset": "7:25 PM"
        },
        "condition": {
            "temperature": 29,
            "text": "Fair"
        }
    },
    "forecasts": [
        {
            "day": "Sat",
            "date": 1716652800,
            "high": 40,
            "low": 24,
            "text": "Clear",
            "code": 31
        },
        {
            "day": "Sun",
            "date": 1716739200,
            "high": 44,
            "low": 25,
            "text": "Hot",
            "code": 36
        },
        {
            "day": "Mon",
            "date": 1716825600,
            "high": 39,
            "low": 24,
            "text": "Hot",
            "code": 36
        },
        {
            "day": "Tue",
            "date": 1716912000,
            "high": 35,
            "low": 24,
            "text": "Thunderstorms",
            "code": 4
        },
        {
            "day": "Wed",
            "date": 1716998400,
            "high": 38,
            "low": 24,
            "text": "Partly Cloudy",
            "code": 30
        },
        {
            "day": "Thu",
            "date": 1717084800,
            "high": 37,
            "low": 26,
            "text": "Partly Cloudy",
            "code": 30
        },
        {
            "day": "Fri",
            "date": 1717171200,
            "high": 37,
            "low": 24,
            "text": "Partly Cloudy",
            "code": 30
        },
        {
            "day": "Sat",
            "date": 1717257600,
            "high": 38,
            "low": 23,
            "text": "Partly Cloudy",
            "code": 30
        },
        {
            "day": "Sun",
            "date": 1717344000,
            "high": 37,
            "low": 22,
            "text": "Thunderstorms",
            "code": 4
        },
        {
            "day": "Mon",
            "date": 1717430400,
            "high": 36,
            "low": 23,
            "text": "Partly Cloudy",
            "code": 30
        },
        {
            "day": "Tue",
            "date": 1717516800,
            "high": 38,
            "low": 20,
            "text": "Thunderstorms",
            "code": 4
        }
    ]
}


function actualizarTemperaturas(data) {
    let temperatura = data.current_observation.condition.temperature;
    let temperaturaMax = data.forecasts[0].high;
    let temperaturaMin = data.forecasts[0].low;

    // Selecciona el div con el id 'apiContenedor'
    let contenedor = document.getElementById('apiContenedor');

    // Establece el contenido HTML del div
    contenedor.innerHTML = `
        <p>Temperatura: ${temperatura}°C</p>
        <p>Temperatura Máxima: ${temperaturaMax}°C</p>
        <p>Temperatura Mínima: ${temperaturaMin}°C</p>
    `;
}

/*
var div = document.createElement('div');

// Crear un nuevo elemento p
var p = document.createElement('p');

// Establecer el contenido del elemento p
p.textContent = JSON.stringify(arreglo, null, 2);

// Agregar el elemento p al div
div.appendChild(p);

// Agregar el div al cuerpo del documento
document.body.appendChild(div);*/
    </script>
    
<?php include("../../templates/pie.php"); ?>