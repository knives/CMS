<?php
class RecordSet {
	var $currentRow=0;
	var $maxRow=0;
	var $result ;
	var $listRecord=array();
}
if($GS_db=="ORACLE"){
	//Creation de la chainde de connexion
	function F_creer_connexion(){
		global $GS_user;
		global $GS_pwd;
		global $GS_dsn;
		$connect = oci_connect($GS_user,$GS_pwd,$GS_dsn);
		if($connect){
			return $connect;
		} else {
			die('Connexion impossible a la base de donn&eacute;es');
		}
	}
	//Execution de la requete
    function F_executer_requete($LO_conn, $sql)    {
	   global $GS_debug;
	   if($LO_conn!=NULL){
		   if ($GS_debug=="1"){
		       print("<font color=blue>" . $sql . "</font><br><br><br>\n");
		   }
	       $Parse =  OCIParse($LO_conn,$sql);
	       $test = OCIExecute($Parse);
	       if ($test == false && !isset($GS_accueil)) {
	       		die('Une erreur est survenue, la requete est invalide');
		   }
		   return $Parse;
	   } else {
	   	   die('La connexion a la base de don&eacute;es n\'est pas valide');
	   }
    }
    //Initialisation du parseur de ligne
    function F_recuperer_ligne($AS_curseur){
        return OCIFetch($AS_curseur);
    }
    //Recuperation de la valeur d'un champ
    function F_retourne_resultat($AS_curseur,$AS_nom_champ) {
       return OCIResult($AS_curseur,strtoupper($AS_nom_champ));
    }
    //fermeture de la connexion à la base de données
    function F_close_connexion($AS_conn) {
       return OCILogOff($AS_conn);
    }
} else if ($GS_db=="MYSQL"){
	//Creation de la chainde de connexion
	function F_creer_connexion(){
		global $GS_user;
		global $GS_pwd;
		global $GS_dsn;
		global $GS_database;
		$link= mysql_connect($GS_dsn,$GS_user,$GS_pwd);
		mysql_select_db($GS_database,$link);
		return $link;
	}
	//Execution de la requete
	function F_executer_requete($LO_conn, $sql){
		global $GS_debug;
		if($GS_debug==1){
			print '<font style="color:BLUE">'.$sql.'</font><br>';
		}
		$link = new RecordSet();
		$link->result =mysql_query($sql,$LO_conn) ;
		return $link;
	}
	 //Initialisation du parseur de ligne
	function F_recuperer_ligne($result){
                    $result->listRecord = mysql_fetch_array($result->result,MYSQL_BOTH);
                    if($result->listRecord!=false){
                        //$result->listRecord = mysql_fetch_assoc($result->result);
                        return $result;
                    } else {
                        return false;
                    }
	}
	//Recuperation de la valeur d'un champ
	function F_retourne_resultat($result,$champ){
		return $result->listRecord[$champ];
	}
	//Fermeture du curseur de connexion
	function F_close_connexion($link) {
            mysql_close($link);
            return true;
        }
} else if($GS_db=="SOAP"){
	function F_creer_connexion(){
		global $GS_user;
		global $GS_pwd;
		global $GS_dsn;
		return true;
	}
} else if ($db == "NUSOAP"){
	function F_creer_connexion(){
		global $GS_user;
		global $GS_pwd;
		global $GS_dsn;
		return true;
	}
}
?>