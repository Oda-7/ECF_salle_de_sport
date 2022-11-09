<?php 
var_dump($salle_id);

function fetchSalleName($salle_id)
{
    if(isset($salle_id)){  
        require 'bd.php';
        $req = $pdo->prepare('SELECT name FROM salles WHERE id = "'.$salle_id.'"');
        $req->execute();
        $salle_name = $req->fetch();
        var_dump($salle_name);
        return $salle_name->name;
    }
    return "Aucune salle n'est relié ";
}
?>