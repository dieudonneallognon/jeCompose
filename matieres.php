<?php
    session_start();
    require_once('db-config.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Mes Matieres</title>
    <?php include("includes/head.html"); ?>
    <link rel="stylesheet" type="text/css" href="css/matieres.css">
</head>

<body>
    <div class="container-fluid">

        <?php include("includes/navbar-user.html"); ?>

        <div class="row">
            <section class="col-sm-6 col-sm-offset-3">
                <legend>Ma Programmation</legend>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Matieres</th>
                                <th>Dates de Compositions</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            try {
                                $bdd = new PDO($_ENV['DB_SYS'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
                            } catch (Exception $e) {
                                // En cas d'erreur, on affiche un message et on arrête tout
                                die('Erreur : '.$e->getMessage());
                            }



                            $reponse = $bdd->query('SELECT COUNT(matricule) AS Nbr FROM enregistrer WHERE matricule ='.$_SESSION['matricule']);

                            $donnees = $reponse->fetch();

                            $nbrLigne = $donnees['Nbr'];
                            var_dump($donnees);

                            $reponse->closeCursor();

                            if ($nbrLigne > 0) {
                                $reponse = $bdd->query('SELECT * FROM enregistrer INNER JOIN  matieres ON enregistrer.id_mat = matieres.id_mat WHERE matricule =' .$_SESSION['matricule']. ' ORDER BY matieres.date_compo ASC, heure_debut ASC, heure_fin ASC');

                                $jour = date('d');
                                $mois = date('m');
                                $annee = date('Y');
                                $heure = date('H') + 1;
                                $minute = date('i');

                                $Dateactuelle = $annee.'-'.$mois.'-'.$jour;
                                $Dateactuelle = strtotime($Dateactuelle);

                                $HeureActuelle = $heure.':'.$minute ;
                                $HeureActuelle = strtotime($HeureActuelle);

                                while ($donnees = $reponse->fetch()) {
                                    $heure_fin = strtotime($donnees['heure_fin']);
                                    $heure_debut = strtotime($donnees['heure_debut']);
                                    $date_compo = strtotime($donnees['date_compo']);

                                    if ($donnees['note'] == null) {
                                        if ($Dateactuelle < $date_compo) {
                                            $donnees['note'] = "Examen en attente";

                                            echo '<tr>';
                                            echo '<td>' .$donnees['nom_mat']. '</td>';
                                            echo '<td>' .$donnees['date_compo'].'<br>'. $donnees['heure_debut'].' à '. $donnees['heure_fin'].'</td>';
                                            echo '<td style="color: #999999;">' .$donnees['note']. '</td>';
                                            echo '</tr>';
                                        } elseif ($Dateactuelle == $date_compo && $HeureActuelle < $heure_debut) {
                                            $donnees['note'] = "Examen en attente";

                                            echo '<tr>';
                                            echo '<td>' .$donnees['nom_mat']. '</td>';
                                            echo '<td>' .$donnees['date_compo'].'<br>'. $donnees['heure_debut'].' à '. $donnees['heure_fin'].'</td>';
                                            echo '<td style="color: #999999;">' .$donnees['note']. '</td>';
                                            echo '</tr>';
                                        } elseif ($Dateactuelle == $date_compo && $HeureActuelle < $heure_fin) {
                                            $donnees['note'] = "Composer";

                                            $_SESSION[$donnees['id_mat']] = $donnees['nom_mat'];

                                            echo '<tr>';
                                            echo '<td>' .$donnees['nom_mat']. '</td>';
                                            echo '<td>' .$donnees['date_compo'].'<br>'. $donnees['heure_debut'].' à '. $donnees['heure_fin'].'</td>';
                                            echo '<td><a href="qcm.php?id='.$donnees['id_mat'].'" class="btn btn-warning btn-sm">
                                                <span class="glyphicon glyphicon-pencil"></span>' .$donnees['note']. '</a></td>';
                                            echo '</tr>';
                                        } elseif ($Dateactuelle == $date_compo && $HeureActuelle >= $heure_fin) {
                                            $donnees['note'] = "Manqué!";

                                            echo '<tr>';
                                            echo '<td>' .$donnees['nom_mat']. '</td>';
                                            echo '<td>' .$donnees['date_compo'].'<br>'. $donnees['heure_debut'].' à '. $donnees['heure_fin'].'</td>';
                                            echo '<td style="color: #DC143C;">' .$donnees['note']. '</td>';
                                            echo '</tr>';
                                        } elseif ($Dateactuelle > $date_compo) {
                                            $donnees['note'] = "Manqué!";

                                            echo '<tr>';
                                            echo '<td>' .$donnees['nom_mat']. '</td>';
                                            echo '<td>' .$donnees['date_compo'].'<br>'. $donnees['heure_debut'].' à '. $donnees['heure_fin'].'</td>';
                                            echo '<td style="color: #DC143C;">' .$donnees['note']. '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        if ($Dateactuelle == $date_compo && $HeureActuelle <= $heure_fin) {
                                            $donnees['note'] = "Résultat en attente";

                                            echo '<tr>';
                                            echo '<td>' .$donnees['nom_mat']. '</td>';
                                            echo '<td>' .$donnees['date_compo'].'<br>'. $donnees['heure_debut'].' à '. $donnees['heure_fin'].'</td>';
                                            echo '<td style="color: #008B45;">' .$donnees['note']. '</td>';
                                            echo '</tr>';
                                        } else {
                                            $donnees['note'] = 'Résultat';

                                            $_SESSION[$donnees['id_mat']] = $donnees['nom_mat'];

                                            echo '<tr>';
                                            echo '<td>' .$donnees['nom_mat']. '</td>';
                                            echo '<td>' .$donnees['date_compo'].'<br>'. $donnees['heure_debut'].' à '. $donnees['heure_fin'].'</td>';
                                            echo '<td><a class="btn btn-primary bt-sm" href="resultat.php?id='.$donnees['id_mat'].'">
                                                            <span class="glyphicon glyphicon-list-alt"> </span> '.$donnees['note'].'</a>
                                                        </td>';
                                            echo '</tr>';
                                        }
                                    }
                                }

                                $reponse->closeCursor();
                            } elseif ($donnees['Nbr'] == 0) {
                                echo '<tr>';
                                echo '<td> -- </td>';
                                echo '<td> -- </td>';
                                echo '<td> -- </td>';
                                echo '</tr>';
                            }
                            $reponse->closeCursor();
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-offset-3 col-md-7">
                        <div class="panel panel-warning ajoute">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">Programmation modifiée !</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-offset-3 col-md-7">
                        <div class="panel panel-danger qcm-err">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">Réponses non soumises à temps !</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    if ($nbrLigne == 0) {
                        echo '<div class="row" style="margin-bottom: 30px;">
                                <div class="col-lg-4 col-lg-offset-4 hidden-sm hidden-xs hidden-md">
                                    <a href="gerer_matieres.php" class="btn btn-success">S\'enregistrer pour une matière !</a>
                                </div>
                                <div class="visible-sm">
                                    <a href="gerer_matieres.php" class="btn btn-success btn-block">S\'enregistrer pour une matière !</a>
                                </div>
                                <div class="visible-xs">
                                    <a href="gerer_matieres.php" class="btn btn-success btn-block">S\'enregistrer pour une matière !</a>
                                </div>
                                <div class="visible-md">
                                    <a href="gerer_matieres.php" class="btn btn-success btn-block">S\'enregistrer pour une matière !</a>
                                </div>
                            </div>';
                    }
                ?>

            </section>
        </div>

        <?php include("includes/footer.html"); ?>

    </div>

    <script src="js/matieres.js"></script>

    <?php
        if (isset($_SESSION['mat']) && $_SESSION['mat'] == '1') {
            echo '<script>
                $(function (){
                    $("div.ajoute").show(500).delay(2000).hide(500);
                });
            </script>';

            unset($_SESSION['mat']);
        }

        if (isset($_SESSION['err_qcm']) && $_SESSION['err_qcm'] == '1') {
            echo '<script>
                $(function (){
                    $("div.qcm-err").show(500).delay(2000).hide(500);
                });
            </script>';

            unset($_SESSION['err_qcm']);
        }
    ?>

</body>

</html>