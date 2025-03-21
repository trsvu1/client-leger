<br>
<h3>Ajout d'un client</h3>
<form method="post">
	<table>
		<tr>
			<td> Nom du client : </td>
			<td> <input type="text" name="nom" value="<?= ($leClient==null)?' ':$leClient['nom']?>"></td>
		</tr>

		<tr>
			<td> Ville du client : </td>
			<td> <input type="text" name="ville" value="<?= ($leClient==null)?' ':$leClient['ville']?>"></td>
		</tr>

		<tr>
			<td> Codepostal du client : </td>
			<td> <input type="text" name="codepostal" value="<?= ($leClient==null)?' ':$leClient['codepostal']?>"></td>
		</tr>

        <tr>
			<td> Rue client : </td>
			<td> <input type="text" name="rue" value="<?= ($leClient==null)?' ':$leClient['rue']?>"></td>
		</tr>

        <tr>
			<td> Numéro de la rue client : </td>
			<td> <input type="text" name="numrue" value="<?= ($leClient==null)?' ':$leClient['numrue']?>"></td>
		</tr>

		<tr>
			<td> Email client : </td>
			<td> <input type="text" name="email" value="<?= ($leClient==null)?' ':$leClient['email']?>"></td>
		</tr>

        <tr>
			<td> Mot de passe client : </td>
			<td> <input type="password" name="mdp" value="<?= ($leClient==null)?' ':$leClient['mdp']?>"></td>
		</tr>

		<tr>
			<td> Telephone client : </td>
			<td> <input type="text" name="tel" value="<?= ($leClient==null)?' ':$leClient['tel']?>"></td>
		</tr>
		
		<tr>
            <td> <input type="reset" name="Annuler" value="Annuler"> </td>
            <td> <input type="submit"
           
            <?= ($leClient==null)?'name="Valider" value="Valider"':
            'name="Modifier" value="Modifier"'?>
            ></td>
        </tr>

		<?= ($leClient==null)?'':'<input type="hidden" name="idclient" value="'.$leClient['idclient'].'">'?>

	</table>
</form>