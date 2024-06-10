<?php
    include 'raccourci/header.php';
    include 'raccourci/navbar.php';
    include 'raccourci/connexion.php'
?>

<div id='CategorieTache'>
    <form id="TaskCatForm" method="POST" action="#" >
        <h2>Rajouter/Supprimer une Categorie</h2>
        <input class="inputCat" type='text' name='nom' placeholder='nom de la Categorie que vous voulez Rajouter/Supprimer'/>
        <?php
            $user_ID=($_SESSION['user']['id']);
            echo "<input class='inputCat' type='hidden' name='id_user' value='".$user_ID."'>"
        ?>
        <input class="inputCat" type='submit' name='addCat' value='Valider'/>
        <input id="inputCatSup" type='submit' name='RemoveCat' value='Supprimer'/>
    </form>
</div>        
<div id='Ajoutdetache'>
    <form id="TaskAddForm" method="POST" action="#" >
        <h2>Rajouter une Tache</h2>
        <input class="inputTask" type="text" name="titre" placeholder="Intitulé"/>
        <input class="inputTask" type="text" name="description" placeholder="Description"/>
        <input class="inputTask" type="date" name="deadline" placeholder="Date limite"/>
        <input class="inputTask" type="time" name="deadlinetime" placeholder="Temps limite"/>
        <?php
            echo "<select id='selecttask' name='categorietask'>";
            $user_id=($_SESSION['user']['id']);
            $sql="SELECT * from categorie WHERE id_user = $user_id";
            foreach ($pdo->query($sql) as $row){
                $result=($row['nom']);
                $categorieId=($row['id']);
                echo "<option class='optionCat' value='".$categorieId."'>".$result."</option>";
            }
            echo "</select>";

            $user_pseudo=($_SESSION['user']['pseudo']);
            echo "<input class='inputTask' type='hidden' name='user_pseudo' value='".$user_pseudo."'>"

        ?>
        <input class="inputTask" type="submit" name="AddTask" value="Valider">
    </form> 
</div>       

<?php
//Gestion Tache

if(isset($_POST["AddTask"])){
    if(empty($_POST["titre"])
        ||empty($_POST["description"])
        ||empty($_POST["deadline"])
        ||empty($_POST["deadlinetime"])
        ||empty($_POST["categorietask"])){
        echo "<p style='color:red'>Tous les champs sont obligatoires!</p>";
    }else{
        try{
            $stmt = $pdo->prepare("INSERT INTO `task`
                                        (`titre`, `description`,`deadline`,`deadlinetime`, `categorietask`, `user_pseudo`)
                                        VALUES (:titre, :description, :deadline, :deadlinetime, :categorietask, :user_pseudo);"); 
            $stmt->execute(array("titre"=> $_POST["titre"],
                                    "description"=>$_POST["description"],
                                    "deadline"=>$_POST["deadline"],
                                    "deadlinetime"=>$_POST["deadlinetime"],
                                    "user_pseudo"=>$_POST["user_pseudo"],
                                    "categorietask"=>$_POST["categorietask"]));
        }
        catch(PDOException $e){
            printf("Erreur lors de l'addition de la tache : %s\n", $e->getMessage());
            exit();
        }finally{
            echo "<p style='color:green'>Bien Rajouter!</p>";
        }
    }
}


//Gestion categorie
if(isset($_POST["addCat"])){
    if(empty($_POST["nom"])){
        echo "<p style='color:red'>Nom obligatoires!</p>";
    }else{
        try{
            $stmt = $pdo->prepare("INSERT INTO `categorie`
                                        (`nom`, `id_user`)
                                        VALUES (:nom, :id_user);"); 
            $stmt->execute(array("nom"=> $_POST["nom"],
                                    "id_user"=>$_POST["id_user"]));
        }
        catch(PDOException $e){
            printf("Erreur lors de l'addition de la Categorie : %s\n", $e->getMessage());
            exit();
        }finally{
            echo "<p style='color:green'>Bien Rajouter!</p>";
        }
    }
}


//Gestion de suppression une categorie
if(isset($_POST["RemoveCat"])){
    if(empty($_POST["nom"])){
        echo "<p style='color:red'>Nom obligatoires (Avec l'exacte orthographe)!</p>";
    }else{
        try{
            $stmt = $pdo->prepare("DELETE FROM `categorie`
                                    WHERE `nom` = :nom AND `id_user` = :id_user;");
            $stmt->execute(array("nom"=> $_POST["nom"],
                                    "id_user"=>$_POST["id_user"]));
        }
        catch(PDOException $e){
            printf("Erreur lors de la suppression de la Categorie : %s\n", $e->getMessage());
            exit();
        }finally{
            echo "<p style='color:green'>Bien Supprimer!</p>";
        }
    }
}

?> 

</body>
</html>