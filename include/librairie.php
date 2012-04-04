<?php
//session_save_path(dirname(__FILE__).'../temp');
if(!isset($_COOKIE['id_sess'])){
	@session_start();
	@$session_sid = session_id();
	setcookie('id_sess', $session_sid, time() + 365*24*3600);
} else {
	@$session_sid = session_id($_COOKIE['id_sess']);
	@session_start();
}
include_once dirname(__FILE__).'/../config/ini.php';
date_default_timezone_set('Europe/Paris');
define ("FATAL",E_USER_ERROR);
define ("ERROR",E_USER_WARNING);
define ("WARNING",E_USER_NOTICE);
define ("ALL_ERROR",E_ALL);
if ($GS_erreur_reporting == 1){
	ini_set('display_errors', 1);
	error_reporting(FATAL + ERROR + WARNING + ALL_ERROR);
} else {
	error_reporting(FATAL + ERROR);
}
include_once dirname(__FILE__).'/connexion.php';
include_once dirname(__FILE__).'/version.php';
include_once dirname(__FILE__).'/lib_debug.php';
MajVersion();

function RecupVarForm($name,$def=''){
    if (isset($_POST[$name])){
        if($_POST[$name]!=''){
            return $_POST[$name];
        } else {
            return $def;
        }
    } else if (isset($_GET[$name])){
        if($_GET[$name]!=''){
            return $_GET[$name];        
        } else {
            return $def;
        }
    } else {
        return $def;
    }
}
function VerifConnexion($user="",$pass=""){
    $die=0;
    if(!isset($_SESSION['authentificate']) || $_SESSION['authentificate']==""){
        if($user=="Knives" && $GS_debug==1){
            $_SESSION['authentificate']=777;
        } else {
            if($user!='' && $pass!=''){
                    $LO_conn = F_creer_connexion();
                    $sql="select id_user from user where upper(username) = '".strtoupper($user)."' and pass='".$pass."'";
                    $Ls_rs = F_executer_requete($LO_conn, $sql);
                    if(F_recuperer_ligne($Ls_rs)){
                        $_SESSION['authentificate'] = F_retourne_resultat($Ls_rs, 'id_user');
                    } else {
                        $die=1;
                    }
                    F_close_connexion($LO_conn);
            } else {
                $die=1;
            }
        }
    } else if($_SESSION['authentificate']==''){
        $die=1;
    }
    if($die==1){
        ?>
        <script>
            alert('identifiants incorrects');
            window.location='Login.php';
        </script>
        <?php
        die('Identifiants incorrects');
    }
}
function AddHidden($id,$value=""){
    ?>
        <input type="hidden" name="<?php print $id;?>" id="<?php print $id;?>" value="<?php print $value;?>">
    <?php
}
function AddTextbox($id,$value="",$plus=""){
    ?>
        <input type="textbox" name="<?php print $id;?>" id="<?php print $id;?>" value="<?php print $value;?>" <?php print $plus;?>>
    <?php
}
function AddCheckbox($id,$value="",$plus=""){
    ?>
        <input type="checkbox" name="<?php print $id;?>" id="<?php print $id;?>" value="1" <?php print $plus;?> <?php if($value==1) { print 'checked'; }?>>
    <?php
}
function AddAutoComplete($id,$javascript_array_name,$value="",$autre=''){
    ?>
    <input type="text" onkeypress="SetAutoComp(<?php print $javascript_array_name;?>,'div_auto_cple',this,event);"   id="<?php print $id;?>" name="<?php print $id;?>" autocomplete="off" value="<?php print $value;?>" <?php print $autre;?>>
    <input type="hidden" name="h_<?php print $id;?>" id="h_<?php print $id;?>" value="-1">
    <?php
}
function AddSelect($id,$array,$value="",$plus="",$zero='',$keylib='',$each=''){
    ?>
    <select id="<?php print $id;?>" name="<?php print $id;?>" <?php print $plus;?>>
        <?php
        if($zero==1){
            ?>
        <option value="">&nbsp;</option>
            <?php
        }
        if($each==1){
            foreach($array as $cle => $valeur){
                if($keylib==1){
                    $val = $valeur;
                } else {
                    $val = $cle;
                }
                $sel='';
                if($val==$value){
                    $sel='selected';
                }
                ?>
                <option <?php print $sel;?> value="<?php print $val;?>"><?php print $valeur;?></option>
                <?php
            }
        } else {
            for($i=0;$i<count($array);$i++){
                if($keylib==1){
                    $val = $array[$i];
                } else {
                    $val = $i;
                }
                $sel='';
                if($val==$value){
                    $sel='selected';
                }
                ?>
                <option <?php print $sel;?> value="<?php print $val;?>"><?php print $array[$i];?></option>
                <?php
            }
        }
        ?>
    </select>
    <?php
}

