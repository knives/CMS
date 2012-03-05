<?php
include_once '../include/librairie.php';
include_once '../classes/ListePages.php';
include_once '../classes/Pages.php';
include_once '../classes/ListeType.php';
include_once '../classes/Type.php';
VerifConnexion();
$enreg = RecupVarForm('enreg');
if($enreg==1){
    $nb_page = RecupVarForm('nb_page');
    for($i=-1;$i<$nb_page;$i++){
        $p = new Pages();
        if($i==-1){
            $p->id_page=$i;
        } else {
            $p->id_page=RecupVarForm('id_page_'.$i);
        }
        $p->title_page = RecupVarForm('title_page_'.$i);
        $p->nom_fichier = RecupVarForm('nom_fichier_'.$i);
        $p->id_type = RecupVarForm('id_type_'.$i);
        if($p->nom_fichier!=''){
            $p->SetPage();
        }
    }
}
$lp=new ListePages();
$lp->GetListePages();
$lt=new ListeType();
$lt->GetListeType();
$Apg = Obj2Array($lt->arrayCode,1,'libelle_type','',1);
CreationHead("Administraion V-1.0.0.0");
?>

    <form id="FormArt" name="FormArt" method="POST" >
        <?php
        AddHidden('enreg',0);
        AddHidden('nb_page',$lp->nbPages);
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
                                <td>&nbsp;Titre de la Page</td>
                                <td>&nbsp;Fichier</td>
                                <td>&nbsp;Type</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php AddTextbox('title_page_-1', '', 'onchange="MajChamp(this);"');?></td>
                                <td><?php AddTextbox('nom_fichier_-1', '', 'onchange="MajChamp(this);"');?></td>
                                <td><?php AddSelect("id_type_-1",$Apg,'','onchange="MajChamp(this);"',1,0,1); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <img id='patienter_image' src='IMG/fond.png' style='position:absolute;-moz-opacity:0.3;opacity: 0.3;filter:alpha(opacity=30); z-index:1; display:none; '>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
        <tr>
            <td style="width:80%;" class="titre">Liste des Pages</td>
            <td style="width:20%;text-align:right;">
                <a href="javascript:document.getElementById('enreg').value=1;document.getElementById('FormArt').submit();" style="border:0;"><img src="IMG/Save.png" style="width:24px;height:24px;"></a>
                <a href="javascript:ParamArt();" style="border:0;"><img src="IMG/Add.png" style="width:24px;height:24px;">
            </td>
        </tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr>
            <td colspan="2">
                <table cellpadding="0" cellspacing="0" style="width: 100%;"  id="ListeAdmin">
                    <thead>
                        <tr>
                            <td>&nbsp;Id page</td>
                            <td>&nbsp;Titre de la page</td>
                            <td>&nbsp;fichier</td>
                            <td>&nbsp;Type</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($i=0;$i<$lp->nbPages;$i++){
                            $page =new Pages();
                            $page =&$lp->arrayPage[$i];
                        ?>
                        <tr>
                            <td>&nbsp;<?php print $page->id_page;AddHidden('id_page_'.$i,$page->id_page);?></td>
                            <td>&nbsp;<?php AddTextbox('title_page_'.$i, $page->title_page, 'onchange="MajChamp(this);"');?></td>
                            <td>&nbsp;<?php AddTextbox('nom_fichier_'.$i, $page->nom_fichier, 'onchange="MajChamp(this);"');?></td>
                            <td>&nbsp;<?php AddSelect("id_type_".$i,$Apg,$page->id_type,'onchange="MajChamp(this);"',1,0,1); ?></td>
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
