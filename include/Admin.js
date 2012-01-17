function ParamArt(id_article){
    Calc_On();
    document.getElementById("DivTool").style.display="";
    document.getElementById("id_art").value=id_article;
    document.getElementById("enreg").value=1;
    editor.destroy();
    document.getElementById("text_r1").value=document.getElementById(id_article).innerHTML;
    editor = CKEDITOR.replace( 'text_r1',{
        filebrowserBrowseUrl : 'filemanager/index.html'        
    });
}
function ParamArtOff(){
    document.getElementById("DivTool").style.display="none";
    document.getElementById("id_art").value="";
    document.getElementById("enreg").value=0;
    Calc_Off();
}
function Calc_On() {
    document.getElementById('patienter_image').style.top = 0;
    document.getElementById('patienter_image').style.left = 0;
    document.getElementById('patienter_image').style.width = screen.availWidth+'px';
    document.getElementById('patienter_image').style.height = screen.availHeight+'px';
    document.getElementById('patienter_image').style.display = 'inline';
    return true;
}
function Calc_Off() {
    if (document.getElementById('patienter_image')) {
        document.getElementById('patienter_image').style.display = 'none';
    }
    return true;
}    
function MajChamp(obj){
    obj.className='changed';
}
