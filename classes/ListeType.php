<?php
class ListeType {
	var $arrayType = array();
	var $arrayCode = array();
	var $nbType=0;
	function ListeType(){
	}
    
    function GetListeType($type=''){
        $LO_conn = F_creer_connexion();
        $where_type="";
        if($type!=''){
            $where_type = " where id_type = ".$type;
        }
        $sql="select id_type	,libelle_type,	code_type from type  ".$where_type;
        $Ls_rs = F_executer_requete($LO_conn, $sql);
        while(F_recuperer_ligne($Ls_rs)){
            /*on créer le tableau pour la configuration*/
            $this->arrayType[$this->nbType]= new Type();
            $Type =&$this->arrayType[$this->nbType];
            $Type->id_type = F_retourne_resultat($Ls_rs,'id_type');
            $Type->libelle_type = F_retourne_resultat($Ls_rs,'libelle_type');
            $Type->code_type = F_retourne_resultat($Ls_rs,'code_type');
            
            /*on créer le tableau raccourci pour l'affichage*/
            $this->arrayCode[F_retourne_resultat($Ls_rs,'id_type')]= new Type();
            $Type2 =&$this->arrayCode[F_retourne_resultat($Ls_rs,'id_type')];
            $Type2->id_type = F_retourne_resultat($Ls_rs,'id_type');
            $Type2->libelle_type = F_retourne_resultat($Ls_rs,'libelle_type');
            $Type2->code_type = F_retourne_resultat($Ls_rs,'code_type');
            
            $this->nbType++;
        }
        F_close_connexion($LO_conn);
    }
}
?>
