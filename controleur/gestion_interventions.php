<?php
$lIntervention = null;  // Correction de $lesIntervention en $lIntervention
$filtre = "";

if(isset($_POST['Filtrer'])){
    $filtre = $_POST['filtre'];
}

if(isset($_POST['Valider'])){
    $tab = array(
        "idtechnicien"=>$_POST['idtechnicien'],
        "codecom"=>$_POST['codecom'],
        "datehd"=>$_POST['datehd'],
        "datehf"=>$_POST['datehf'],
        "etat"=>$_POST['etat']
    );
    $unControleur->insertIntervention($tab);
}

if(isset($_GET['action']) && isset($_GET['idtechnicien']) && isset($_GET['codecom']) && isset($_GET['datehd'])){
    $action = $_GET['action'];
    $idtechnicien = $_GET['idtechnicien'];
    $codecom = $_GET['codecom'];
    $datehd = $_GET['datehd'];

    if($action == "sup"){
        $unControleur->deleteIntervention($idtechnicien, $codecom, $datehd);
    }
    else if($action == "edit"){
        $lIntervention = $unControleur->selectWhereIntervention($idtechnicien, $codecom, $datehd);
    }
}

if(isset($_POST['Modifier'])){
    $tab = array(
        "idtechnicien"=>$_POST['idtechnicien'],
        "codecom"=>$_POST['codecom'],
        "datehd"=>$_POST['datehd'],
        "datehf"=>$_POST['datehf'],
        "etat"=>$_POST['etat']
    );
    $unControleur->updateIntervention($tab);
}

$lesInterventions = $unControleur->selectAllInterventions($filtre);

require_once("vue/vue_insert_intervention.php");
require_once("vue/vue_select_intervention.php");
?>
<br>