function GetArrayMethod(){
    $a = array();
    $a[0]='GET';
    $a[1]='POST';
    return $a;
}
function GetArrayTarget(){
    $a = array();
    $a[0]='_self';
    $a[1]='_blank';
    $a[2]='Frame1';
    $a[3]='Frame2';
    $a[4]='Frame3';
    $a[5]='Frame4';
    return $a;
}
function CreationHead($title=""){
	global $css_name;
	$LO_conn = F_creer_connexion();
	$sql = "select nom_css from css where active = 1";
	$Ls_rs = F_executer_requete($LO_conn,$sql);
	F_recuperer_ligne($Ls_rs);
	$css_name = F_retourne_resultat($Ls_rs,'nom_css');
	F_close_connexion($LO_conn);
    ?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <head>
        <title><?php print $title;?></title>
        <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
        <script type="text/javascript" src="../ckeditor/ckeditor.js?v=<?php print filemtime("../ckeditor/ckeditor.js");?>"></script>
        <script type="text/javascript" src="../include/librairie.js?v=<?php print filemtime('../include/librairie.js');?>"></script>    
        <?php
        GetCss();
        ?>
    </head>
    <body>
    <div id="div_auto_cple" name="div_auto_cple" style="position: absolute;display:none;background-color:#FFFFFF;"></div>
    <?php
}
function FinBody(){
    ?>
    </body>
    <?php
}
function ScanDirectory($directory){
    $cursor = opendir($directory);
    $ListF=array();
    while($file = readdir($cursor)){
        if($file!='.' && $file!='..'){
            if(is_dir($directory.'/'.$file)){
                $ListF[]=ScanDirectory($directory.'/'.$file);
            } else {
                $ListF[]=$directory.'/'.$file;
            }
        }
    }
    return $ListF;
}
function GetCss(){
	global $css_name;
    ?>
    <LINK rel="stylesheet" type="text/css" href="../CSS/<?php print $css_name;?>/<?php print $css_name;?>.css?v=<?php print filemtime('../CSS/'.$css_name.'/'.$css_name.'css');?>">
    <link rel="shortcut icon" type="image/x-icon" href="../CSS/<?php print $css_name;?>/logo.ico" />
    <?php
}
function php2js( $php_array, $js_array_name ) {
	 if( !is_array( $php_array ) ) {
		trigger_error( "php2js() => 'array' attendu en parametre 1, '".gettype($array)."' fourni !?!");
		return false;
	}
	if( !is_string( $js_array_name ) ) {
		trigger_error( "php2js() => 'string' attendu en parametre 2, '".gettype($array)."' fourni !?!");
		return false;
	}
	$script_js = "var {$js_array_name} = new Array();\n";
	reset($php_array);
	while( list($key, $value) = each($php_array) ) {
		if(is_array($value)) {
			$temp = uniqid('temp_');
			$t = php2js( $value, $temp );
			if( $t===false ) {
                return false;
            }
			$script_js.= $t;
			$script_js.= "{$js_array_name}['{$key}'] = {$temp};\n";
		} elseif(is_int($key)) {
            $script_js.= "{$js_array_name}[{$key}] = '{$value}';\n";
        } else {
            $script_js.= "{$js_array_name}['{$key}'] = '{$value}';\n";
        }
	}
	return $script_js;
}
function Obj2Array($TabObj,$auto,$valeur,$cle='',$each=""){
    $array = array();
    if($auto==0 && $cle==''){
        return $array;
    }
    if($each==1){
        foreach($TabObj as $key => $val){
            if($auto==1){
                $array[$key]=$TabObj[$key]->$valeur;
            } else {
                $array[$TabObj[$key]->$cle]=$TabObj[$key]->$valeur;
            }
        }
    } else {
        for($i=0;$i<count($TabObj);$i++){
            if($auto==1){
                $array[$i]=$TabObj[$i]->$valeur;
            } else {
                $array[$TabObj[$i]->$cle]=$TabObj[$i]->$valeur;
            }
        }
    }
    return $array;
}
function SETTPL($type,$new_name){
    $a = fopen('TPL/'.$type.'.tpl.php', 'r+');
    $s='';
    while(!feof($a)) {
        $s .= fgets($a);
    }
    if($type=='DATA'){
        $s = str_replace('@PAGE_NAME@', $new_name, $s);
    }
    fclose($a);
    $a=fopen('../pages/'.$new_name, 'w+');
    fwrite($a, $s);
    fclose($a);
}

function GetSQL($LO_conn,$sql,$champ){
	$sql ="select id_template from template where active = 1 ";
	$Ls_rs = F_executer_requete($LO_conn,$sql);
	$tmp='';
	if($champ!=''){
		F_recuperer_ligne($Ls_rs);
		$tmp = F_retourne_resultat($Ls_rs,'id_template');
	}
	return $tmp;
}
?>
