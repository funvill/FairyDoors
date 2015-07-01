<?php require_once('settings.php') ; ?>
<div style='margin-bottom: 80px;' ></div>
<div class='page'>
  <div class="container">
    <div class='col-md-12'>
      <h1><?php echo $page['data']['name'] ; ?></h1>
      <p><?php echo $page['data']['body'] ; ?></p>
    </div>
  </div>

  <div class="container">
    <!-- disqus thread.-->
    <div id="disqus_thread"></div>
  </div>

  <script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname  = '<?php echo DISQUS_SHORTNAME ; ?>';
    var disqus_identifier = '<?php echo $page['data']['slug'] ; ?>';

    /*** DON'T EDIT BELOW THIS LINE ***/
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    }());
  </script>
</div>
