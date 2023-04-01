<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/Css/index.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://a.pub.network/core/pubfig/cls.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="Css/bootstrap.min.css" />
</head>

<body>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color:rgb(0, 7, 19);">




        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!" style="color:#380081;text-transform:uppercase;font-size:250%">JPW</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="" style="color:gold">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="">Popular Items</a></li>
                            <li><a class="dropdown-item" href="">New Arrivals</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">


        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">

                <i>
                    <h1 class="has-text-align-center homepagetitle2 has-text-color" style="color:#9800fd;font-size:50px;text-transform:uppercase">GamerX</h1>
                </i>
                <p class="lead fw-normal text-white-50 mb-0" style="color:gold">Game Cartridges</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">

        <?php
        $User = '1';
        $conexao = mysqli_connect("localhost", "root", "", "gamerx") or print(mysqli_connect_error());
        $Games = $conexao->query("SELECT * FROM `registergame` WHERE UsuarioID='$User' ");


        while ($Result = $Games->fetch_assoc()) {


        ?>
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5">
                        <div class="card h-30">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?php echo $Result["Image"]; ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $Result["Titulo"]; ?>
                                    </h5>
                                    <!-- Product system-->
                                    <p>
                                        <span class="console"><i class="fa-brands fa-playstation fa-beat"></i nbsp; nbsp> <?php echo ($Result["Plataforma"]); ?>
                                            <nbsp; i class="fa-brands fa-playstation fa-beat"></i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                </div>
                <div style="text-align: center; z-index:10 ;"> <button class="glow-on-hover" id="add-btn" onclick="ShowForm()"><img src="/working-feitos/add.png" style="width: 50px; height: 50px; background-color:black"></button>
                </div>
            </div>
    </section>


    <!-- Div Section -> Form Add Game-->

    <div id="ADD_CD" class="section" style="display: none; margin-top: -3em;">
        <div class="add_form">
            <form method="post" action="/PHP/add_cd.php" enctype="multipart/form-data">
                <div class="form-group">
                    <span class="form-label">System</span>
                    <select class="form-control" id="system" name="SystemGame">
                        <option>PS1</option>
                        <option>PS2</option>
                        <option>MegaDrive</option>
                    </select>
                    <span class="select-arrow"></span>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span class="form-label">Game</span>
                                <input class="form-control" id="game" name="NameGame" type="text" placeholder="Ex.:Super Mário World">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span class="form-label">Year of the Game</span>
                                <input class="form-control" id="year" type="text" name="YearGame" placeholder="Ex.:80,90,20">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
                <div class="row">
                    <div class="form">
                        <div class="file btn btn-lg btn-primary">
                            <label for="Img" class="form-label" style="margin-bottom:-1em">Game Image</label> <br>
                            <div class="file btn btn-lg btn-primary">
                                <input type="file" name="Img" style="opacity: 1;">
                            </div>
                            <span class="select-arrow"></span>
                        </div>
                    </div>

                    <div class="col-md-3" style="margin-left:35%">
                        <div class="form-btn">
                            <button class="submit-btn">Add Game</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>


    <!-- Footer-->

    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; JPW 2023</p>
        </div>


    </footer>

    <!-- Bootstrap core JS-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme JS-->

    <script src="js/scripts.js"></script>

    <!-- Show Form function-->
    <script src="https://kit.fontawesome.com/3c9095add8.js" crossorigin="anonymous"></script>
    <script>
        function ShowForm() {
            if (document.getElementById("ADD_CD").style.display !== "block") {
                document.getElementById("ADD_CD").style.display = "block";
                document.getElementById("cancel").innerHTML = "Cancel";

            } else {
                document.getElementById("ADD_CD").style.display = "none";
            }
        }
    </script>
</body>

</html>