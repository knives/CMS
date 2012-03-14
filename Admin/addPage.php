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
        if(RecupVarForm('modif_ligne_'.$i)==1 || $i==-1){
            $p = new Pages();
            if($i==-1){
                $p->id_page=$i;
            } else {
                $p->id_page=RecupVarForm('id_page_'.$i);
            }
            $p->title_page = RecupVarForm('title_page_'.$i);
            $p->nom_fichier = RecupVarForm('nom_fichier_'.$i);
            $p->id_type = RecupVarForm('id_type_'.$i);
            $p->main_page = RecupVarForm('main_page_'.$i);
            if($p->nom_fichier!=''){
                $p->SetPage();
            }
        }
    }
}
$lp=new ListePages();
$lp->GetListePages();
$lp2=new ListePages();
$lp2->GetListePages(0);
$lt=new ListeType();
$lt->GetListeType();
$Apg = Obj2Array($lt->arrayCode,1,'libelle_type','',1);
$Apg2 = Obj2Array($lp2->arrayPage,0,'title_page','id_page',0);
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
								<td>&nbsp;Page Parente</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php AddTextbox('title_page_-1', '', 'onchange="MajChamp(this);"');?></td>
                                <td><?php AddTextbox('nom_fichier_-1', '', 'onchange="MajChamp(this);"');?></td>
                                <td><?php AddSelect("id_type_-1",$Apg,'','onchange="MajChamp(this);"',1,0,1); ?></td>
								<td><?php AddSelect("main_page_-1",$Apg2,'','onchange="MajChamp(this);"',1,0,1); ?></td>
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
							<td>&nbsp;Page Parente</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($i=0;$i<$lp->nbPages;$i++){
                            $page =new Pages();
                            $page =&$lp->arrayPage[$i];
                        ?>
                        <tr>
                            <td><?php print $page->id_page;AddHidden('id_page_'.$i,$page->id_page);AddHidden('modif_ligne_'.$i,'0');?></td>
                            <td><?php AddTextbox('title_page_'.$i, $page->title_page, 'onchange="MajChamp(this);document.getElementById(\'modif_ligne_'.$i.'\').value=1;"');?></td>
                            <td><?php AddTextbox('nom_fichier_'.$i, $page->nom_fichier, 'onchange="MajChamp(this);document.getElementById(\'modif_ligne_'.$i.'\').value=1;"');?></td>
                            <td><?php AddSelect("id_type_".$i,$Apg,$page->id_type,'onchange="MajChamp(this);document.getElementById(\'modif_ligne_'.$i.'\').value=1;"',1,0,1); ?></td>
							<td><?php if($page->id_type!=0){ AddSelect("main_page_".$i,$Apg2,$page->main_page,'onchange="MajChamp(this);document.getElementById(\'modif_ligne_'.$i.'\').value=1;"',1,0,1); } else { print '&nbsp;';} ?></td>
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
