<?php
class ListePages {
	var $arrayPage = array();
	var $nbPages=0;
	function ListePages(){
	}
    
    function GetListePages($type=''){
        $LO_conn = F_creer_connexion();
        $where_type="";
        if($type!==''){
            $where_type = " where p.id_type = ".$type;
        }
        $sql="select p.id_page,p.title_page,p.nom_fichier, p.id_type from page p ".$where_type;
        $Ls_rs = F_executer_requete($LO_conn, $sql);
        while(F_recuperer_ligne($Ls_rs)){
            $this->arrayPage[$this->nbPages]= new Pages();
            $pages =&$this->arrayPage[$this->nbPages];
            $pages->id_page = F_retourne_resultat($Ls_rs,'id_page');
            $pages->title_page = F_retourne_resultat($Ls_rs,'title_page');
            $pages->nom_fichier = F_retourne_resultat($Ls_rs,'nom_fichier');
            $pages->id_type = F_retourne_resultat($Ls_rs,'id_type');
            $pages->id_type = F_retourne_resultat($Ls_rs,'id_type');
            $this->nbPages++;
        }
        F_close_connexion($LO_conn);
    }
    function MakeArray($auto,$valeur,$cle=''){
        $array = array();
        if($auto==0 && $cle==''){
            return $array;
        }
        for($i=0;$i<$this->nbPages;$i++){
            if($auto==1){
                $array[$i]=$this->arrayPage[$i]->$valeur;
            } else {
                $array[$this->arrayPage[$i]->$cle]=$this->arrayPage[$i]->$valeur;
            }
        }
        return $array;
    }
}
?>
