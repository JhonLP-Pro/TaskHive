<?php
    include 'raccourci/header.php';
    include 'raccourci/navbar.php';
    include 'raccourci/connexion.php';
?>
<div id="AcceuilTask">
<?php
if (isset($_SESSION['user'])){
    echo "<h1>Hive</h1>";
    echo "<div id='listTask'>";
    $user_id=($_SESSION['user']['id']);
    $sql="SELECT * from categorie WHERE id_user = $user_id";
    foreach ($pdo->query($sql) as $row){
        $result=($row['nom']);
        $categorieId=($row['id']);
        echo "<div class='taskCategorie'>";
        echo "<h2><a href='listTask.php?id=".$categorieId."'>".$result."</h2>";
        echo "<div>";  
    }
    echo "<div>";

}else{
    echo "<h1>Pas de Hive?</h1>";
    echo "<h1 id='ConnecToi'><a href='inscription.php'>Connecter vous pour<br>commencer!</a></h1>";
}?>
</div>

<script src="raccourci/script.js"></script>

</body>
</html>