<head>
    <title><?php echo 'SDS - ' . $headActive ?></title>
    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
</head>

<body>
    <?php
    include_once '../includes/function.php';
    if (!databaseExists()) {
        header("Location: ../index.php");
    }

    include '../includes/conn.php';

    $user = getActiveUser($mysqli);
    ?>
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <button type="button" class="btn btn-outline-light me-2 hamburger-button">Menu</button>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 fs-4 font-weight-bold">
                    <li><a href="/" class="link-light link-underline link-underline-opacity-0 link-underline-opacity-75-hover px-2 <?php echo $headActive == "Accueil" ? 'text-secondary' : 'text-white'; ?>">Accueil</a></li>
                    <?php if ($user) : ?>
                        <li><a href="/public/recherche.php" class="link-light link-underline link-underline-opacity-0 link-underline-opacity-75-hover px-2 <?php echo $headActive == "Recherche" ? 'text-secondary' : 'text-white'; ?>">Recherche</a></li>
                        <li><a href="/public/ajout.php" class="link-light link-underline link-underline-opacity-0 link-underline-opacity-75-hover px-2 <?php echo $headActive == "Inscription" ? 'text-secondary' : 'text-white'; ?>">Inscription à un nouveau Sport</a></li>
                    <?php else : ?>
                        <li><a href="/public/ajout.php" class="link-light link-underline link-underline-opacity-0 link-underline-opacity-75-hover px-2 <?php echo $headActive == "Inscription" ? 'text-secondary' : 'text-white'; ?>">Inscription</a></li>
                    <?php endif; ?>
                </ul>



                <form class="col-12 col-lg-4 mb-3 mb-lg-0 ms-4 me-lg-3" method="POST" action="../scripts/login.php" id="loginForm">
                    <div class="row d-flex flex-row">
                        <input type="email" name="mail" class="form-control " placeholder="Email" aria-label="Email">
                    </div>
                </form>

                <div class="d-flex text-end align-items-center">
                    <button type="submit" form="loginForm" class="btn btn-outline-light me-2">Se connecter</button>
                </div>
            </div>
        </div>
    </header>


    <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Get the menu items container
                const menuContainer = document.querySelector(".nav");

                // Hide the menu by default
                menuContainer.style.display = "none";

                // Get the hamburger button
                const hamburgerButton = document.querySelector(".hamburger-button");

                // Add a click event listener to toggle the menu visibility
                hamburgerButton.addEventListener("click", function() {
                    if (menuContainer.style.display === "none" || menuContainer.style.display === "") {
                        menuContainer.style.display = "flex"; // Show the menu
                    } else {
                        menuContainer.style.display = "none"; // Hide the menu
                    }
                });
            });

    </script>

    <?php include_once '../includes/alert.php'; ?>