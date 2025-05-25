<div class="container">
    <h3>Ajout d'un technicien</h3>
    <form method="post" class="form-technicien">
        <table>
            <tr>
                <td> Nom du technicien : </td>
                <td> <input type="text" name="nom" class="form-input" required value="<?= ($leTechnicien==null)?' ':$leTechnicien['nom']?>"></td>
            </tr>
            <tr>
                <td> Prénom du technicien : </td>
                <td> <input type="text" name="prenom" class="form-input" required value="<?= ($leTechnicien==null)?' ':$leTechnicien['prenom']?>"></td>
            </tr>
            <tr>
                <td> Spécialité : </td>
                <td> 
                <select name="specialite" class="form-select">
                    <option value="" disabled <?= ($leTechnicien==null)?'selected':''?> hidden>Choisir une spécialité</option>
                    <option value="services" <?= ($leTechnicien!=null && $leTechnicien['specialite']=='services')?'selected':''?>>Services</option>
                    <option value="ateliers" <?= ($leTechnicien!=null && $leTechnicien['specialite']=='ateliers')?'selected':''?>>Ateliers</option>
                    <option value="autres" <?= ($leTechnicien!=null && $leTechnicien['specialite']=='autres')?'selected':''?>>Autres</option>
                </select>
                </td>
            </tr>
            <tr>
                <td> Email technicien : </td>
                <td> <input type="email" name="email" class="form-input" required value="<?= ($leTechnicien==null)?' ':$leTechnicien['email']?>"></td>
            </tr>
            <tr  style="display: none;">
                <td> Mot de passe technicien : </td>
                <td> <input type="password" name="mdp" class="form-input" required value="<?= ($leTechnicien==null)?' ':$leTechnicien['mdp']?>"></td>
            </tr>
            <tr>
                <td> <input type="reset" name="Annuler" value="Annuler" class="btn btn-secondary"> </td>
                <td> <input type="submit" class="btn btn-primary"
                <?= ($leTechnicien==null)?'name="Valider" value="Valider"':
                'name="Modifier" value="Modifier"'?>
                ></td>
            </tr>
            <?= ($leTechnicien==null)?'':'<input type="hidden" name="idtechnicien" value="'.$leTechnicien['idtechnicien'].'">'?>
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