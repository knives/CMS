<?php
class Article{
	var $id_article;
	var $id_page;
	var $memo;
    var $title_page;
	var $main_page;
	function Article(){
	}
    
    function MajArticle(){
        $LO_conn = F_creer_connexion();
        if($this->id_article!=-1){
            $sql="delete from article where id_article = ".$this->id_article;
            $Ls_rs = F_executer_requete($LO_conn, $sql);
        } else {
            $sql="select max(id_article)+1 as nb from article ";
            $Ls_rs = F_executer_requete($LO_conn, $sql);
            F_recuperer_ligne($Ls_rs);
            $this->id_article=F_retourne_resultat($Ls_rs, "nb");
        }
        $sql="insert into article( id_article,id_page,memo) values (".$this->id_article.",".$this->id_page.",'".str_replace("'","''",$this->memo)."')";
        $Ls_rs = F_executer_requete($LO_conn, $sql);
        
        F_close_connexion($LO_conn);
    }
}
?>
