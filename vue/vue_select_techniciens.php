<div class="container">
    <h3>Liste des techniciens ( <?= (isset($lesTechniciens))? count($lesTechniciens) : '' ?> )</h3>
    
    <form method="post" action="" class="form-technicien">
        <div class="search-group">
            <input type="text" name="filtre" id="filtre" placeholder="Filtrer les résultats" class="form-input">
            <input type="submit" name="Filtrer" value="Filtrer" class="btn btn-primary">
        </div>
    </form>

    <table class="table-custom">
        <thead>
            <tr>
                <th>Id Technicien</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Spécialité</th>
                <th>Email</th>
                <th>Opérations</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(isset($lesTechniciens)){
            foreach ($lesTechniciens as $unTechnicien) {
                echo "<tr>";
                echo "<td>" . $unTechnicien["idtechnicien"] . "</td>";
                echo "<td>" . $unTechnicien["nom"] . "</td>";
                echo "<td>" . $unTechnicien["prenom"] . "</td>";
                echo "<td>" . $unTechnicien["specialite"] . "</td>";
                echo "<td>" . $unTechnicien["email"] . "</td>";
                
                echo "<td class='actions'>";
                echo "<a href='index.php?page=3&action=sup&idtechnicien=".$unTechnicien["idtechnicien"]."' 
                    onclick='return confirm(\"Voulez-vous vraiment supprimer ce technicien ?\")' 
                    class='btn btn-secondary'>Supprimer</a> ";
                echo "<a href='index.php?page=3&action=edit&idtechnicien=".$unTechnicien["idtechnicien"]."' 
                    class='btn btn-primary'>Éditer</a>";
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









