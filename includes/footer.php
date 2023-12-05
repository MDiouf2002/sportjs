<div style="height: 30vw;"></div>
<footer class="footer text-bg-dark fixed-bottom mt-auto py-3 bg-body-dark">
    <?php if($headActive == 'Inscription'):?>
    <div class="container">
        <div class="row d-flex flex-row justify-content-around align-items-center">
            <form method="POST" action="../scripts/add_sport.php" class="col-9">
                <div class="form-group mb-4">
                    <label class="col-6 form-text mb-2 text-white">Vous ne trouver pas votre sport ? Ajouter ici 👇</label>
                    <input class="col-3 form-control form-control-dark text-bg-dark" type="text" name="design" id=""></input>
                </div>
                <input class="col-3 form-control btn-outline-light" type="submit" value="Ajouter un sport">
            </form>
        </div>
    </div>
    <?php endif ?>
    <div class="row my-5 text-center flex-">
        <a class="nav-link" href="#">@OCGRAFX</a>
        <span>Droit réservers au tuteur Mr KANE👌 & Mr NDIAYE😁</span>
    </div>
</footer>
</body>


<script src="../public/js/script.js"></script>
<script src="../public/js/bootstrap.js"></script>
<script src="../public/js/bootstrap.bundle.js"></script>