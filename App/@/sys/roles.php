<?php 

function roles($roles)
{
    if($roles == 0){
        return 'Membre';
    }
    elseif($roles == 1){
        return 'Réceptionniste';
    }elseif($roles == 2){
        return 'Coach personnel';
    }elseif($roles == 3){
        return 'Manager';
    }elseif($roles == 4){
        return 'Directeur franchisé';
    }elseif($roles == 5){
        return 'Directeur régionale';
    }elseif($roles == 6){
        return 'Pdg';
    }
}