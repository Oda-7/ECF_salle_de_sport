<?php 

function fetchSalleName($salle_id)
{
    if(isset($salle_id)){
        require 'bd.php';
        $req = $pdo->prepare('SELECT name FROM salles WHERE id = "'.$salle_id.'"');
        $req->execute();
        $salle_name = $req->fetch();
        return $salle_name;
    }
    echo "Aucune salle n'est relié";
}
?>