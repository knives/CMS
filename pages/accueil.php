<?php
    foreach($DATA->position[1] as $key => $value) {
        $Article = new Article();
        $Article = $value;
        print $Article->memo;
    }
?>
