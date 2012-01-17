<?php
include_once '../include/librairie.php';
$pass=sha1(RecupVarForm('pwd'));
$user=RecupVarForm('user');
VerifConnexion($user,$pass);
?>
<head>
    <title>Administration V 1.0.0.0</title>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
</head>
<table cellpading="0" cellspacing="0" style="width:100%;" id="Bloc">
    <tr>
        <td class="titre" style="width: 100%;">Administration</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table cellpading="0" cellspacing="0" style="width:100%;">
                <tr>
                    <td style="width:300px;" valign="top">
                        <table cellpading="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td><a title="Gestion des Pages" href="addPage.php" target="BodyF">Gestion des Pages</a></td>
                            </tr>
                            <tr>
                                <td><a title="Gestion des Formulaires" href="addForm.php" target="BodyF">Gestion des Formulaires</a></td>
                            </tr>
                            <tr>
                                <td><a title="Gestion des Liens" href="addLink.php" target="BodyF">Gestion des Liens</a></td>
                            </tr>
                            <tr>
                                <td><a title="Gestion des Articles" href="addArticle.php" target="BodyF">Gestion des Articles</a></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <iframe id="BodyF" name="BodyF" style="width:100%;height:750px;border:0px;margin:0px;padding:0px;"></iframe>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
