<?php
function MajVersion(){
    $LO_conn = F_creer_connexion();
    $sql = 'select version from versi';
    $Ls_rs = F_executer_requete($LO_conn,$sql);
    if(!F_recuperer_ligne($Ls_rs)){
        //création du Shémas de la database
        $sql = 'create table versi (version varchar(10))';
        F_executer_requete($LO_conn,$sql);
        $sql= " insert into versi (version) values ('0.0.0.0')";
        $Ls_rs = F_executer_requete($LO_conn,$sql);
        $versi = '0.0.0.0';
    } else {
        $versi = F_retourne_resultat($Ls_rs, 'version');
        if($versi==''){
             $sql= " insert into versi (version) values ('0.0.0.0')";
            $Ls_rs = F_executer_requete($LO_conn,$sql);
            $versi='0.0.0.0';
        }
    }
    F_close_connexion($LO_conn);
    $versi = str_replace('.','',$versi);
    if($versi<1000){
        M1000();
    }
}
function M1000(){
    $LO_conn = F_creer_connexion();
    $sql = "create table lien (
        id_lien int,
	libelle_lien varchar(80),
	action_lien varchar(50),
	target varchar(15),
	method varchar(5),
        position int,
        titre int,
	id_type int
        )";
    F_executer_requete($LO_conn,$sql);

    $sql = "create table page (
        id_page int,
	title_page varchar(50),
	nom_fichier varchar(50),
	id_type int
    )";
    F_executer_requete($LO_conn,$sql);
    
    $sql = "create table type (
        id_type int,
	libelle_type varchar(50),
	code_type varchar(10)
    )";
    F_executer_requete($LO_conn,$sql);
    
    $sql = "create table formulaire (
        id_formulaire int,
	nom_formulaire varchar(50),
	action varchar(50),
	target varchar(15),
	method varchar(5),
	id_type int )";
    F_executer_requete($LO_conn,$sql);
    
    $sql = "create table template (
        id_template int,
	nom_template varchar(50),
	nom_fichier varchar(50)
     )";
    F_executer_requete($LO_conn,$sql);
    
    $sql = "create table template_page (
        id_template int,
	id_page int,
	position int,
        main_page int
     )";
    F_executer_requete($LO_conn,$sql);
    
    $sql = "create table page_formulaire (
        id_formulaire int,
	id_page int
     )";
    F_executer_requete($LO_conn,$sql);
    
    $sql = "create table lien_page (
        id_lien int,
	id_page int
     )";
    F_executer_requete($LO_conn,$sql);
    
    $sql = "insert into type (id_type,libelle_type,code_type) values (0,'Affichage de donn&eacute;es','DATA')";
    F_executer_requete($LO_conn,$sql);
    
    $sql = "insert into type (id_type,libelle_type,code_type) values (1,'Lien du menu','MENU')";
    F_executer_requete($LO_conn,$sql);

    $sql = "insert into type (id_type,libelle_type,code_type) values (2,'Formulaire de fonn&eacute;es','FORM')";
    F_executer_requete($LO_conn,$sql);
    
    $sql = "insert into type (id_type,libelle_type,code_type) values (3,'Traitement de donn&eacute;es','TRAIT')";
    F_executer_requete($LO_conn,$sql);
    
    $sql = "insert into type (id_type,libelle_type,code_type) values (4,'Article','ART')";
    F_executer_requete($LO_conn,$sql);
    
    $sql = "create table article (id_article int ,id_page int ,memo text)";
    F_executer_requete($LO_conn,$sql);
    
    $sql="insert into page (id_page,title_page,nom_fichier,id_type) values (0,'Accueil','index.php',0)";
    F_executer_requete($LO_conn,$sql);

    $sql="insert into page (id_page,title_page,nom_fichier,id_type) values (1,'menu','menu.php',1)";
    F_executer_requete($LO_conn,$sql);

    $sql="insert into page (id_page,title_page,nom_fichier,id_type) values (2,'accueil','accueil.php',4)";
    F_executer_requete($LO_conn,$sql);

    $sql="insert into template (id_template,nom_template,nom_fichier) values (0,'Standard','standard.php')";
    F_executer_requete($LO_conn,$sql);


    $sql="insert into template_page (id_page,id_template,position,main_page) values (1,0,0,0)";
    F_executer_requete($LO_conn,$sql);
    
    $sql="insert into template_page (id_page,id_template,position,main_page) values (2,0,1,0)";
    F_executer_requete($LO_conn,$sql);
    
    $sql="insert into lien ( id_lien ,libelle_lien ,action_lien ,target ,method ,position ,titre ,id_type ) values (1,'Accueil','index.php','_self','',1,0,1)";
    F_executer_requete($LO_conn,$sql);
    
    $sql="insert into lien_page (id_lien ,id_page) values (1,1)";
    F_executer_requete($LO_conn,$sql);

    $sql="insert into lien_page (id_lien ,id_page) values (0,1)";
    F_executer_requete($LO_conn,$sql);

    $sql="insert into lien ( id_lien ,libelle_lien ,action_lien ,target ,method ,position ,titre ,id_type ) values (0,'Navigation','','','',0,1,1)";
    F_executer_requete($LO_conn,$sql);
    
    $sql="insert into article( id_article,id_page,memo) values (0,2,'Bienvenue dans cette nouvelle interface')";
    F_executer_requete($LO_conn,$sql);

    $sql="create table user (
        id_user int,
        username varchar(20),
        pass varchar(100))";
    F_executer_requete($LO_conn,$sql);
    
    $sql="insert into user (id_user,username,pass) values (0,'sadmin','3844466d66d1c8af2537bbe9c94036ac251cda24')";
    F_executer_requete($LO_conn,$sql);
    
    $sql = "update versi set version = '1.0.0.0' ";
    F_executer_requete($LO_conn,$sql);
    
    $sql = "create table css (id_css int , nom_css varchar(20) ,active int)";
    F_executer_requete($LO_conn,$sql);
	
	$sql="insert into css (id_css,nom_css,active) values (0,'standard',1)";
    F_executer_requete($LO_conn,$sql);
    
    F_close_connexion($LO_conn);
}
?>
