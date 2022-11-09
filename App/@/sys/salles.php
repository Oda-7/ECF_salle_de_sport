<?php 

function fetchSalleName($salle_id)
{
    if($salle_id){
        require 'bd.php';
        $req = $pdo->prepare('SELECT name FROM salles WHERE id = "'.$salle_id.'"');
        $req->execute();
        $salle_name = $req->fetch();
        return $salle_name;
    }
    return "Aucune salle n'est relié";
}
?>