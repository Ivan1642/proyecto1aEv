<!doctype html>
<html lang="sp">
    <head>
        <title>Carrito</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
            <link rel="stylesheet" href="carrito.css">
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
            }else{
                const enlaceComprar = document.getElementById('enlaceComprar');
                if(enlaceComprar){
                    enlaceComprar.style.display = 'none';
                }
            }

            function cargarCarrito(idCarrito){
                fetch('../servicios/carritoService.php?idCarrito=' + idCarrito)
                    .then(response => response.json())
                    .then(data => {
                        if(data.length === 0){
                            document.getElementById('divArtCar').innerHTML = "No hay productos en el carrito";
                            return;
                        }

                        let divArtCar = document.getElementById('divArtCar');
                        divArtCar.innerHTML = '';

                        data.forEach(producto => {
                            let filaCarrito = document.createElement('div');
                            filaCarrito.classList.add('filaCarrito', 'row', 'justify-content-around');

                            filaCarrito.innerHTML = `
                                <img src="data:image/avif;base64,${producto.foto}" class="imgProd col-3" alt="Imagen de producto">
                                <h1 class="col-3" style="color: #003942;">${producto.nombre}</h1>
                                <p class="col-2" style="color: #003942;">${producto.precio}€</p>
                                <p class="col-2">${producto.peso}g</p>
                                <img src="../imagenes/iconoTrash.png" class="imgTrash col-2 col-md-1" alt="Eliminar producto">
                                `;

                                divArtCar.appendChild(filaCarrito);
                        });
                    })
                    .catch(error => {
                        console.error('Error al cargar los productos');
                    });
            }
            let carrito_id = sessionStorage.getItem('carrito_id');
            cargarCarrito(carrito_id);
        })
    </script>
        <header>
            <div class="row d-flex justify-content-between">
                <!-- Logo -->
                <div id="divLogo">
                    <a href="index.php"><img src="../imagenes/logoMyFitness.png" id="logoHeader"></a>
                </div>
                <div class="d-flex justify-content-end col-3">
                  <!-- Mi Cuenta -->
                  <div class="col-6 d-flex justify-content-center align-items-center" id="divMiCuenta">
                    <a href="inicioSesion.html" class="enlaceMiCuenta"><img src="../imagenes/iconoPersona.webp" id="imgMiCuenta"></a>
                    <a href="inicioSesion.html" class="enlaceMiCuenta"><p class="d-none d-md-block" id="textoMiCuenta">Mi cuenta</p></a>
                  </div>
                </div>
              </div>
        </header>
        <main>
            <div id="divArtCar">

            </div>
            <a href="confirmacionPedido.php" id="enlaceComprar"><input type="submit" id="comprar" value="Comprar"></a>
        </main>
        <footer>
            
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"></script>
    </body>
</html>
