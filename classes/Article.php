<?php
class Article{
	var $id_article;
	var $id_page;
	var $memo;
    var $title_page;
	function Article(){
	}
    
    function MajArticle(){
        $LO_conn = F_creer_connexion();
        $sql="delete from article where id_article = ".$this->id_article;
        $Ls_rs = F_executer_requete($LO_conn, $sql);
        
        $sql="insert into article( id_article,id_page,memo) values (".$this->id_article.",".$this->id_page.",'".str_replace("'","''",$this->memo)."')";
        $Ls_rs = F_executer_requete($LO_conn, $sql);
        
        F_close_connexion($LO_conn);
    }
}
?>
