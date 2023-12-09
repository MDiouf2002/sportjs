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
        <div class="card-body bg-white shadow-md">
            <form id="registrationForm" method="post" action="../scripts/ajout.php">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="nom" class="form-text">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control bg-dark text-white" value="<?php echo $user['nom'] ?? ''; ?>">
                        <span id="nomError" class="text-danger"></span>
                    </div>
                    <div class="col-md-12">
                        <label for="prenom" class="form-text">Prénom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control bg-dark text-white" value="<?php echo $user['prenom'] ?? ''; ?>">
                        <span id="prenomError" class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="depart" class="form-text">Department</label>
                        <input type="text" id="depart" name="depart" class="form-control bg-dark text-white" value="<?php echo $user['depart'] ?? ''; ?>">
                        <span id="departError" class="text-danger"></span>
                    </div>
                    <div class="col-md-12">
                        <label for="mail" class="form-text">Email</label>
                        <input type="email" id="mail" name="mail" class="form-control bg-dark text-white" value="<?php echo $user['mail'] ?? ''; ?>">
                        <span id="mailError" class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="sport_id" class="form-text">Sport</label>
                        <select id="sport_id" name="sport_id" class="form-select bg-dark text-white">
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
                        <select id="niveau" name="niveau" class="form-select bg-dark text-white">
                            <option value="débutant">Débutant</option>
                            <option value="confirmé">Confirmé</option>
                            <option value="pro">Pro</option>
                            <option value="supporter">Supporter</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="submit" id="submitButton" class="btn btn-primary" value="S'inscrire/mettre à jour">
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
        const registrationForm = document.getElementById("registrationForm");
        const submitButton = document.getElementById("submitButton");

        registrationForm.addEventListener("submit", function(event) {
            if (!validateNameField("nom", "Nom") ||
                !validateNameField("prenom", "Prénom") ||
                !validateNameField("depart", "Department") ||
                !validateEmailField("mail", "Email")) {
                event.preventDefault();
            }
        });

        // Add blur event listeners for validation
        addValidationListener("nom", "Nom");
        addValidationListener("prenom", "Prénom");
        addValidationListener("depart", "Department");
        addValidationListener("mail", "Email");

        function validateField(fieldName, label) {
            const input = document.getElementById(fieldName);
            const errorSpan = document.getElementById(fieldName + "Error");
            const isValid = input.value.trim() !== "";

            updateErrorSpan(errorSpan, label, isValid);

            return isValid;
        }

        function validateEmailField(fieldName, label) {
            const input = document.getElementById(fieldName);
            const errorSpan = document.getElementById(fieldName + "Error");
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const isValid = emailPattern.test(input.value.trim());

            updateErrorSpan(errorSpan, "Format d'email invalide.", isValid);

            return isValid;
        }

        function validateNameField(fieldName, label) {
            const input = document.getElementById(fieldName);
            const errorSpan = document.getElementById(fieldName + "Error");
            const namePattern = /^[A-Za-z]+$/;
            const isValid = namePattern.test(input.value.trim());

            updateErrorSpan(errorSpan, "Le champ " + label + " ne doit contenir que des lettres.", isValid);

            return isValid;
        }

        function addValidationListener(fieldName, label) {
            const input = document.getElementById(fieldName);
            input.addEventListener("blur", function() {
                validateNameField(fieldName, label);
                updateSubmitButtonState();
            });
        }

        function updateErrorSpan(errorSpan, message, isValid) {
            errorSpan.textContent = isValid ? "" : message;
        }

        function updateSubmitButtonState() {
            submitButton.disabled = !(
                validateNameField("nom", "Nom") &&
                validateNameField("prenom", "Prénom") &&
                validateNameField("depart", "Department") &&
                validateEmailField("mail", "Email")
            );
        }
    });
</script>

<?php include_once('../includes/footer.php') ?>

</body>

</html>