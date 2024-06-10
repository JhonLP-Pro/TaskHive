<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inscription.css">
    <title>Taskhive</title>
</head>
<body>

<?php
    include 'raccourci/connexion.php';
?>

<div id='connec'>
    <form id="connecForm" method="POST" action="#" >
        <h2>Se connecter</h2>
        <input type='text' name='emailPseudo' placeholder='Email ou Pseudo'/>
        <input type='password' name='password' placeholder='Mot de passe'/>
        <input type='submit' name='connexion' value='Valider'/> 
    </form>
</div>        
<div id='incr'>
    <form id="inscForm" method="POST" action="#" >
        <h2>S'inscrire</h2>
        <input type="text" name="lastname" placeholder="Nom"/>
        <input type="text" name="firstname" placeholder="Prénom"/>
        <input type="text" name="pseudo" placeholder="Pseudo unique"/>
        <input type="text" name="email" placeholder="Email"/>
        <input type="password" name="password" placeholder="Mot de passe"/>
        <input type="submit" name="inscription" value="Valider">
    </form> 
</div>       
<?php
//Inscription
if(isset($_POST["inscription"])){
    if(empty($_POST["firstname"])
        ||empty($_POST["lastname"])
        ||empty($_POST["pseudo"])
        ||empty($_POST["email"])
        ||empty($_POST["password"])){
        echo "<p style='color:red'>Tous les champs sont obligatoires!</p>";
    }else{
        try{
            $stmt = $pdo->prepare("INSERT INTO `user`
                                        (`prenom`, `nom`,`pseudo`,`email`, `password`)
                                        VALUES (:firstname, :lastname, :pseudo, :email, :password);"); 
            $stmt->execute(array("firstname"=> $_POST["firstname"],
                                    "lastname"=>$_POST["lastname"],
                                    "pseudo"=>$_POST["pseudo"],
                                    "email"=>$_POST["email"],
                                    "password"=>password_hash($_POST["password"], PASSWORD_DEFAULT))); 
        }
        catch(PDOException $e){
            printf("Erreur lors de l'inscription : %s\n", $e->getMessage());
            exit();
        }finally{
            echo "<p style='color:green'>Inscription réussite!</p>";
        }
    }
}

//Gestion connexion 
    if(isset($_POST["connexion"])){
    if(empty($_POST["emailPseudo"]) || empty($_POST["password"])){
        echo "<p style='color:red'>Tous les champs sont obligatoires!</p>";
    }else{
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email=:email OR pseudo=:pseudo"); //Chercher par rapport à l'email
        $stmt->execute(array(":email" => $_POST['emailPseudo'], ":pseudo" => $_POST['emailPseudo']));
        $row = $stmt->fetch();
        if(password_verify($_POST['password'], $row["password"])){
            $_SESSION["user"]= $row; //Sauvegarde l'utilsateur dans la session 'user'
            header("Location: index.php"); //Ouvre la page d'accueil
        }else{
            echo "<p style='color:red'>Identifiants incorrect!</p>";
        }
    }
}

?> 
</body>
</html>