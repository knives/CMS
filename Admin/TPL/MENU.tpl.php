<table cellpadding="0" cellspacing="0" class="menu">
    <?php
    $ListeLiens = new ListeLiens();
    $ListeLiens = $DATA->position[0];
	$table_on=0;
    for($i=0;$i<$ListeLiens->nbLiens;$i++){
        if($ListeLiens->arrayLiens[$i]->titre==1){
			if($table_on==1){
				print "</table>";
				print "<table cellpadding=\"0\" cellspacing=\"0\" class=\"menu\">";
			}
			$table_on=1;
        ?>
			<thead>
            <tr><td class="titre"><?php print $ListeLiens->arrayLiens[$i]->libelle_lien;?></td></tr>
			</thead>
        <?php
        } else {
        ?>
			<tbody>
            <tr><td><a href="<?php print $ListeLiens->arrayLiens[$i]->action_lien;?>" target="<?php print $ListeLiens->arrayLiens[$i]->target;?>"><?php print $ListeLiens->arrayLiens[$i]->libelle_lien;?></a></td></tr>
			</tbody>
        <?php
        }
    }
    ?>
</table>