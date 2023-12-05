<!DOCTYPE html>
<html>

<?php
$headActive = "Accueil";
require '../includes/header.php';

if($user){
    $queryPratique = "SELECT s.design
              FROM sport s
              INNER JOIN pratique p ON s.sport_id = p.sport_id
              WHERE p.personne_id = ".$user['personne_id'];
    
    $result = $mysqli->query($queryPratique);
    
    $practicedSports = [];
    while ($row = $result->fetch_assoc()) {
        $practicedSports[] = $row['design'];
    }
}
else{
    $practicedSports = '';
}

?>

<div class="container-fluid mt-0">
    <div class="row text-bg-dark py-4 mb-4">
        <h1 class="text-center ">
            <?php echo userGreating($user); ?>
            <?php if($user):?>
                <form action="/scripts/logout.php"><button class="btn btn-danger" type="submit">Se deconnecter</button></form>
            <?php endif ?>
        </h1>
        <?php if (!empty($practicedSports)) : ?>
            <div class="text-light fs-4 d-flex justify-content-center">Pratiques: <?php echo implode('/', $practicedSports); ?></div>
        <?php endif; ?>

    </div>

    <div class="row justify-content-center text-center">
        <h1 class="display-4 mb-5 text-uppercase">Liste des sports</h1>
        <div class="card-group d-flex flex-wrap justify-content-center">
            <?php
            $query = "SELECT design FROM sport";
            $resultSports = $mysqli->query($query);
            if ($resultSports) {
                $count = 0;
                while ($row = $resultSports->fetch_assoc()) {
                    $colorClass = $count % 2 == 0 ? 'bg-light text-dark' : 'bg-dark text-light';
                    echo '<div class="card mb-3 ' . $colorClass . '" style="max-width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">' . $row['design'] . '</h5>
                                </div>
                              </div>';
                    $count++;
                }
            } else {
                echo "Erreur: " . $mysqli->error;
            }
            ?>
        </div>
    </div>


    <div id="carrousel">
        <h1>SPORTS <SPAN>IMAGE</SPAN></h1>
        <div id="wrapper">
            <div><button class="active" id="prev" onclick="prev()"><i class="fa-solid fa-arrow-left"></i></button></div>
            <div id="image-container">
                <div id="image-carousel">
                    <img src="images/sports/1.jpg" alt="">
                    <img src="images/sports/2.jpg" alt="">
                    <img src="images/sports/3.jpg" alt="">
                    <img src="images/sports/4.jpg" alt="">
                    <img src="images/sports/5.jpg" alt="">
                    <img src="images/sports/6.jpg" alt="">
                </div>
            </div>
            <div><button class="active" id="next" onclick="next()"><i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
</div>

<?php require('../includes/footer.php') ?>

</body>

</html>