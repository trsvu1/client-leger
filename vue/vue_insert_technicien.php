<br>
<h3>Ajout d'un technicien</h3>
<form method="post">
	<table>
		<tr>
			<td> Nom du technicien : </td>
			<td> <input type="text" name="nom"></td>
		</tr>
		<tr>
			<td> Prénom du technicien : </td>
			<td> <input type="text" name="prenom"></td>
		</tr>
		<tr>
			<td> Spécialité : </td>
			<td> 
			<select name ="specialite">
				<option value="telephonie">Téléphonie</option>
				<option value="box">Box Internet</option>
				<option value="autre">Autre</option>
			</select>
			</td>
		</tr>

		<tr>
			<td> Email technicien : </td>
			<td> <input type="text" name="email"></td>
		</tr>

		<tr>
			<td> Mot de passe technicien : </td>
			<td> <input type="password" name="mdp"></td>
		</tr>

		<tr>
            <td> <input type="reset" name="Annuler" value="Annuler"> </td>
            <td> <input type="submit"
           
            <?= ($leTechnicien==null)?'name="Valider" value="Valider"':
            'name="Modifier" value="Modifier"'?>
            ></td>
        </tr>

		<?= ($leTechnicien==null)?'':'<input type="hidden" name="idtech" value="'.$leTechnicien['idtech'].'">'?>

	</table>
</form>