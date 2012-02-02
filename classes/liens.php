<?php
class Liens {
    var $id_lien;
    var $libelle_lien;
    var $action_lien;
    var $target;
    var $method;
    var $id_type;
    var $titre;
    var $position;
    var $title_page;
    
    function Liens(){
    }
    
    function AddLink(){
        $LO_conn = F_creer_connexion();
        $sql="select max(id_lien)+1 as nb from lien";
        $Ls_rs = F_executer_requete($LO_conn, $sql);
        F_recuperer_ligne($Ls_rs);
        $this->id_lien = F_retourne_resultat($Ls_rs, "nb");
        $sql="insert into lien ( id_lien ,libelle_lien ,action_lien ,target ,method ,position ,titre ,id_type ) 
            values (".$this->id_lien.",'".$this->libelle_lien."','".$this->action_lien."','".$this->target."','',".$this->position.",".$this->titre.",1)";
        F_executer_requete($LO_conn, $sql);
        F_close_connexion($LO_conn);
    }
    
    function MajLink(){
        $LO_conn = F_creer_connexion();
        $sql="update lien set libelle_lien ='".$this->libelle_lien."', action_lien ='".$this->action_lien."', target ='".$this->target."', method ='',position =".$this->position.",
            titre ='".$this->titre."',id_type =1
            where id_lien =".$this->id_lien."";
        F_executer_requete($LO_conn, $sql);
        F_close_connexion($LO_conn);
    }
}
?>