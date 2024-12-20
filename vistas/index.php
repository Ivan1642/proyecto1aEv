<!doctype html>
<html lang="sp">
<head>
  <title>My Fitness</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
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

      fetch('../controladores/carritoController.php')
                .then(response => response.json())
                .then(data => {
                    const carritoId = data.carrito_id;
                    sessionStorage.setItem('carrito_id',carritoId);
                })
                .catch(error => {
                    console.error('Error al obtener el carrito');
                });
    })
  </script>
  <header>
    <div class="row d-flex justify-content-between">
      <!-- Logo -->
      <div id="divLogo">
        <img src="../imagenes/logoMyFitness.png" id="logoHeader">
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
          <a href="carrito.php" id="enlaceCarrito"><img src="../imagenes/carrito.png" id="imgCarrito"></a>
          <a href="carrito.php" id="enlaceCarrito"><p class="d-none d-md-block" id="textoCarrito">Carrito</p></a>
        </div>
      </div>
    </div>
  </header>
  <main>
    <!-- Menu options -->
    <div class="row d-none d-md-flex justify-content-center align-items-center" id="barraOpciones">
      <p class="col-2 col-md-1 d-flex justify-content-center align-self-center"><a href="productos.php" class="enlaceBarraNav">Proteína</a></p>
      <p class="col-2 col-md-1 d-flex justify-content-center"><a href="productos.php" class="enlaceBarraNav">Nutrición</a></p>
      <p class="col-2 col-lg-1 d-flex justify-content-center"><a href="productos.php" class="enlaceBarraNav">Barritas y Snacks</a></p>
      <p class="col-2 col-md-1 d-flex justify-content-center"><a href="productos.php" class="enlaceBarraNav">Vitaminas</a></p>
      <p class="col-2 col-md-1 d-flex justify-content-center"><a href="productos.php" class="enlaceBarraNav">Vegan</a></p>
      <p class="col-2 col-md-1 d-flex justify-content-center"><a href="productos.php" class="enlaceBarraNav">Accesorios</a></p>
    </div>
    <!-- Menu options Dropdown -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light d-md-none">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Menu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="productos.php">Proteína</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="productos.php">Nutrición</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="productos.php">Barritas y Snacks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="productos.php">Vitaminas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="productos.php">Vegan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="productos.php">Accesorios</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Anuncio Descuento -->
    <div class="row d-flex justify-content-center" id="anuncioDescuento">
      <h1>-60% EN TODO</h1>
    </div>
    <!-- Carousel -->
    <div class="row">
      <div id="carouselId" class="col-12 carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li style="color: rgba(255, 255, 255, 0);" data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
            <li style="color: rgba(255, 255, 255, 0);" data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
            <li style="color: rgba(255, 255, 255, 0);" data-bs-target="#carouselId" data-bs-slide-to="2" aria-label="Third slide"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img src="../imagenes/imagenPortada.jpg" class="imgCar" alt="First slide">
            </div>
            <div class="carousel-item">
                <img src="../imagenes/imgCar2.webp" class="imgCar" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img src="../imagenes/imgCar3.webp" class="imgCar" alt="Third slide">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <!-- Carousel Button and Text -->
    <div id="divBtn">
      <a href="productos.php"><Button id="btnComprar">COMPRAR</Button></a>
      <h1 id="h1Desc">60% DESCUENTO</h1>
      <h2 id="h2Cod">Código: Eivor11</h2>
    </div>
    <!-- Newsletter md -->
    <h1 id="h1Newsletter" class="d-none d-md-block">NEWSLETTER</h1>
    <div id="row">
      <p class="d-none d-md-block col-md-2" id="textoNewsletter">Suscribete a nuestra Newsletter <br> para recibir un 10% de descuento</p>
      <form class="d-none d-md-block col-5" id="formNewsletter">
        <input id="introduccionEmail" class="col-6" type="text" placeholder="Email..." required>
        <input class="col-3" type="submit" id="enviarEmail" value="Enviar">
      </form>
    </div>
    <!-- Newsletter sm -->
    <h1 id="h1NewsletterSm" class="d-block d-md-none">NEWSLETTER</h1>
    <div id="row">
      <p class="d-block d-md-none col-4" id="textoNewsletterSm">Suscribete a nuestra Newsletter <br> para recibir un 10% de descuento</p>
      <form class="d-block d-md-none col-6" id="formNewsletterSm">
        <input class="col-6" type="text" placeholder="Email...">
        <input class="col-4" type="submit" id="enviarEmail" value="Enviar">
      </form>
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
        <img class="redSocial" src="../imagenes/instagram.webp">
        <img class="redSocial" src="../imagenes/twitter.webp">
        <img class="redSocial" src="../imagenes/yt.webp">
      </div>
    </div>
  </footer>
  <script></script>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
  </script>
</body>
</html>