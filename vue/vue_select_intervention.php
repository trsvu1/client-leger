<div class="container">
    <h3> Liste des interventions </h3>
    <form method="post" action="" class="form-technicien">
        <div class="search-group">
            <input type="text" name="filtre" placeholder="Filtrer les résultats" class="form-input" value="<?= ($filtre != "") ? $filtre : '' ?>">
            <input type="submit" name="Filtrer" value="Filtrer" class="btn btn-primary">
        </div>
    </form>

    <table class="table-custom">
        <thead>
            <tr>
                <th>ID Technicien</th>
                <th>Code Commande</th>
                <th>Date Heure Début</th>
                <th>Date Heure Fin</th>
                <th>État</th>
                <th>Opérations</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(isset($lesInterventions)){
            foreach($lesInterventions as $uneIntervention){
                echo "<tr>";
                echo "<td>".$uneIntervention['idtechnicien']."</td>";
                echo "<td>".$uneIntervention['codecom']."</td>";
                echo "<td>".$uneIntervention['datehd']."</td>";
                echo "<td>".$uneIntervention['datehf']."</td>";
                echo "<td>".$uneIntervention['etat']."</td>";
                echo "<td class='actions'>";
                echo "<a href='index.php?page=3&action=sup&idtechnicien=".$uneIntervention['idtechnicien']."&codecom=".$uneIntervention['codecom']."&datehd=".$uneIntervention['datehd']."' class='btn btn-secondary'>Supprimer</a> ";
                echo "<a href='index.php?page=3&action=edit&idtechnicien=".$uneIntervention['idtechnicien']."&codecom=".$uneIntervention['codecom']."&datehd=".$uneIntervention['datehd']."' class='btn btn-primary'>Éditer</a>";
                echo "</td>";
                echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>

<style>
    .container {
        width: 100%;
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    h3 {
        color: #000000;
        text-align: center;
        margin-bottom: 30px;
        font-size: 24px;
        text-transform: uppercase;
    }

    .search-group {
        margin-bottom: 20px;
        display: flex;
        gap: 10px;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table-custom th {
        background-color: #000000;
        color: #FFD700;
        padding: 12px;
        text-align: left;
    }

    .table-custom td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
    }

    .table-custom tr:hover {
        background-color: #f5f5f5;
    }

    .actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
        font-weight: bold;
        text-decoration: none;
    }

    .btn-primary {
        background-color: #FFD700;
        color: #000000;
        border: 2px solid #000000;
    }

    .btn-secondary {
        background-color: #000000;
        color: #FFD700;
    }

    .btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .form-input {
        width: 100%;
        padding: 8px 12px;
        border: 2px solid #000000;
        border-radius: 4px;
        font-size: 14px;
    }
</style>
