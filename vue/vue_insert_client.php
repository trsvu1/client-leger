<div class="container">
    <h3>Ajout d'un client</h3>
    <form method="post" class="form-technicien">
        <table>
            <tr>
                <td>Nom du client : </td>
                <td><input type="text" name="nom" class="form-input" required value="<?= ($leClient==null)?' ':$leClient['nom']?>"></td>
            </tr>

            <tr>
                <td>Ville du client : </td>
                <td><input type="text" name="ville" class="form-input" required value="<?= ($leClient==null)?' ':$leClient['ville']?>"></td>
            </tr>

            <tr>
                <td>Code postal du client : </td>
                <td><input type="text" name="codepostal" class="form-input" required value="<?= ($leClient==null)?' ':$leClient['codepostal']?>"></td>
            </tr>

            <tr>
                <td>Rue client : </td>
                <td><input type="text" name="rue" class="form-input" required value="<?= ($leClient==null)?' ':$leClient['rue']?>"></td>
            </tr>

            <tr>
                <td>Numéro de la rue : </td>
                <td><input type="text" name="numrue" class="form-input" required value="<?= ($leClient==null)?' ':$leClient['numrue']?>"></td>
            </tr>

            <tr>
                <td>Email client : </td>
                <td><input type="email" name="email" class="form-input" required value="<?= ($leClient==null)?' ':$leClient['email']?>"></td>
            </tr>

            <tr  style="display: none;">
                
                <td>Mot de passe : </td>
                <td> <input type="password" name="mdp" class="form-input"></td>
            </tr>

            <tr>    
                <td>Téléphone : </td>
                <td><input type="text" name="tel" class="form-input" required value="<?= ($leClient==null)?' ':$leClient['tel']?>"></td>
            </tr>

            <tr>
                <td><input type="reset" name="Annuler" value="Annuler" class="btn btn-secondary"></td>
                <td><input type="submit" class="btn btn-primary"
                    <?= ($leClient==null)?'name="Valider" value="Valider"':
                    'name="Modifier" value="Modifier"'?>></td>
            </tr>

            <?= ($leClient==null)?'':'<input type="hidden" name="idclient" value="'.$leClient['idclient'].'">'?>
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

    .form-input {
        width: 100%;
        padding: 8px 12px;
        border: 2px solid #000000;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-input:focus {
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

    .form-input:hover {
        border-color: #FFD700;
    }

    .form-input:required {
        border-left: 4px solid #FFD700;
    }
</style>