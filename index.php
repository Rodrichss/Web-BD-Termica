<?php include('con.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Termicá</title>
</head>
<body>
    <header>
        <div class="contenedor">
            <h1 class=""></h1>
            <img src="img/logo_32px.png">
            <input type="checkbox" id="menu-bar">
            <label class="icon-menu" for="menu-bar"></label>
            <nav class="menu" >
                <a href="index.php">Inicio</a>
                <a href="mision.html">Misión</a>
                <a href="vision.html">Visión</a>
                <a href="vistaProductosjs.html">Productos</a> <!-- productos.php-->
                <?php if(!isset($_SESSION['nombre'])){?>
                    <a href="login.html">Log in</a>
                    <a href="registro.html">Registrarse</a>
                <?php }?>
                <?php 
                if(isset($_SESSION['nombre'])){?>
                    <a href="carritojs.html"><img src="img/cart_32px.png"></a> <!-- vistaCarrito.php-->
                    <a href="logout.php"><img src="img/logout_32px.png"></a>
                <?php }?>
            </nav>
        </div>
    </header>

    <section id="baner">
        <img src="img_baner1.jpg" alt="">
        <div class="contenedor">
            <h2>
            Vasos térmicos Termicá
            </h2>
            <p>Los vasos térmicos que se adaptan a tus necesidades</p>
        </div>
    </section>

    <section class="blanco">
        <h2 class="pt-2" >Bienvenido a Termicá</h2>
        <div class="contenedor">
            <div class="blancoC">
                <div>
                    <p class="pt-5" >Ya sea que estés buscando una taza para tu café matutino o un termo para mantener 
                        tu agua fría durante todo el día, estás en el lugar correcto. 
                        ¡Explora nuestra selección y descubre cómo podemos hacer que tus bebidas sean aún más especiales! 
                    </p>
                </div>
                <div>
                    <div class="frame-slider">
                        <ul>
                            <li><img src="thermalb.webp " alt=""></li>
                            <li><img src="vaso_termico.webp" alt=""></li>
                            <li><img src="vasos_t.png" alt=""></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="negro">
        <h2 class="pt-2" >Misión</h2>
        <div class="contenedor">
            <div class="blancoC">
                <div>
                    <div class="frame-slider">
                        <ul>
                            <li><img src="vasos_t.png" alt=""></li>
                            <li><img src="vasos_t3.webp" alt=""></li>
                            <li><img src="vasos_t2.png" alt=""></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <p class="pt-5" >Nuestra misión en Termicá es proporcionar productos de alta calidad que mantengan las 
                        bebidas calientes o frías durante más tiempo. Nos esforzamos por ofrecer vasos térmicos duraderos, 
                        funcionales y elegantes que satisfagan las necesidades de nuestros clientes. Creemos que cada sorbo cuenta, 
                        y estamos comprometidos a mejorar la experiencia de beber en cualquier lugar y en cualquier momento.
                    </p>

                    <a style="text-align: center;" href="mision.html">Misión</a>
                </div>
            </div>
        </div>
    </section>

    <section class="blanco">

        <h2 class="pt-2" >Visión</h2>
            <div class="contenedor">
                <div class="blancoC">
                    <div>
                        <p class="pt-5" >Visualizamos un mundo donde cada persona pueda disfrutar de su bebida
                             favorita sin preocuparse por la temperatura, gracias a nuestros productos de vanguardia.
                        </p>
                        <a href="servicios.html">Visión</a>
                    </div>
                    <div>
                        <div class="frame-slider">
                            <ul>
                                <li><img src="taza_t.avif" alt=""></li>
                                <li><img src="taza_t2.webp" alt=""></li>
                                <li><img src="taza_t3.jpg" alt=""></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="negro">
        <h2 class="pt-2" >Productos</h2>
        <div class="contenedor">
            <div class="blancoC">
                <div>
                    <div class="frame-slider">
                        <ul>
                            <li><img src="20oz.webp" alt=""></li>
                            <li><img src="20oz-2.webp" alt=""></li>
                            <li><img src="20oz-3.avif" alt=""></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <p class="pt-5" >Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Neque blanditiis maiores sed
                    corrupti sint numquam error commodi tempore iusto.
                    Necessitatibus id at provident,
                    veritatis nisi maxime tempore dolorem blanditiis
                    laboriosam!
                    </p>

                    <a style="text-align: center;" href="productos.php">Productos</a>
                </div>
            </div>
        </div>
    </section>

    <section class="footer">
        <div class="contenedor">
            <div class="footerC">
                <div>
                    <p>Termicá</p>
                </div>
                <div>
                    <p>VASOS</p>
                </div>
                <div>
                    <p>2024</p>
                </div>
            </div>
        </div>
    </section>

</body>
</html>