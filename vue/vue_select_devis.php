<div class="container">
    <h3>Liste des devis</h3>
    <form method="post" action="" class="form-technicien">
        <div class="search-group">
            <input type="text" name="filtre" id="filtre" placeholder="Filtrer les résultats" class="form-input">
            <input type="submit" name="Filtrer" value="Filtrer" class="btn btn-primary">
        </div>
    </form>

    <table class="table-custom">
        <thead>
            <tr>
                <th>ID Devis</th>
                <th>Date</th>
                <th>État</th>
                <th>Client</th>
                <th>Opérations</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(isset($lesDevis)){
            foreach($lesDevis as $unDevis){
                echo "<tr>";
                echo "<td>".$unDevis['iddevis']."</td>";
                echo "<td>".$unDevis['datedevis']."</td>";
                echo "<td>".$unDevis['etatdevis']."</td>";
                echo "<td>".$unDevis['nom_client']."</td>";
                echo "<td class='actions'>";
                echo "<a href='index.php?page=7&action=sup&iddevis=".$unDevis['iddevis']."' class='btn btn-secondary'>Supprimer</a> ";
                echo "<a href='index.php?page=7&action=edit&iddevis=".$unDevis['iddevis']."' class='btn btn-primary'>Éditer</a>";
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

    .form-technicien {
        margin-bottom: 20px;
    }

    .search-group {
        display: flex;
        gap: 10px;
    }

    .form-input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
        color: #ffffff;
    }

    .btn-secondary {
        background-color: #000000;
        color: #FFD700;
    }

    .btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }

    .table-custom th, .table-custom td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .table-custom th {
        background-color: #f4f4f4;
    }

    .actions {
        display: flex;
        gap: 10px;
    }
</style>
