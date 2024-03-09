<?php
 //Demarrer une session
session_star();
//Vérifier si le formulaire a été soumis
if($_SERVER["REQUEST_METHOD"]=="POST"){
    //Récupérer les données du formulaire
     $utilisateur=
    $_POST["utilisateur"];
     $motDePasse=
    $_POST["mot_de_passe"];

    //informations de connexion à la base de données
    $serveur="localhost";
    //Adresse du serveur MySQL(généralement localhost)
    $baseDeDonnees="db_resultat election";
    //Nom de la base de données
    //Connexion à la base de données
    $connexion=new
    mysqli($serveur,"root","",$baseDaDonnées);
    //Utilisateur"root" sans mot de passe
    //Vérifier la connexion
    if ($connexion->connect_error)
    {
        die("la connexion à la base de donnée a échoué:"($connexion->connect_error));
    }else{
        //Requete pour verifier si l'utilisateur existe dans la base de données
        $requete="SELECT id_utilisateur FROM utilisateurs WHERE nom_utilisateur='$utilisateur' AND mot_de_passe='$motDePasse'";
        $resultat=$connexion->query($requete);

        //Verifier si l'utilisateur existe dans la base de données et si le mot de passe est corect
        if($resultat->num_rows>0){
            //Récupérer l'id de l'utilisateur
            $row=
            $resultat->fetch_assoc();
            $id_utilisateur=
            $row["id_utilisateur"];
            //Stocker l'id de l'utilisateur dans ne variable de session
            $_SESSION["id_utilisateur"]=$id_utilisateur;
            //rediriger ver la page des menus header("Location:menus.php");
            exit();

            }else{
               //L'utilisateur n'existe pas dans la base de données ou le mot de passe est incorect echo"Nom d'utilisateur ou mot de passe incorrect.";
            }
        }
    }

?>