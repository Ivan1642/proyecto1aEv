<!doctype html>
<html lang="sp">
<head>
  <title>Productos</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="productos.css">
</head>
<body>
  <?php
    session_start();
  ?>
  <script>
    const email = <?php echo json_encode($_SESSION['email'] ?? null); ?>;

    document.addEventListener("DOMContentLoaded", () =>{
      if(email){
        const textoMiCuenta = document.querySelector("#textoMiCuenta");
        if(textoMiCuenta){
          textoMiCuenta.textContent = "Sesión Iniciada";
        }

        const enlaceMiCuenta = document.querySelector("#enlaceMiCuenta");
        if(enlaceMiCuenta){
          enlaceMiCuenta.href = "../servicios/logout.php";
        }

        const enlaceMiCuenta2 = document.querySelector("#enlaceMiCuenta2");
        if(enlaceMiCuenta2){
          enlaceMiCuenta2.href = "../servicios/logout.php";
        }
      }    
    });
  </script>
  <header>
    <div class="row d-flex justify-content-between">
        <!-- Logo -->
        <div id="divLogoHeader">
          <a href="index.php"><img src="../imagenes/logoMyFitness.png" id="logoHeader"></a>
        </div>
        <!-- Barra de busqueda -->
        <div class="col-4 d-flex justify-content-center align-items-center">
          <input type="text" name="barraBusqueda" id="barraBusqueda" placeholder="Buscar...">
        </div>
        <div class="d-flex justify-content-end col-3">
          <!-- Mi Cuenta -->
          <div class="col-6 d-flex justify-content-center align-items-center">
            <a href="inicioSesion.html" id="enlaceMiCuenta"><img src="../imagenes/iconoPersona.webp" id="imgMiCuenta"></a>
            <a href="inicioSesion.html" id="enlaceMiCuenta2"><p class="d-none d-md-block" id="textoMiCuenta">Mi cuenta</p></a>
          </div>
          <!-- Carrito -->
          <div class="col-6 d-flex justify-content-center align-items-center">
            <a href="carrito.php"><img src="../imagenes/carrito.png" id="imgCarrito"></a>
            <a href="carrito.php"><p class="d-none d-md-block" id="textoCarrito">Carrito</p></a>
          </div>
        </div>
      </div>
  </header>
  <main>
    <!-- Div Productos -->
    <div id="divProductos" class="row justify-content-center">
      <!-- Fin div Productos -->
    </div>
  </main>
  <footer>
    <div class="row d-flex justify-content-between">
        <!-- Logo -->
        <img src="../imagenes/logoMyFitness.png" id="logoFooter">
        <!-- Dropdown -->
        <div class="dropdown d-none d-md-block  col-md-2">
          <br>
          <br>
          <br>
          <br>
          <button id="dropdown" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Español
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item active" href="#">Español</a></li>
            <li><a class="dropdown-item" href="#">Català</a></li>
            <li><a class="dropdown-item" href="#">English</a></li>
          </ul>
        </div>
        <!-- Ayuda y Servicio al cliente -->
        <div class="col-3 col-md-2 enlacesAyuda">
          <p class="pFooter">Servicio al cliente</p>
          <p class="pFooter">Centro de ayuda</p>
          <p class="pFooter">Devoluciones</p>
          <p class="pFooter">Envíos a España</p>
        </div>
        <div class="col-3 col-md-2 enlacesAyuda">
          <p class="pFooter">Rastrear pedido</p>
          <p class="pFooter">Contáctanos</p>
          <p class="pFooter">Envíos internacionales</p>
          <p class="pFooter">Cookie settings</p>
        </div>
        <!-- Redes sociales -->
        <div class="col-1 d-lg-flex align-items-center">
          <br>
          <br>
          <br>
          <img class="redSocial" id="instagram" src="../imagenes/instagram.webp">
          <img class="redSocial" src="../imagenes/twitter.webp">
          <img class="redSocial" src="../imagenes/yt.webp">
        </div>
      </div>
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      fetch('../controladores/productosController.php')
        .then(response => response.json())
        .then(productos => {
          const divProductos = document.getElementById('divProductos');
          divProductos.innerHTML = '';

          productos.forEach(producto => {

            //card
            const card = document.createElement('div');
            card.classList.add('card');
            card.style.width = '18rem';

            //imagen de la card
            const img = document.createElement('img');
            img.classList.add('card-img-top');
            img.src = `data:image/png;base64,${producto.foto}`;
            img.alt = producto.nombre;

            //cuerpo de la card
            const cardBody = document.createElement('div');
            cardBody.classList.add('card-body');

            //titulo de la card
            const cardTitle = document.createElement('h5');
            cardTitle.classList.add('card-title');
            cardTitle.textContent = producto.nombre;

            //peso
            const peso = document.createElement('p');
            peso.textContent = `Peso: ${producto.peso}g`;

            //precio
            const precio = document.createElement('p');
            precio.textContent = `Precio: ${producto.precio}€`;

            //descripcion
            const descripcion = document.createElement('p');
            descripcion.textContent = `${producto.descripcion}`;

            //segundo cuerpo de la card
            const cardBodyButtons = document.createElement('div');
            cardBodyButtons.classList.add('card-body');

            //Boton detalles
            const linkDetails = document.createElement('a');
            linkDetails.href = `detalleProducto.php?id=${producto.idProducto}`;
            linkDetails.textContent = 'Detalles';
            linkDetails.classList.add('btn','btn-primary');

            //Boton añadir al carrito
            const buttonAddToCart = document.createElement('button');
            buttonAddToCart.textContent = 'Añadir al carrito';
            buttonAddToCart.classList.add('btn','btn-secondary');
            buttonAddToCart.setAttribute('data-id',producto.idProducto);

            //insertar elementos en el sitio
            cardBody.appendChild(cardTitle);
            cardBody.appendChild(peso);
            cardBody.appendChild(precio);
            cardBody.appendChild(descripcion);
            card.appendChild(img);
            card.appendChild(cardBody);
            cardBodyButtons.appendChild(linkDetails);
            cardBodyButtons.appendChild(buttonAddToCart);
            card.appendChild(cardBodyButtons);
            divProductos.appendChild(card);
          });
        })
        .catch(error => console.error('Error: ' , error));
    });
  </script>
</body>
</html>