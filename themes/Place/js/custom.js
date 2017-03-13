var $j = jQuery.noConflict();

$j(document).ready(function(){ 
	
	//Place holder for input, textarea
	$j('input, textarea').placeholder();
	
	//Autoresize Video
	if(jQuery().fitVids) {
		$j(".fit").fitVids();
	}
	
	// Scroll to top
	$j(function () {
		var scrolling_top = 0;
		var scrolling_bottom = 0;
		$j(window).scroll(function () {
			if ($j(this).scrollTop() < 100) {
				if(scrolling_top == 0){
					scrolling_top = 1;
					
					$j('#toTop').animate({"bottom": '0' }, 200,function(){
						scrolling_top = 0;
					});
					
				}
			} else if($j(this).scrollTop() > 100) {
				if(scrolling_bottom == 0){
					scrolling_bottom = 1;
					$j('#toTop').animate({"bottom": '50px' }, 200,function(){
						scrolling_bottom = 0;
					});
				}
			}
		});

		// scroll body to 0px on click
		$j('#toTop a').click(function () {
			$j('body,html').animate({scrollTop: 0}, 800);
			return false;
		});
	});
	
	
	// Menu
	$j('ul.sf-menu').superfish({
		animation: {opacity:'show'},
		speed: 200,
		delay: 10,
		animation:   {opacity:'show',height:'show'}
	
	});
	$j('#top_menu ul.sf-menu').mobileMenu({
		defaultText: 'Navigation ...',
		className: 'select_menu',
		subMenuDash: '&ndash;'
	});
	
	// Navigation style in Mobile
	$j('select.select_menu').each(function(){
		var title = $j(this).attr('title');
		if( $j('option:selected', this).val() != ''  ) title = jQuery('option:selected',this).text();
		$j(this)
			.css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
			.after('<span class="nav_select">' + title + '<span class="menu_icon"></span></span>')
			.change(function(){
				val = $jj('option:selected',this).text();
				$j(this).next().text(val);
			});
	});
	
	
	// Search
 	$j('.search_btn').click(function () {
     $j(this).toggleClass("close");
	  $j('.search_box').toggleClass('show');	
    });
	
	// Thumb hover
	if ( $j( '.thumb_hover' ).length && jQuery() ) {
		thumb_hover('.thumb_hover');
	}

	

	/** POSTS ELEMENTS
	-------------------------------------------- **/
	
	/** Tabs **/
	if($j('.tabs-container').length) {	
		$j('.tabs-container').each(function() {
			
			var tabs=$j(this);
		
			//show first pane
			tabs.find('.tab_pane').hide();
			tabs.find('.tab_panes .tab_pane:eq(0)').show();			
			tabs.find('ul.tabs li:first-child').addClass('active');
			
			tabs.find('ul.tabs li').click(function() {
				//set active state to tab
				tabs.find('ul.tabs li').removeClass('active');
				$j(this).addClass('active');
				
				//show current tab
				tabs.find('.tab_pane').hide();
				tabs.find('.tab_pane:eq('+$j(this).index()+')').fadeIn();			
			});
		});	
	}
	
	/** Accordion **/
	if($j('.accordion').length) {
		$j("ul.accordion li").each(function(){
			$j(this).children(".accordion_content").css('height', function(){ 
				return $j(this).height(); 
			});
			
			if($j(this).index() > 0){
				$j(this).children(".accordion_content").css('display','none');
			}else{
				$j(this).find(".accordion_head").addClass('active');
			}
			
			$j(this).children(".accordion_head").bind("click", function(){
				$j(this).addClass(function(){
					if($j(this).hasClass("active")) return "";
					return "active";
				});
				$j(this).siblings(".accordion_content").slideDown();
				$j(this).parent().siblings("li").children(".accordion_content").slideUp();
				$j(this).parent().siblings("li").find(".active").removeClass("active");
			});
		});
	}
	
	
	theme_init();

	$j('.social_inner a').attr('target', '_blank');
	$j('.social_share a').attr('target', '_blank');
	$j('.bio_sc a').attr('target', '_blank');
});

// Thumb hover
function thumb_hover($wrapp) {
	if ( $j( $wrapp ).length && jQuery() ) {
		$j($wrapp).hover(function() {
		$j(this).find('.img_wrapper img').animate({opacity: 0.4}, 300);			 
		$j(this).find('.for_link').stop(0,0).removeAttr('style');
		$j(this).find('.for_view').stop(0,0).removeAttr('style');
		$j(this).find('.for_link').animate({"top": "50%" }, 500);
		$j(this).find('.for_view').animate({"top": "50%" }, 500);
		}, function() {
			$j(this).find('.for_link').stop(0,0).animate({"top": "120%"}, 500);
			$j(this).find('.for_view').stop(0,0).animate({"top": "-30%"}, 500);
			$j(this).find('.img_wrapper img').animate({opacity: 1}, 300);	
		});
	}
}

// Theme init
function theme_init (){
	
	//$j("a.fancybox").fancybox();
	if ( $j( 'a.fancybox' ).length && jQuery() ) {
		$j("a.fancybox").fancybox();
	}
	
	// Start audio, video player
	$j('audio,video').mediaelementplayer({
		audioWidth: '100%',
		features: ['playpause','progress','current','volume']
	});
	
	//Autoresize Video
	if(jQuery().fitVids) {
		$j(".fit").fitVids();
	}
	
	/** Like this **/
	function reloadLikes(who) {
		var text = $j("#" + who).text();
		var patt= /(\d)+/;
		
		var num = patt.exec(text);
		num[0]++;
		text = text.replace(patt,num[0]);
		if(num[0] == 1) {
			text = text.replace('people like','person likes');
		} else if(num[0] == 2) {
			text = text.replace('person likes','people like');
		} //elseif
		$j("#" + who).text(text);
	} //reloadLikes
	
	
	$j(".likeThis").click(function() {
		var classes = $j(this).attr("class");
		classes = classes.split(" ");
		
		if(classes[1] == "done") {
			return false;
		}
		var classes = $j(this).addClass("done");
		var id = $j(this).attr("id");
		id = id.split("like-");
		$j.ajax({
		  type: "POST",
		  url: "index.php",
		  data: "likepost=" + id[1],
		  success: reloadLikes("like-" + id[1])
		}); 
		
		
		return false;
	});
}