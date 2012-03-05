<?php
include_once (dirname(__FILE__).'/../classes/Data.php');
include_once (dirname(__FILE__).'/../classes/liens.php');
include_once (dirname(__FILE__).'/../classes/ListeLiens.php');
include_once (dirname(__FILE__).'/../classes/Article.php');
$DATA =new Data();
$DATA->ChargeMenu();
print_a($Page,0,1);
if(!isset($Page)){
    $DATA->position[0] ='';
    $DATA->position[1] ='';
    $DATA->position[2] ='';
} else {
    for($i=1;$i<$Page->nb_position;$i++){
        $DATA->ChargePosition($Page->position[$i]['id'],$i);
    }
}
?>
<table cellpadding="0" cellspacing="0" class="standard">
    <tr>
        <td colspan="2" style="width:100%;">&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" class="menu">
                <tr>
                    <td>
                        <?php
                        require_once $Page->position[0]['name'];
                        ?>
                    </td>
                </tr>
            </table>
        </td>
        <td>
            <?php
            require_once $Page->position[1]['name'];
            ?>
        </td>
    </tr>
</table>