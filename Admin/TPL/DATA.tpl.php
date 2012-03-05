<?php
include_once '../include/librairie.php';
include_once '../classes/Pages.php';
$Page = new Pages();
$Page->ChargePage('@PAGE_NAME@');
CreationHead($Page->title_page);
require_once '../template/'.$Page->template;
FinBody();
?>