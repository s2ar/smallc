<article>
<?php echo $this->msg;?>
<h2>User<h2>

    <form id="form2" action="response.json" method="post" enctype="multipart/form-data">
        <input type="file" name="file" onchange="new SRAX.Uploader('form2', startCallback, finishCallback, true)" />
    </form>

    <script type="text/javascript">
        function id(val){
            return document.getElementById(val);
        }
        function startCallback(){
          id('response').innerHTML = 'start callback';     
        }
        function finishCallback(text){
         id('response').innerHTML = text; 
        }
    </script>  
 <div id='response'></div>
</article>