<br>
<h3> Liste des clients ( <?= (isset($lesClients))? count($lesClients) : '' ?> )</h3>
 
<form method="post">
    Filtrer par : <input type="text" name="filtre">
    <input type="submit" name="Filtrer" value="Filtrer">
</form>
<br>
 
<table border="1">
    <tr>
        <td> Id Client</td>
        <td> Nom </td>
        <td> Ville </td>
        <td> Code Postal </td>
        <td> Rue </td>
        <td> Numéro Rue </td>
        <td> Email </td>
        <td> Téléphone </td>
 
    <?php
                if (isset($_SESSION['role']) && $_SESSION['role'] == "admin"){
   
        echo"<td> Opérations </td>";
 
                }?>
    </tr>
 
    <?php
    //liste des clients de la BDD
    if(isset($lesClients)){
        foreach ($lesClients as $unClient) {
            echo "<tr>";
            echo "<td>" . $unClient["idclient"] . "</td>";
            echo "<td>" . $unClient["nom"] . "</td>";
            echo "<td>" . $unClient["ville"] . "</td>";
            echo "<td>" . $unClient["codepostal"] . "</td>";
            echo "<td>" . $unClient["rue"] . "</td>";
            echo "<td>" . $unClient["numrue"] . "</td>";
            echo "<td>" . $unClient["email"] . "</td>";
            echo "<td>" . $unClient["tel"] . "</td>";
 
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin"){
 
            echo "<td>" ;
 
            echo "<a href='index.php?page=2&action=sup&idclient=".$unClient["idclient"]."'> <img src='img/supprimer.png' heigth='30' width='30'> </a>";
 
            echo "<a href='index.php?page=2&action=edit&idclient=".$unClient["idclient"]."'> <img src='img/editer.png' heigth='30' width='30'> </a>";
 
            echo "</td>";
            }
 
            echo "</tr>";
        }
   
    }
    ?>
</table>
<br> <br> <br>