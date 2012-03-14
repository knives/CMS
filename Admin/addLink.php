<?php
include_once '../include/librairie.php';
include_once '../classes/ListePages.php';
include_once '../classes/Pages.php';
include_once '../classes/liens.php';
include_once '../classes/ListeLiens.php';
include_once '../classes/Type.php';
include_once '../classes/ListeType.php';
VerifConnexion();
$enreg = RecupVarForm('enreg');
$nb_link = RecupVarForm("nb_link");
if($enreg==1){
    for($i=-1;$i<$nb_link;$i++){
        if(RecupVarForm('modif_ligne_'.$i)==1 || $i==-1){
            $link = new Liens();
            $link->libelle_lien=RecupVarForm("libelle_lien_".$i);
            $link->action_lien=RecupVarForm("action_lien_".$i);
            $link->titre=RecupVarForm("titre_".$i,0);
            $link->position=RecupVarForm("position_".$i);
            if($i==-1 && $link->libelle_lien!='' && $link->action_lien!='' && $link->position!=''){
                $link->AddLink();
            } else if($i>-1){
                $link->id_lien = RecupVarForm("id_lien_".$i);
                $link->MajLink();
            }
        }
    }
}
$ll= new ListeLiens();
$ll->GetListeLiens();
$lp = new ListePages();
$lp->GetListePages(0);
$Apg = $lp->MakeArray(0,'title_page','nom_fichier');
$lt=new ListeType();
$lt->GetListeType();
CreationHead("Administraion V-1.0.0.0");
?>

    <form id="FormArt" name="FormArt" method="POST" >
        <?php
        AddHidden('enreg',0);
        AddHidden('nb_link',$ll->nbLiens);
        ?>
    <div style="display:none;z-index: 2;position: absolute;" id="DivTool">
        <table>
            <tr>
                <td style="width:80%;" class="titre">Ajouter un lien</td>
                <td style="text-align:right;width:20%;">
                    <a href="javascript:document.getElementById('enreg').value=1;document.getElementById('FormArt').submit();" style="border:0;"><img src="IMG/Save.png" style="width:24px;height:24px;"></a>
                    <a href="javascript:AddLinkOff();" style="border:0;"><img src="IMG/delete.png" style="width:24px;height:24px;"></a>
                </td>
            </tr>
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                <td colspan="2">
                    <table cellpadding="0" cellspacing="0" style="width:100%;" id="ListeAdmin">
                        <thead>
                            <tr>
                                <td>&nbsp;Libell&eacute;</td>
                                <td>&nbsp;Cible du lien</td>
                                <td>&nbsp;Titre de menu</td>
                                <td>&nbsp;Position dans le menu</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php AddTextbox('libelle_lien_-1',"",'onchange="MajChamp(this);"');?></td>
                                <td><?php AddSelect("action_lien_-1",$Apg,'','onchange="MajChamp(this);"',1,0,1); ?></td>
                                <td><?php AddCheckbox('titre_-1','','onchange="MajChamp(this);"');?></td>
                                <td><?php AddTextbox('position_-1','','onchange="MajChamp(this);"');?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <img id='patienter_image' src='IMG/fond.png' style='position:absolute;-moz-opacity:0.3;opacity: 0.3;filter:alpha(opacity=30); z-index:1; display:none; '>
    <table cellpadding="0" cellspacing="0" style="width:100%;" id="Bloc">
        <tr>
            <td style="width:80%;" class="titre">Liste des Liens</td>
            <td style="width:20%;text-align:right;">
                <a href="javascript:document.getElementById('enreg').value=1;document.getElementById('FormArt').submit();" style="border:0;"><img src="IMG/Save.png" style="width:24px;height:24px;"></a>
                <a href="javascript:ParamArt();" style="border:0;"><img src="IMG/Add.png" style="width:24px;height:24px;">
            </td>
        </tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr>
            <td colspan="2">
                <table cellpadding="0" cellspacing="0" style="width:100%;" id="ListeAdmin">
                    <thead>
                        <tr>
                            <td>&nbsp;Id_lien</td>
                            <td>&nbsp;Libell&eacute;</td>
                            <td>&nbsp;Cible du lien</td>
                            <td>&nbsp;Fen&ecirc;tre du lien</td>
                            <td>&nbsp;Methode d'envoie de données</td>
                            <td>&nbsp;Titre de menu</td>
                            <td>&nbsp;Position dans le menu</td>
                            <td>&nbsp;Type de lien</td>
                            <td>&nbsp;Page</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($i=0;$i<$ll->nbLiens;$i++){
                        ?>
                        <tr>
                            <td>&nbsp;<?php AddHidden('modif_ligne_'.$i,'0');AddHidden('id_lien_'.$i,$ll->arrayLiens[$i]->id_lien);print $ll->arrayLiens[$i]->id_lien;?></a></td>
                            <td><?php AddTextbox('libelle_lien_'.$i,$ll->arrayLiens[$i]->libelle_lien,'onchange="MajChamp(this);document.getElementById(\'modif_ligne_'.$i.'\').value=1;"');?></td>
                            <td><?php AddSelect("action_lien_".$i,$Apg,$ll->arrayLiens[$i]->action_lien,'onchange="MajChamp(this);document.getElementById(\'modif_ligne_'.$i.'\').value=1;"',1,0,1); ?></td>
                            <td><?php print $ll->arrayLiens[$i]->target;?></td>
                            <td>&nbsp;<?php print $ll->arrayLiens[$i]->method;?></td>
                            <td><?php AddCheckbox('titre_'.$i, $ll->arrayLiens[$i]->titre,'onchange="MajChamp(this);document.getElementById(\'modif_ligne_'.$i.'\').value=1;"');?></td>
                            <td><?php AddTextbox('position_'.$i,$ll->arrayLiens[$i]->position,'onchange="MajChamp(this);document.getElementById(\'modif_ligne_'.$i.'\').value=1;"');?></td>
                            <td>&nbsp;<?php print $lt->arrayCode[$ll->arrayLiens[$i]->id_type]->libelle_type;?></td>
                            <td>&nbsp;<?php print $ll->arrayLiens[$i]->title_page;?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </td>
        </tr>                
    </table>    
</form>
<?php
FinBody();
?>