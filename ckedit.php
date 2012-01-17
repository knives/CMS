<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<body>
 <textarea id="text_r1" name="text_r1" style="background-color: #ffb"></textarea>
<br />
<script>
    var editor = CKEDITOR.replace( 'text_r1',{
        filebrowserBrowseUrl : 'filemanager/index.html'        
    })
    //CKEDITOR.config.contentsCss = '/image/Style.css' ;
</script>
