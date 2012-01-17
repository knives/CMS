<?php
class ListeLiens{
	var $arrayLiens = array();
	var $nbLiens =0;
	function ListeLiens(){
	}
    function GetListeLiens(){
        $LO_conn = F_creer_connexion();
        $sql = "select l.id_lien, l.libelle_lien, l.action_lien,l.target,method,l.id_type,l.titre,l.position,p.title_page 
            from lien l ,lien_page lp ,page p
            where l.id_lien=lp.id_lien and p.id_page = lp.id_page
            and l.id_type='1' order by position";
        $Ls_rs = F_executer_requete($LO_conn,$sql);
        while(F_recuperer_ligne($Ls_rs)){
            $this->arrayLiens[$this->nbLiens] = new Liens();
            $Lien = &$this->arrayLiens[$this->nbLiens];
            $Lien->id_lien = F_retourne_resultat($Ls_rs, 'id_lien');
            $Lien->libelle_lien = F_retourne_resultat($Ls_rs, 'libelle_lien');
            $Lien->action_lien = F_retourne_resultat($Ls_rs, 'action_lien');
            $Lien->target = F_retourne_resultat($Ls_rs, 'target');
            $Lien->method = F_retourne_resultat($Ls_rs, 'method');
            $Lien->id_type = F_retourne_resultat($Ls_rs, 'id_type');
            $Lien->titre = F_retourne_resultat($Ls_rs, 'titre');
            $Lien->position = F_retourne_resultat($Ls_rs, 'position');
            $Lien->title_page = F_retourne_resultat($Ls_rs, 'title_page');
            $this->nbLiens++;
        }
        F_close_connexion($LO_conn);
    }
}
?>