<br>
<h3>Ajout d'un produit</h3>
<form method="post">
	<table>
		<tr>
			<td> Nom du produit : </td>
			<td> <input type="text" name="nomproduit" value="<?= ($leProduit==null)?' ':$leProduit['nomproduit']?>"></td>
		</tr>

		<tr>
			<td> Prix unitaire du produit : </td>
			<td> <input type="text" name="prix_unit" value="<?= ($leProduit==null)?' ':$leClient['prix_unit']?>"></td>
		</tr>

		<tr>
			<td> Catégorie  du produit : </td>
			<td> <input type="text" name="codecat" value="<?= ($leProduit==null)?' ':$leProduit['codecat']?>"></td>
		</tr>

        
		
		<tr>
            <td> <input type="reset" name="Annuler" value="Annuler"> </td>
            <td> <input type="submit"
           
            <?= ($leProduit==null)?'name="Valider" value="Valider"':
            'name="Modifier" value="Modifier"'?>
            ></td>
        </tr>

		<?= ($leProduit==null)?'':'<input type="hidden" name="idproduit" value="'.$leProduit['idproduit'].'">'?>

	</table>
</form>