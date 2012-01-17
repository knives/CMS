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
function getAbsolutePosition(element){
    var ret = new Point();
    //Boucle qui donne les coordonnées de l'objet en fonction des objets parents'
    for(;element && element != document.body;ret.translate(element.offsetLeft, element.offsetTop), element = element.offsetParent);
    return ret;
}
function Point(x,y){
        this.x = x || 0;
        this.y = y || 0;
        this.toString = function(){
            return '('+this.x+', '+this.y+')';
        };
        this.translate = function(dx, dy){
            this.x += dx || 0;
            this.y += dy || 0;
        };
        this.getX = function(){ return this.x; }
        this.getY = function(){ return this.y; }
        this.equals = function(anotherpoint){
            return anotherpoint.x == this.x && anotherpoint.y == this.y;
        };
}    
function SetAutoComp(tab,id_div,obj,e){
    regen=1;
    if(e.keyCode==13){
        if(document.getElementById('h_'+obj.id).value>-1){
            sel = document.getElementById('h_'+obj.id).value;
            obj.value = document.getElementById(obj.id+"_c_"+sel).innerHTML;
            document.getElementById(id_div).style.display='none';
        } else {
            document.getElementById(id_div).style.display='none';
        }
        regen=0;
    } else if(e.keyCode==40){
        //fleche du bas
        if(document.getElementById(id_div).style.display==''){
            regen=0;
            sel=document.getElementById('h_'+obj.id).value;
            if(sel==-1){
                sel=0;
                sel_old=0;
            } else {
                sel_old=sel;
                sel++;
            }
            if(document.getElementById(obj.id+"_c_"+sel)){
                document.getElementById(obj.id+"_c_"+sel_old).style.backgroundColor="#FFFFFF";
                document.getElementById(obj.id+"_c_"+sel_old).style.color="#000000";
                document.getElementById(obj.id+"_c_"+sel).style.backgroundColor="#316AC5";
                document.getElementById(obj.id+"_c_"+sel).style.color="#FFFFFF";
                document.getElementById('h_'+obj.id).value=sel;
            }

        }
    } else if(e.keyCode==38){
        //fleche du haut
        if(document.getElementById(id_div).style.display==''){
            regen=0;
            sel=document.getElementById('h_'+obj.id).value;
            if(sel==0){
                document.getElementById(obj.id+"_c_"+sel).style.backgroundColor="#FFFFFF";
                document.getElementById(obj.id+"_c_"+sel).style.color="#000000";
                sel=-1;
                sel_old=0;
                document.getElementById('h_'+obj.id).value=sel;
            } else {
                sel_old=sel;
                document.getElementById(obj.id+"_c_"+sel).style.backgroundColor="#FFFFFF";
                document.getElementById(obj.id+"_c_"+sel).style.color="#000000";
                sel--;
            }
            if(document.getElementById(obj.id+"_c_"+sel)){
                document.getElementById(obj.id+"_c_"+sel_old).style.backgroundColor="#FFFFFF";
                document.getElementById(obj.id+"_c_"+sel_old).style.color="#000000";
                document.getElementById(obj.id+"_c_"+sel).style.backgroundColor="#316AC5";
                document.getElementById(obj.id+"_c_"+sel).style.color="#FFFFFF";
                document.getElementById('h_'+obj.id).value=sel;
            }

        }
    }
    if(regen==1){
        Coord = getAbsolutePosition(obj);
        x = Coord.x;
        y = Coord.y + obj.offsetHeight;
        //alert(Coord.x+' '+Coord.y);
        document.getElementById(id_div).style.left=x+'px';
        document.getElementById(id_div).style.top=y+'px';
        document.getElementById(id_div).style.width=obj.offsetWidth+'px';
        document.getElementById(id_div).style.display="";
        document.getElementById(id_div).innerHTML="";
        document.getElementById('h_'+obj.id).value=-1;
        html = "<table cellpadding='0' cellspacing='0' style='width:100%;border-left:1px #000000 solid;border-right:1px #000000 solid;border-bottom:1px #000000 solid;'>";
        val = obj.value;
        tab_select=0;
        for(i=0;i<tab.length;i++){
            if(val.length>0){
                ok=0;            
            } else {
                ok=1;
            }
            for(e=0;e<val.length;e++){
                if(val[e]==tab[i][e]){
                    ok=1;
                } else {
                    ok=0;
                    break;
                }
            }
            if(ok==1){
                html+= "<tr><td id=\""+obj.id+"_c_"+tab_select+"\" onclick='document.getElementById(\""+obj.id+"\").value=\""+tab[i]+"\";document.getElementById(\""+id_div+"\").style.display=\"none\";' style='cursor:pointer;'>"+tab[i]+"</td></tr>";
                tab_select++;
            }
        }
        html+="</table>";
        document.getElementById(id_div).innerHTML=html;
    }
}
function print_a(obj){
   out=''; 
   for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }
    alert(out);
}