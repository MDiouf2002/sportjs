<!DOCTYPE html>
<html>
<?php
$headActive = "Inscription";
include_once '../includes/header.php';

// echo var_dump($user);

?>

<div class="container-fluid">
    <div class="row d-flex flex-row justify-content-center align-items-center text-bg-dark py-4 mb-4">
        <h1 class="text-center "><?php echo userGreating($user); ?></h1>
    </div>
    <div class="card vh-50">
        <div class="card-body bg-light shadow-md">
            <form id="registrationForm" method="post" action="../scripts/ajout.php">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nom" class="form-text">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" value="<?php echo $user['nom'] ?? ''; ?>">
                        <span id="nomError" class="text-danger"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="prenom" class="form-text">Prénom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control" value="<?php echo $user['prenom'] ?? ''; ?>">
                        <span id="prenomError" class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="depart" class="form-text">Department</label>
                        <input type="text" id="depart" name="depart" class="form-control" value="<?php echo $user['depart'] ?? ''; ?>">
                        <span id="departError" class="text-danger"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="mail" class="form-text">Email</label>
                        <input type="email" id="mail" name="mail" class="form-control" value="<?php echo $user['mail'] ?? ''; ?>">
                        <span id="mailError" class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="sport_id" class="form-text">Sport</label>
                        <select id="sport_id" name="sport_id" class="form-select">
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
                    </div>
                    <div class="col-md-6">
                        <label for="niveau" class="form-text">Niveau</label>
                        <select id="niveau" name="niveau" class="form-select">
                            <option value="débutant">Débutant</option>
                            <option value="confirmé">Confirmé</option>
                            <option value="pro">Pro</option>
                            <option value="supporter">Supporter</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="submit" class="btn btn-primary" value="S'inscrire/mettre à jour">
                    </div>
                    <div class="col-md-6">
                        <input type="reset" class="btn btn-secondary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Your code here
        document.getElementById("registrationForm").addEventListener("submit", function(event) {
            // Validate each input field
            if (!validateField("nom", "Nom")) {
                event.preventDefault(); // Prevent form submission if validation fails
            }

            if (!validateField("prenom", "Prénom")) {
                event.preventDefault();
            }

            if (!validateField("depart", "Department")) {
                event.preventDefault();
            }

            if (!validateEmailField("mail", "Email")) {
                event.preventDefault();
            }
        });

        document.getElementById("nom").addEventListener("blur", function() {
            validateField("nom", "Nom");
        });

        document.getElementById("prenom").addEventListener("blur", function() {
            validateField("prenom", "Prénom");
        });

        document.getElementById("depart").addEventListener("blur", function() {
            validateField("depart", "Department");
        });

        document.getElementById("mail").addEventListener("blur", function() {
            validateEmailField("mail", "Email");
        });

        function validateField(fieldName, label) {
            const input = document.getElementById(fieldName);
            const errorSpan = document.getElementById(fieldName + "Error");

            if (input.value.trim() === "") {
                errorSpan.textContent = label + " ne peut pas être vide.";
                return false;
            } else {
                errorSpan.textContent = "";
                return true;
            }
        }

        function validateEmailField(fieldName, label) {
            const input = document.getElementById(fieldName);
            const errorSpan = document.getElementById(fieldName + "Error");

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(input.value.trim())) {
                errorSpan.textContent = "Format d'email invalide.";
                return false;
            } else {
                errorSpan.textContent = "";
                return true;
            }
        }
    });
</script>

<?php include_once('../includes/footer.php') ?>

</body>

</html>