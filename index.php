<?php
    session_start();
    require_once('db-config.php');
    session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Je Compose.com - Acceuil</title>
        <?php include("includes/head.html"); ?>
        <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>

    <body>
        <div class="container-fluid">

            <?php include("includes/navbar-home.html"); ?>

            <div class="row">
                <h1 class="text-center">Bienvenue  sur la plateforme de composition</h1>
                <section class="col-sm-6 col-sm-offset-3 well">
                    <legend class="text-center">Emplois du temps des compositions</legend>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Matieres</th>
                                    <th>Dates de Compositions</th>
                                    <th>Heure de début</th>
                                    <th>Heure de fin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                try {    // On se connecte à MySQL
                                    $bdd = new PDO($_ENV['DB_SYS'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
                                } catch (Exception $e) {
                                    // En cas d'erreur, on affiche un message et on arrête tout
                                    die('Erreur : '.$e->getMessage());
                                }

                                $reponse = $bdd->query('SELECT * FROM matieres ORDER BY date_compo ASC, heure_debut ASC, heure_fin ASC');
                                $jour = date('d');
                                $mois = date('m');
                                $annee = date('Y');
                                $heure = date('H') + 1;
                                $minute = date('i');


                                $Dateactuelle = $annee.'-'.$mois.'-'.$jour;
                                
                                var_dump($reponse);
                                $Dateactuelle = strtotime($Dateactuelle);

                                $HeureActuelle = $heure.':'.$minute ;
                                $HeureActuelle = strtotime($HeureActuelle);

                                $MatieresAffichees =0;

                                while ($donnees = $reponse->fetch()) {
                                    $heure_fin = strtotime($donnees['heure_fin']);
                                    $heure_debut = strtotime($donnees['heure_debut']);
                                    $date_compo = strtotime($donnees['date_compo']);

                                    if ($Dateactuelle < $date_compo) {
                                        echo '<tr>';
                                        echo '<td>'. $donnees['nom_mat']. '</td>';
                                        echo '<td>'. $donnees['date_compo']. '</td>';
                                        echo '<td>'. $donnees['heure_debut']. '</td>';
                                        echo '<td>'. $donnees['heure_fin']. '</td>';
                                        echo '</tr>';
                                        $MatieresAffichees++;
                                    } elseif ($Dateactuelle == $date_compo && $HeureActuelle < $heure_fin) {
                                        echo '<tr>';
                                        echo '<td>'. $donnees['nom_mat']. '</td>';
                                        echo '<td>'. $donnees['date_compo']. '</td>';
                                        echo '<td>'. $donnees['heure_debut']. '</td>';
                                        echo '<td>'. $donnees['heure_fin']. '</td>';
                                        echo '</tr>';
                                        $MatieresAffichees++;
                                    }
                                }
                                if ($MatieresAffichees == 0) {
                                    echo '<tr>';
                                    echo '<td> -- </td>';
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
                        <div class="col-xs-12">
                            <button class="btn btn-warning btn-block" type="submit">Voir les règles de compositions <span class="glyphicon
                            glyphicon-exclamation-sign"></span></button>
                        </div>
                    </div>

                    <article class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Règles de Compositions
                                <button class="btn btn-warning btn-xs pull-right" type="submit">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li>Tout étudiant, avant de composer doit créer un compte en s'inscrivant ou se connecter à son compte déja créé.</li><br>
                                <li>Avant toute composition il faut s'enregistrer pour la matière dans votre compte sur la page <em>Gérer mes matières</em>.</li><br>
                                <li>Toute matière choisie pour être composée ne peut être supprimmée après l'heure de démarrage de la dite composition.</li><br>
                                <li>Toute soumission de réponses à une composition après l'heure de fin de cette dèrniere est considérée comme nulle et la dite matière manquée.</li><br>
                                <li>Le résultat pour une composition n'est consultable qu'après l'heure de fin de la matière depuis la page <em>Mes matières</em>.</li><br>
                            </ul>
                        </div>
                    </article>
                </section>
            </div>

            <?php include("includes/footer.html"); ?>

        </div>

        <script src="js/index.js"></script>
    </body>
</html>
