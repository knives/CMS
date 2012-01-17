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
$id_article = RecupVarForm('id_art');
$memo = RecupVarForm('text_r1');
$page = RecupVarForm('page');
if($enreg==1 && $id_article!=""){
    $art = new Article();
    $art->id_article=$id_article;
    $art->memo = $memo;
    $art->id_page = $page;
    $art->MajArticle();
}
$lp = new ListePages();
$lp->GetListePages(0);
$Apg = $lp->MakeArray(0,'title_page','nom_fichier');
$ll= new ListeLiens();
$ll->GetListeLiens();
$lt=new ListeType();
$lt->GetListeType();
CreationHead("Administraion V-1.0.0.0");
?>

    <form id="FormArt" name="FormArt" method="POST" >
        <?php
        AddHidden('id_art');
        AddHidden('enreg',0);
        ?>
    <div style="display:none;z-index: 2;position: absolute;" id="DivTool">
        <table>
            <tr>
                <td style="width:45%;">Personnalisation de l'article</td>
                <td style="text-align:right;width:55%;">
                    <a href="javascript:document.getElementById('FormArt').submit();" style="border:0;"><img src="IMG/Save.png" style="width: :24px;height:24px;"></a>
                    <a href="javascript:ParamArtOff();" style="border:0;"><img src="IMG/delete.png" style="width: :24px;height:24px;"></a>
                </td>
            </tr>
            <tr>
                <td>Choix de la Page :</td>
                <td style="text-align: right;">
                    <select id="page" name="page" style="width:95%;">
                        <?php
                        for($i=0;$i<$lp->nbPages;$i++){
                        ?>
                        <option value="<?php print $lp->arrayPage[$i]->id_page;?>"><?php print $lp->arrayPage[$i]->title_page;?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><textarea id="text_r1" name="text_r1" style="background-color: #ffb"></textarea></td>
            </tr>
        </table>
    </div>
    <img id='patienter_image' src='IMG/fond.png' style='position:absolute;-moz-opacity:0.3;opacity: 0.3;filter:alpha(opacity=30); z-index:1; display:none; '>
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
                <td>&nbsp;<?php print $ll->arrayLiens[$i]->id_lien;?></a></td>
                <td>&nbsp;<?php AddTextbox('libelle_lien_'.$i,$ll->arrayLiens[$i]->libelle_lien,'onchange="MajChamp(this);"');?></td>
                <td>&nbsp;<?php AddSelect("action_lien_".$i,$Apg,$ll->arrayLiens[$i]->action_lien,'onchange="MajChamp(this);"',1,0,1); ?></td>
                <td><?php print $ll->arrayLiens[$i]->target;?></td>
                <td>&nbsp;<?php print $ll->arrayLiens[$i]->method;?></td>
                <td>&nbsp;<?php AddCheckbox('titre_'.$i, $ll->arrayLiens[$i]->titre,'onchange="MajChamp(this);"');?></td>
                <td>&nbsp;<?php AddTextbox('position_'.$i,$ll->arrayLiens[$i]->position,'onchange="MajChamp(this);"');?></td>
                <td>&nbsp;<?php print $lt->arrayCode[$ll->arrayLiens[$i]->id_type]->libelle_type;?></td>
                <td>&nbsp;<?php print $ll->arrayLiens[$i]->title_page;?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</form>
<?php
FinBody();
?>
<script>
print_a(document.getElementById('ListeAdmin'));
</script>