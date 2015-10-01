<?php
?>

		
			<table class="table" id="AffectationTable">
			<caption>Affectations de la Formation : <?php echo $preview->Classe; ?> , Semestre : <?php echo $preview->Semestre; ?></caption>
			<tr><th>Nom Professeur</th><th>Mati&egrave;re</th> <th> CM </th> <th> TD </th> <th> TP </th> </tr>
			<?php
			foreach ($preview->RequestMatiere as $Matiere) {
				echo "<tr>";
				echo "<td>".$Matiere->Enseignants[0]->Prenom." ".$Matiere->Enseignants[0]->Nom."</td>";
				echo "<td>".$Matiere->libelle."</td>";
				echo "<td>".$Matiere->CM."</td>";
				echo "<td>".$Matiere->TD."</td>";
				echo "<td>".$Matiere->TP."</td>";
				echo "</tr>";
			}
			?>
			<tr> <td></td> <td></td> <td></td> <td></td> <td></td></tr>
			</table>
		<button class="btn btn-success nextBtn btn-lg pull-right" type="button">GENERER</button>
		</div>	
