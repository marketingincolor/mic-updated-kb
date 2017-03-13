<?php global $theme_url, $pl_data ;?>
</div>
</div><!-- #main -->
<div id="footer">
		<div class="container clearfix">
			<div class="ft_left">&copy; <?php echo date('Y'); ?>  <a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a> | <?php bloginfo('description'); ?></div>
			<div class="ft_right"><?php echo stripslashes($pl_data['footer_text']); ?></div>
			<div class="clear"></div>
		</div>
	</div>
	<!-- #footer -->
	<?php if($pl_data['switcher']=='yes') include ('_switcher/index.php');?>  
	<div id="toTop"><a href="#"><?php _e('TOP','presslayer');?></a></div>	
	<?php echo stripslashes($pl_data['google_analytics']); ?>
<script type="text/javascript"> 
adroll_adv_id = "A664VFUB7VHYLPKRJUXIFX"; 
adroll_pix_id = "VISUUKS2QJHN5II4E3VILO"; 
(function () { 
var oldonload = window.onload; 
window.onload = function(){ 
   __adroll_loaded=true; 
   var scr = document.createElement("script"); 
   var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com"); 
   scr.setAttribute('async', 'true'); 
   scr.type = "text/javascript"; 
   scr.src = host + "/j/roundtrip.js"; 
   ((document.getElementsByTagName('head') || [null])[0] || 
    document.getElementsByTagName('script')[0].parentNode).appendChild(scr); 
   if(oldonload){oldonload()}}; 
}()); 
</script> 

	<?php wp_footer();?>	

</body>
</html>