<?php
class Data{
    var $position = array();
    var $nb_position;
    
    function ChargeMenu(){
        $LO_conn = F_creer_connexion();
        $sql = "select id_lien, libelle_lien, action_lien,target,method,id_type,titre,position from lien where id_type='1' order by position";
        $ListeLien = new ListeLiens();
        $ListeLien->nbLiens=0;
        $Ls_rs = F_executer_requete($LO_conn,$sql);
        while(F_recuperer_ligne($Ls_rs)){
            $ListeLien->arrayLiens[$ListeLien->nbLiens] = new Liens();
            $Lien =&$ListeLien->arrayLiens[$ListeLien->nbLiens];
            $Lien->id_lien = F_retourne_resultat($Ls_rs, 'id_lien');
            $Lien->libelle_lien = F_retourne_resultat($Ls_rs, 'libelle_lien');
            $Lien->action_lien = F_retourne_resultat($Ls_rs, 'action_lien');
            $Lien->target = F_retourne_resultat($Ls_rs, 'target');
            $Lien->method = F_retourne_resultat($Ls_rs, 'method');
            $Lien->id_type = F_retourne_resultat($Ls_rs, 'id_type');
            $Lien->titre = F_retourne_resultat($Ls_rs, 'titre');
            $Lien->position = F_retourne_resultat($Ls_rs, 'position');
            $ListeLien->nbLiens++;
        }
        F_close_connexion($LO_conn);
        $this->position[0] = $ListeLien;
        $this->nbLiens++;
    }
    
    function ChargePosition($id_page,$index){
        $LO_conn = F_creer_connexion();
        $sql = "select id_type from page where id_page = ".$id_page;
        $Ls_rs = F_executer_requete($LO_conn,$sql);
        F_recuperer_ligne($Ls_rs);
        $type = F_retourne_resultat($Ls_rs,'id_type');
        switch ($type){
            case 4:
                //Article
                $sql = "select memo,id_article from article a where id_page = ".$id_page;
                $Ls_rs2 = F_executer_requete($LO_conn,$sql);
                $i=0;
                while(F_recuperer_ligne($Ls_rs2)){
                    $this->position[$index][$i] = new Article();
                    $this->position[$index][$i]->memo = F_retourne_resultat($Ls_rs2,'memo');
                    $this->position[$index][$i]->id_article = F_retourne_resultat($Ls_rs2,'id_article');
                    $i++;
                }
            break;
        }
        F_close_connexion($LO_conn);
    }
}
?>
