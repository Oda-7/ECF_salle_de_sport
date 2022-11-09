<?php 

function fetchSalleName($salle_id)
{
    if(isset($salle_id)){
        require '/App/@/sys/bd.php';
        var_dump($salle_id);
        $req = $pdo->prepare('SELECT name FROM salles WHERE id = "'.$salle_id.'"');
        $req->execute();
        $salle_name = $req->fetch();
        return $salle_name;
    }
    return "Aucune salle n'est relié ";
}
?>