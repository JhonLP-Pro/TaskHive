<?php
    include 'raccourci/header.php';
    include 'raccourci/navbar.php';

    echo "<div id='detailCompte'>";
    echo "<div id='intituléCompte'><h2>Bienvenue: </h2>";
    echo "<h3>".$_SESSION['user']['pseudo']."</h3>";
    echo "<div id='infoCompte'>";
    echo "<p>Prenom: ".$_SESSION['user']['prenom']."</p>";
    echo "<p>Nom: ".$_SESSION['user']['nom']."</p>";
    echo "</div>";
    echo "<button><a href='logout.php'>Se deconnecter</a></button></div>";
    echo "</div>";
?>

</body>
</html>