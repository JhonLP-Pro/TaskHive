<?php
    $optionvalue=$_POST['selectcategorie'];
    if ($optionvalue != 'default'){
        $user_pseudo=($_SESSION['user']['pseudo']);
        $sql="SELECT * from task WHERE user_pseeudo = $user_pseudo";
        foreach ($pdo->query($sql) as $row){
            if ($row['categorietask']==$optionvalue){
                echo "<h1>".$row['titre']."</h1>";
            }
        }
    }else{
        echo "<h2>Ici les task</h2>"
    }
?>