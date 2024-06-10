<?php
    include 'raccourci/header.php';
    include 'raccourci/navbar.php';
    include 'raccourci/connexion.php';
?>


<div id="Tasklist">
<?php
$user_pseudo=($_SESSION['user']['pseudo']);
$Cat_id=intval($_GET['id']);
$sql="SELECT * from task WHERE user_pseudo = '$user_pseudo' AND categorietask = $Cat_id";
    foreach ($pdo->query($sql) as $row){
        echo "<div class='taskdetail'>";
        echo "<h2>".$row['titre']."</h2>";
        echo "<p>".$row['description']."</p>";
        echo "<p>".$row['deadline']." ".$row['deadlinetime']."</p>";
        echo "<form method='POST' action='#'>";
        echo "<input type='hidden' name='id' value='".$row['id']."'>";
        echo "<button type='submit' name='RemoveTask' >Supprimer</button>";
        echo "</form>";
        echo "</div>";

        if(isset($_POST["RemoveTask"])){
            try{
                $stmt = $pdo->prepare("DELETE FROM `task`
                                        WHERE `id` = :id");
                $stmt->execute(array("id"=> $_POST["id"]));
            }
            catch(PDOException $e){
                printf("Erreur lors de la suppression de la tache : %s\n", $e->getMessage());
                exit();
            }
        }
    }
?>
</div>

</body>
</html>