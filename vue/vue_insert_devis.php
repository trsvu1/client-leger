<div class="container">
    <h3><?= isset($unDevis) && $unDevis ? "Modification d'un devis" : "Ajout d'un nouveau devis" ?></h3>
    <form method="post" action="" class="form-technicien">
        <table>
            <tr>
                <td>Date du devis :</td>
                <td><input type="date" name="datedevis" class="form-input" required value="<?= isset($unDevis) && $unDevis ? $unDevis['datedevis'] : date('Y-m-d') ?>"></td>
            </tr>
            <tr>
                <td>État du devis :</td>
                <td>
                    <select name="etatdevis" class="form-input" required>
                        <option value="" disabled <?= !isset($unDevis) || !$unDevis ? 'selected' : '' ?> hidden>Choisir un état</option>
                        <option value="acceptee" <?= isset($unDevis) && $unDevis && $unDevis['etatdevis'] == 'acceptee' ? 'selected' : '' ?>>Acceptée</option>
                        <option value="annulee" <?= isset($unDevis) && $unDevis && $unDevis['etatdevis'] == 'annulee' ? 'selected' : '' ?>>Annulée</option>
                        <option value="en_attente" <?= isset($unDevis) && $unDevis && $unDevis['etatdevis'] == 'en_attente' ? 'selected' : '' ?>>En attente</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Client :</td>
                <td>
                    <select name="idclient" class="form-input" required>
                        <option value="" disabled <?= !isset($unDevis) || !$unDevis ? 'selected' : '' ?> hidden>Choisir un client</option>
                        <?php
                        $lesClients = $unControleur->selectAllClients("");
                        foreach($lesClients as $unClient){
                            $selected = (isset($unDevis) && $unDevis && $unDevis['idclient'] == $unClient['idclient']) ? 'selected' : '';
                            echo "<option value='".$unClient['idclient']."' ".$selected.">".$unClient['nom']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="reset" name="Annuler" value="Annuler" class="btn btn-secondary"></td>
                <td>
                    <?php if(isset($unDevis) && $unDevis) { ?>
                        <input type="submit" name="Modifier" value="Modifier" class="btn btn-primary">
                        <input type="hidden" name="iddevis" value="<?= $unDevis['iddevis'] ?>">
                    <?php } else { ?>
                        <input type="submit" name="Enregistrer" value="Enregistrer" class="btn btn-primary">
                    <?php } ?>
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
