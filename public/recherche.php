<!DOCTYPE html>
<html>

<?php
$headActive = "Recherche";
include_once '../includes/header.php';

$searchResult = NULL;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sport_id = $_POST['sport_id'] ?? NULL;
    $niveau = $_POST['niveau'] ?? NULL;
    $department = $_POST['depart'] ?? NULL;
    $personne_id = $user['personne_id'] ?? NULL;
    $sportName = $mysqli->query("SELECT * FROM sport WHERE sport_id = '$sport_id'")->fetch_assoc()['design'];

    $searchQuery = "SELECT p.prenom, p.nom, s.design, pr.niveau
                        FROM personne p
                        JOIN pratique pr ON p.personne_id = pr.personne_id
                        JOIN sport s ON pr.sport_id = s.sport_id
                        WHERE pr.sport_id = '$sport_id' AND pr.niveau = '$niveau' AND p.depart = '$department' AND p.personne_id != '$personne_id'";

    $searchResult = $mysqli->query($searchQuery);
}
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#searchNav" aria-controls="searchNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="searchNav">
            <h4>Recherche de partenaires</h4>
            <form class="d-flex ms-auto mt-2 mt-lg-0" method="post" action="recherche.php">
                <label for="sport_id" class="form-text me-2">Sport</label>
                <select name="sport_id" class="form-select me-2" required>
                    <?php
                    $query = "SELECT sport_id, design FROM sport";
                    $result = $mysqli->query($query);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $selected = (isset($_POST['sport_id']) && $_POST['sport_id'] == $row['sport_id']) ? 'selected' : '';
                            echo "<option value='" . $row['sport_id'] . "' $selected>" . $row['design'] . "</option>";
                        }
                    } else {
                        echo "Error: " . $mysqli->error;
                    }
                    ?>
                </select>

                <label for="niveau" class="form-text me-2">Niveau</label>
                <select name="niveau" class="form-select me-2" required>
                    <?php
                    $levels = ['débutant', 'confirmé', 'pro', 'supporter'];
                    foreach ($levels as $level) {
                        $selected = (isset($_POST['niveau']) && $_POST['niveau'] == $level) ? 'selected' : '';
                        echo "<option value='$level' $selected>$level</option>";
                    }
                    ?>
                </select>

                <label for="depart" class="form-text me-2">Département</label>
                <select name="depart" class="form-select me-2" required>
                    <?php
                    $departmentQuery = "SELECT DISTINCT depart FROM personne";
                    $departmentResult = $mysqli->query($departmentQuery);
                    if ($departmentResult) {
                        while ($departmentRow = $departmentResult->fetch_assoc()) {
                            $selectedDepartment = (isset($_POST['depart']) && $_POST['depart'] == $departmentRow['depart']) ? 'selected' : '';
                            echo "<option value='" . $departmentRow['depart'] . "' $selectedDepartment>" . $departmentRow['depart'] . "</option>";
                        }
                    } else {
                        echo "Error: " . $mysqli->error;
                    }
                    ?>
                </select>

                <button class="btn btn-primary" type="submit">Recherche</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0">
                <div class="card-header">
                    <h5 class='mt-5 mb-4'>Résultat de la recherche </h5>
                </div>
                <div class="card-body overflow-auto" style="max-height: 400px;">
                    <?php
                    if ($searchResult && $searchResult->num_rows > 0) {
                        echo "<div class='container-fluid'>";
                        echo "<div class='row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4'>";
                        while ($row = $searchResult->fetch_assoc()) {
                            echo "<div class='col'>
                                        <div class='card h-100'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>" . $row['prenom'] . " " . $row['nom'] . "</h5>
                                                <p class='card-text'>" . $row['design'] . " - " . $row['niveau'] . "</p>
                                            </div>
                                        </div>
                                    </div>";
                        }
                        echo "</div>";
                        echo "</div>";
                    } else {
                        echo '<span class="display-6">Pas de résultats</span>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('../includes/footer.php') ?>

</body>

</html>
