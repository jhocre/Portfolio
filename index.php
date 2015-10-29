<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-69332640-1', 'auto');
  ga('send', 'pageview');
</script>

<?php

$http_lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
   
if ($http_lang = 'fr'){
	require "fr/index.php";
}else{
	require "en/index.php";
}

?>

