<?php
class Pages {
	var $id_page;
	var $title_page;
	var $nom_fichier;
	var $id_type;
        var $template;
        var $position = array();
        var $nb_position=0;
    
	function Pages(){
	}
	function ChargePage($pagename){
            $LO_conn = F_creer_connexion();
            $sql = "select distinct t.nom_fichier,p.title_page,p.id_type,tp.position,p2.nom_fichier as nombloc, p2.id_page as id_libel from page p, template_page tp, template t, page p2
                where p.id_page=tp.main_page
                and tp.id_page = p2.id_page 
                and tp.id_template = t.id_template
                and p.nom_fichier='".$pagename."' ";
            $Ls_rs=F_executer_requete($LO_conn, $sql);
            while(F_recuperer_ligne($Ls_rs)){
                $this->template = F_retourne_resultat($Ls_rs,'nom_fichier');
                $this->title_page = F_retourne_resultat($Ls_rs,'title_page');
                $this->id_type = F_retourne_resultat($Ls_rs,'id_type');
                if(F_retourne_resultat($Ls_rs,'position')!=''){
                    $this->position[F_retourne_resultat($Ls_rs,'position')]['name'] = F_retourne_resultat($Ls_rs,'nombloc');
                    $this->position[F_retourne_resultat($Ls_rs,'position')]['id'] = F_retourne_resultat($Ls_rs,'id_libel');
                }
                $this->nb_position++;
            }
            F_close_connexion($LO_conn);
        }
}
?>