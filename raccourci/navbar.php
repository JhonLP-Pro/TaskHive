<div id="navbar">
    <div id="titre">
        <img src="image/logo_sans_bg.png" alt="">
        <h1>TaskHive</h1>
    </div>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="nouvTache.php">Gestion de tache</a></li>
        <?php
        if (isset($_SESSION['user'])){
            echo "<li><a href='compte.php'>".$_SESSION['user']['pseudo']."</a></li>";
        }else{
            echo "<li><a href='inscription.php'>Connexion/Inscription</a></li>";
        }
        ?>
    </ul>
</div>