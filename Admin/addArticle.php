<?php
include_once '../include/librairie.php';
include_once '../classes/ListePages.php';
include_once '../classes/Pages.php';
include_once '../classes/Article.php';
include_once '../classes/ListeArticle.php';
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
$lp->GetListePages(4);
$la= new ListeArticle();
$la->GetListeArticle();
CreationHead("Administraion V-1.0.0.0");
?>
<body>
    <form id="FormArt" name="FormArt" method="POST" >
        <?php
        AddHidden('id_art');
        AddHidden('enreg',0);
        ?>
    <div style="display:none;z-index: 2;position: absolute;" id="DivTool">
        <table>
            <tr>
                <td style="width:80%;" class="titre">Personnalisation de l'article</td>
                <td style="text-align:right;width:20%;">
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
    <table cellpadding="0" cellspacing="0" style="width:100%;" id="Bloc">
        <tr>
            <td style="width:80%;" class="titre">Liste des Articles</td>
            <td style="width:20%;text-align:right;"><a href="javascript:ParamArt(-1);" style="border:0;"><img src="IMG/Add.png" style="width:24px;height:24px;"></td>
        </tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr>
            <td colspan="2">
                <table cellpadding="0" cellspacing="0" style="width:100%;" id="ListeAdmin">
                    <thead>
                        <tr>
                            <td>&nbsp;Id_article</td>
                            <td>&nbsp;Page</td>
                            <td>&nbsp;Article</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($i=0;$i<$la->nb_article;$i++){
                        ?>
                        <tr>
                            <td>&nbsp;<a href="javascript:ParamArt('<?php print $la->liste_article[$i]->id_article;?>');"><?php print $la->liste_article[$i]->id_article;?></a></td>
                            <td>&nbsp;<?php print $la->liste_article[$i]->title_page;?></td>
                            <td>&nbsp;<span id="<?php  print $la->liste_article[$i]->id_article;?>"><?php print $la->liste_article[$i]->memo;?></span></td>
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
</body>
<script>
    var editor = CKEDITOR.replace( 'text_r1',
        {
            filebrowserBrowseUrl : 'filemanager/index.html',
            stylesSet:[],
            extraPlugins : 'stylesheetparser',
            contentsCss :'../CSS/<?php print $css_name;?>/<?php print $css_name;?>.css'
       }
    );
</script>
  