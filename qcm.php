<?php
    session_start();
    require_once('db-config.php');
    $_SESSION['id_mat'] = $_GET['id'];
    $_SESSION['nm_mat'] = $_SESSION[$_GET['id']];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>QCM "Matière"</title>
        <?php include("includes/head.html"); ?>
        <link rel="stylesheet" type="text/css" href="css/qcm.css">
    </head>

    <body>
        <div class="container-fluid">

            <?php include("includes/navbar-user.html"); ?>

            <div class="row">
                <section class="col-sm-6 col-sm-offset-3">
                    <h1></h1><br>
                    <form method="post" action="traitements/traitement_qcm.php">

                        <?php
                            /*if (isset($_SESSION['id_mat'])) {
                                if ($_SESSION['id_mat'] == 'edu001') {
                                    include("includes/includes_matieres/programmation_web.html");
                                    echo '<div class="row">
                                            <div class="col-sm-4 col-sm-offset-4 hidden-xs">
                                                <input type="submit" class="btn btn-success" value="Soummetre les réponses">
                                            </div>
                                            <div class="col-sm-4 col-sm-offset-4 visible-xs">
                                                <input type="submit" class="btn btn-success btn-block" value="Soummetre les réponses">
                                            </div>
                                        </div>';
                                }
                                else if ($_SESSION['id_mat'] == 'edu002') {
                                    include("includes/includes_matieres/administration_linux.html");
                                    echo '<div class="row">
                                            <div class="col-sm-4 col-sm-offset-4 hidden-xs">
                                                <input type="submit" class="btn btn-success" value="Soummetre les réponses">
                                            </div>
                                            <div class="col-sm-4 col-sm-offset-4 visible-xs">
                                                <input type="submit" class="btn btn-success btn-block" value="Soummetre les réponses">
                                            </div>
                                        </div>';
                                }
                                else if ($_SESSION['id_mat'] == 'edu004') {
                                    include("includes/includes_matieres/architecture_ordinateurs.html");
                                    echo '<div class="row">
                                            <div class="col-sm-4 col-sm-offset-4 hidden-xs">
                                                <input type="submit" class="btn btn-success" value="Soummetre les réponses">
                                            </div>
                                            <div class="col-sm-4 col-sm-offset-4 visible-xs">
                                                <input type="submit" class="btn btn-success btn-block" value="Soummetre les réponses">
                                            </div>
                                        </div>';
                                }
                                else echo '<h3>Matière indisponible !</h3>';
                            }*/
                            include("includes/includes_matieres/programmation_web.html");
                                    echo '<div class="row">
                                            <div class="col-sm-4 col-sm-offset-4 hidden-xs">
                                                <input type="submit" class="btn btn-success" value="Soummetre les réponses">
                                            </div>
                                            <div class="col-sm-4 col-sm-offset-4 visible-xs">
                                                <input type="submit" class="btn btn-success btn-block" value="Soummetre les réponses">
                                            </div>
                                        </div>';
                        ?>
                    </form>
                </section>
            </div>

            <?php include("includes/footer.html"); ?>

        </div>

        <script src="js/qcm.js"></script>
    <?php
    if (isset($_SESSION['id_mat']) && isset($_SESSION['nm_mat'])) {
        echo '<script>
                $(function (){
                    $("h1").html("'.$_SESSION['nm_mat'].'");
                    $("title").html("QCM '.$_SESSION['nm_mat'].'");
                });
                </script>';
    }
    ?>
    </body>
</html>
