<?php 

function fetchSalleName($salle_id)
{
    if(empty($salle_id)){
        return 'Aucune salle lié ';
        return var_dump($salle_id);
    }else{
        require 'bd.php';
        $req = $pdo->prepare('SELECT name FROM salles WHERE id = "'.$salle_id.'"');
        $req->execute();
        $salle_name = $req->fetch();
        return $salle_name;
    }
}
?>