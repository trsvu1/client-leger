<div class="container">
    <h3> Insertion d'une intervention </h3>
    <form method="post" action="" class="form-technicien">
        <table>
            <tr>
                <td>ID Technicien</td>
                <td><input type="number" name="idtechnicien" class="form-input" required value="<?= ($lIntervention!=null)?$lIntervention['idtechnicien']:'' ?>"></td>
            </tr>
            <tr>
                <td>Code Commande</td>
                <td><input type="number" name="codecom" class="form-input" required value="<?= ($lIntervention!=null)?$lIntervention['codecom']:'' ?>"></td>
            </tr>
            <tr>
                <td>Date Heure Début</td>
                <td><input type="datetime-local" name="datehd" class="form-input" required value="<?= ($lIntervention!=null)?$lIntervention['datehd']:'' ?>"></td>
            </tr>
            <tr>
                <td>Date Heure Fin</td>
                <td><input type="datetime-local" name="datehf" class="form-input" required value="<?= ($lIntervention!=null)?$lIntervention['datehf']:'' ?>"></td>
            </tr>
            <tr>
                <td>État</td>
                <td>
                    <select name="etat" class="form-input form-select">
                        <option value="en attente">En attente</option>
                        <option value="terminee">Terminée</option>
                        <option value="annulee">Annulée</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="reset" name="Annuler" value="Annuler" class="btn btn-secondary"></td>
                <td><input type="submit" class="btn btn-primary"
                    <?= ($lIntervention!=null) ? 'name="Modifier" value="Modifier"' : 'name="Valider" value="Valider"' ?>>
                </td>
            </tr>
        </table>
    </form>
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

    .form-technicien table {
        width: 100%;
        border-spacing: 0 15px;
    }

    .form-technicien td {
        padding: 8px;
        color: #000000;
    }

    .form-input, .form-select {
        width: 100%;
        padding: 8px 12px;
        border: 2px solid #000000;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: #FFD700;
        box-shadow: 0 0 5px rgba(255,215,0,0.3);
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
        font-weight: bold;
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

    .form-input:hover, .form-select:hover {
        border-color: #FFD700;
    }

    .form-input:required {
        border-left: 4px solid #FFD700;
    }
</style>
