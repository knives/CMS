<?php
class ListeArticle{
	var $liste_article;
	var $nb_article = 0;
	function ListeArticle(){
	}
        function GetListeArticle(){
            $LO_conn = F_creer_connexion();
            $sql = "select a.memo,a.id_article,p.id_page,p.title_page from article a,page p where a.id_page = p.id_page order by id_article";
            $Ls_rs = F_executer_requete($LO_conn,$sql);
            while(F_recuperer_ligne($Ls_rs)){
                $this->liste_article[$this->nb_article] = new Article();
                $article =&$this->liste_article[$this->nb_article];
                $article->id_article = F_retourne_resultat($Ls_rs, 'id_article');
                $article->memo = F_retourne_resultat($Ls_rs, 'memo');
                $article->id_page = F_retourne_resultat($Ls_rs, 'id_page');
                $article->title_page = F_retourne_resultat($Ls_rs, 'title_page');
                $this->nb_article++;
            }
            F_close_connexion($LO_conn);
        }
}
?>
