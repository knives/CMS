<?php
include_once '../include/librairie.php';
$_SESSION['authentificate']='';
?>
<head>
    <title>Administration V 1.0.0.0</title>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
</head>
<form id="form" name="form" action="admin.php" method="POST">
<table cellpadding="0" cellspacing="0" style="width:100%;">
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" id="identification">
                <tr>
                    <td class="titre" colspan="2">&nbsp;Identification</td>
                </tr>
                <tr>
                    <td style="width:250px;">&nbsp;</td>
                    <td style="width:300px;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;User : </td>
                    <td>&nbsp;<input type="text" name="user" id="user" size="20"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;Password :</td>
                    <td>&nbsp;<input type="password" name="pwd" id="pwd" size="20"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">&nbsp;<input type="submit" value="Connexion"></td>
                </tr>
            </table> 
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>
</form>