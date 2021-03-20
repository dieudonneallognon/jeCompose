<?php
    session_start();
    require_once('db-config.php');
    $_SESSION['id_mat'] = $_GET['id'];
    $_SESSION['nm_mat'] = $_SESSION[$_GET['id']];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Résultats</title>
        <?php include("includes/head.html"); ?>
        <link rel="stylesheet" type="text/css" href="css/resultat.css">
    </head>

    <body>
        <div class="container-fluid">

            <?php include("includes/navbar-user.html"); ?>

            <div class="row">
                <section class="col-sm-6 col-sm-offset-3">
                    <h1>Résultats</h1><br>

                    <?php
                    /*if (isset($_SESSION['id_mat'])) {
                        if ($_SESSION['id_mat'] == 'edu001') {
                            include("includes/includes_matieres/programmation_web.html");
                        } elseif ($_SESSION['id_mat'] == 'edu002') {
                            include("includes/includes_matieres/administration_linux.html");
                        } elseif ($_SESSION['id_mat'] == 'edu004') {
                            include("includes/includes_matieres/architecture_ordinateurs.html");
                        } else {
                            echo '<h3>Matière indisponible !</h3>';
                        }
                    }*/
                    include("includes/includes_matieres/programmation_web.html");

                    try {    // On se connecte à MySQL
                        $bdd = new PDO($_ENV['DB_SYS'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
                    } catch (Exception $e) {
                        // En cas d'erreur, on affiche un message et on arrête tout
                        die('Erreur : '.$e->getMessage());
                    }

                    

                    $rep = $bdd->prepare('SELECT vraie_rep FROM corriger WHERE id_mat=? ORDER BY id_question');
                    $rep->execute(array($_SESSION['id_mat'])) or die(print_r($bdd->errorInfo()));

                    $vRep;

                    for ($i=1; $donnees=$rep->fetch(); $i++) {
                        $vRep[$i] = $donnees['vraie_rep'];
                    }

                    $rep->closeCursor();

                    $rep = $bdd->prepare('SELECT rep_etu FROM repondre WHERE id_mat=? AND matricule=? ORDER BY id_question');
                    $rep->execute(array($_SESSION['id_mat'], $_SESSION['matricule']));

                    $eRep;

                    for ($i = 1; $donnees = $rep->fetch(); $i++) {
                        $eRep[$i] = $donnees['rep_etu'];
                    }

                    $rep->closeCursor();

                    ?>

                    <div class="row resultat">
                        <div class="col-sm-12 text-center">
                            <legend>Note</legend>
                            <h1 class="note"></h1>
                            <h1 class="mention"></h1>
                        </div>
                    </div>


                    <div class="row">
                        <!-- <div class="col-lg-5 col-lg-offset-1">
                            <a class="btn btn-warning btn-block" <?php echo"href=fichiers_composition/".$_SESSION['matricule']."-".$_SESSION['id_mat'].".txt" ?>>Télécharger mon devoir <span class="glyphicon glyphicon-download"></span></a>
                        </div> -->


                        <!-- <div class="col-lg-5 col-lg-offset-1">
                            <a class="btn btn-primary btn-block" <?php echo"href=énoncés_composition/".$_SESSION['id_mat'].".pdf" ?>>
                                Télécharger l'enoncé <span class="glyphicon glyphicon-download"></span></a>
                        </div> -->

                        <div class="col-lg-6 col-lg-offset-3">
                            <a class="btn btn-primary btn-block" <?php echo"href=énoncés_composition/edu001.pdf" ?>>
                                Télécharger l'enoncé <span class="glyphicon glyphicon-download"></span></a>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4">
                            <a class="btn btn-success btn-block" href="matieres.php">OK <span class="glyphicon glyphicon-ok-sign"></span> </a>
                        </div>
                    </div>

                </section>
            </div>

            <?php include("includes/footer.html"); ?>


        </div>
        <script src="js/resultat.js"></script>

        <?php
        function numReponse($x)
        {
            switch ($x) {
                case 'a':
                    return 1;
                    break;

                case 'b':
                    return 2;
                    break;

                case 'c':
                    return 3;
                    break;
            }
        }

        echo "<script>
                $(function() {
                    ";

        for ($i=1; $i <= 10; $i++) {
            $posArticle = $i+2;

            if (isset($eRep[$i]) && $eRep[$i] == $vRep[$i]) {
                echo "$('article:nth-child(".$posArticle.")').addClass('panel-success');";
                echo "$('article:nth-child(".$posArticle.") li:nth-child(".numReponse($vRep[$i]).")').addClass('vrai');";
            } elseif (isset($eRep[$i]) && $eRep[$i] != $vRep[$i]) {
                echo "$('article:nth-child(".$posArticle.")').addClass('panel-danger');";
                echo "$('article:nth-child(".$posArticle.") li:nth-child(".numReponse($vRep[$i]).")').addClass('vrai');";
                echo "$('article:nth-child(".$posArticle.") li:nth-child(".numReponse($eRep[$i]).")').addClass('faux');";
            } elseif (!isset($eRep[$i])) {
                echo "$('article:nth-child(".$posArticle.")').addClass('panel-danger');";
                echo "$('article:nth-child(".$posArticle.") li:nth-child(".numReponse($vRep[$i]).")').addClass('vrai');";
            }
        }

        echo     "});
            </script>";

        if (isset($_SESSION['id_mat']) && isset($_SESSION['nm_mat'])) {
            echo '<script>
                    $(function (){
                        $("h1").html("'.$_SESSION['nm_mat'].'");
                        $("title").html("QCM '.$_SESSION['nm_mat'].'");
                    });
                </script>';
        }

        $rep = $bdd->prepare('SELECT note FROM enregistrer WHERE id_mat=? AND matricule=?');
        $rep->execute(array($_SESSION['id_mat'], $_SESSION['matricule']));

        if ($donnees = $rep->fetch()) {
            echo '<script>
                    $(function (){
                        $("div.resultat h1.note").html("'.$donnees['note'].'/20");
                        ';
            if ($donnees['note'] >= 18 && $donnees['note'] <= 20) {
                echo '$("div.resultat h1.mention").html("Mention: Excellente");
                    $("div.resultat h1.mention").css("color", "#08B000");
                    });
                </script>';
            } elseif ($donnees['note'] >= 16 && $donnees['note'] <= 17) {
                echo '$("div.resultat h1.mention").html("Mention: Très Bien");
                    $("div.resultat h1.mention").css("color", "#8B8B00");
                    });
                </script>';
            } elseif ($donnees['note'] >= 14 && $donnees['note'] <= 15) {
                echo '$("div.resultat h1.mention").html("Mention: Bien");
                    $("div.resultat h1.mention").css("color", "#EEDD82");
                    });
                </script>';
            } elseif ($donnees['note'] >= 12 && $donnees['note'] <= 13) {
                echo '$("div.resultat h1.mention").html("Mention: Assez Bien");
                    $("div.resultat h1.mention").css("color", "#CD8500");
                    });
                </script>';
            } elseif ($donnees['note'] >= 10 && $donnees['note'] <= 11) {
                echo '$("div.resultat h1.mention").html("Mention Passable");
                    $("div.resultat h1.mention").css("color", "#CD7054");
                    });
                </script>';
            } elseif ($donnees['note'] >= 8 && $donnees['note'] <= 9) {
                echo '$("div.resultat h1.mention").html("Mention: Insufisant");
                    $("div.resultat h1.mention").css("color", "#CD4F39");
                    });
                </script>';
            } elseif ($donnees['note'] >= 0 && $donnees['note'] <= 7) {
                echo '$("div.resultat h1.mention").html("Mention: Très Insufisant");
                    $("div.resultat h1.mention").css("color", "#CD0000");
                    });
                </script>';
            }
        }

        $rep->closeCursor();
        ?>
    </body>
</html>

<?php
unset($_SESSION['nm_mat']);
?>
