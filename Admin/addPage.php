<?php
include_once '../include/librairie.php';
include_once '../classes/ListePages.php';
include_once '../classes/Pages.php';
VerifConnexion();
$lp=new ListePages();
$lp->GetListePages();
print_a($lp,0,1);
?>
<table cellpadding="0" cellspacing="0" style="width: 100%;">
    <tr>
        <td>Param&eacute;trage des Pages</td>
    </tr>
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i=0;$i<$lp->nbPages;$i++){
                        $page =new Pages();
                        $page &=$lp->arrayPage[$i];
                    ?>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </td>
    </tr>
</table>