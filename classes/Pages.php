<?php
class Pages {
	var $id_page;
	var $title_page;
	var $nom_fichier;
	var $id_type;
    var $template;
    var $position = array();
    var $nb_position=0;
	var $main_page=null;
    
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
        
        function SetPage(){
            $LO_conn = F_creer_connexion();
            if($this->id_page==-1){
                $sql="select max(id_page)+1 as nb from page ";
                $Ls_rs = F_executer_requete($LO_conn, $sql);
                F_recuperer_ligne($Ls_rs);
                $this->id_page=F_retourne_resultat($Ls_rs, "nb");
            } else {
                $sql = "delete from page where id_page = ".$this->id_page;
                $Ls_rs = F_executer_requete($LO_conn, $sql);
            }
            $sql = "insert into page (id_page ,title_page,nom_fichier,id_type,main_page) values (".$this->id_page.",'".$this->title_page."','".$this->nom_fichier."',".$this->id_type.",'".$this->main_page."')";
            $Ls_rs = F_executer_requete($LO_conn, $sql);
			
			$sql ="select id_template from template where active = 1 ";
			$id_template = GetSQL($LO_conn,$sql,'id_template');
			$sql ="select position from template_position where id_template  = ".$id_template.' and id_type = '.$this->id_type;
			$position = GetSQL($LO_conn,$sql,'position');
            if ($this->id_type==0){
                $type='DATA';
				$sql="delete from template_page where id_page=".$this->id_page;
				F_executer_requete($LO_conn, $sql);
				$sql="delete from template_page where main_page=".$this->id_page;
				F_executer_requete($LO_conn, $sql);
				$sql ='insert into template_page (id_template,id_page,position,main_page) select '.$id_template.',p.id_page,tp.position,'.$this->id_page.' from page p, template_position tp where tp.id_type=p.id_type and p.id_type=1';
				F_executer_requete($LO_conn, $sql);
				$sql ='insert into template_page (id_template,id_page,position,main_page) select '.$id_template.',p.id_page,tp.position,'.$this->id_page.' from page p, template_position tp where tp.id_type=p.id_type and p.main_page='.$this->id_page;
				F_executer_requete($LO_conn, $sql);
            } else if ($this->id_type==1){
                $type='MENU';
            } else if ($this->id_type==4){
                $type='ART';
            }
            SETTPL($type, $this->nom_fichier);			
			
            F_close_connexion($LO_conn);
        }
}
?>