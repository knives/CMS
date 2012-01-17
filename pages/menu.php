<table cellpadding="0" cellspacing="0" class="menu">
    <?php
    $ListeLiens = new ListeLiens();
    $ListeLiens = $DATA->position[0];
    for($i=0;$i<$ListeLiens->nbLiens;$i++){
        if($ListeLiens->arrayLiens[$i]->titre==1){
        ?>
            <tr><td class="titre"><?php print $ListeLiens->arrayLiens[$i]->libelle_lien;?></td></tr>
        <?php
        } else {
        ?>
            <tr><td><a href="<?php print $ListeLiens->arrayLiens[$i]->action_lien;?>" target="<?php print $ListeLiens->arrayLiens[$i]->target;?>"><?php print $ListeLiens->arrayLiens[$i]->libelle_lien;?></a></td></tr>
        <?php
        }
    }
    ?>
</table>