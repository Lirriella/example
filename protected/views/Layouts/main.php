<!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
      <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="language" content="ru" />
      <link rel="stylesheet" type="text/css" href="/css/main.css" />
       <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
       <script type="text/javascript" src="/js/main.js"></script>

    </head>

    <body>
     
        <div class='container'>
            <div class='header'></div>
            <div class='mainmenu'><?php echo Site::getMainMenu();?></div>
            <?php if ($book->notice)
            {?>
              <div class='notice'><?php echo $book->notice;?></div>
            <?php }?>
            <div class='content'><?php echo $this->getViewText();?></div>
        </div>
    
        <div class="clear"></div>
        <div class="footer">(c)Елена (skype - Lirriella)</div>
	    
    </body>
</html>