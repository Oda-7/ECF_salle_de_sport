<?php 

function fetchSalleName($salle_id)
{
    if($salle_id){
        $pdo = New PDO('mysql:dbname=oda;host=localhost', 'root', '');
        $req = $pdo->prepare('SELECT name FROM salles WHERE id = "'.$salle_id.'"');
        $req->execute();
        $salle_name = $req->fetch();
        return $salle_name['name'];
    }
}
?>