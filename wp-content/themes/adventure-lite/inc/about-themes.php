<?php
//about theme info
add_action( 'admin_menu', 'adventure_lite_abouttheme' );
function adventure_lite_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'adventure-lite'), esc_html__('About Theme', 'adventure-lite'), 'edit_theme_options', 'adventure_lite_guide', 'adventure_lite_mostrar_guide');   
} 

//guidline for about theme
function adventure_lite_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div class="col-left-area">
			  <?php esc_attr_e('Theme Information', 'adventure-lite'); ?>
		   </div>
          <p><?php esc_attr_e('Adventure Lite WordPress theme can be used for adventure, sports, hiking, trekking, railing, rafting, games, fun, elking, hunting, military, mountain climbing, skiing, surfing and other such adventure sports. Also can be used for tours and travels, camping, hotel, students, summer camps, skating, motels, service industry, and other corporate, business, photography and personal portfolio websites. Is simple, flexible and multipurpose with having multi industry use. It is compatible with WooCommerce, and other popular plugins. It is also page builder plugin compatible and multilingual plugins compatible as well.','adventure-lite'); ?></p>
		  <a href="<?php echo ADVENTURE_LITE_SKTTHEMES_PRO_THEME_URL; ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	<div class="col-right">			
			<div class="centerbold">
				<hr />
				<a href="<?php echo ADVENTURE_LITE_SKTTHEMES_LIVE_DEMO; ?>" target="_blank"><?php esc_attr_e('Live Demo', 'adventure-lite'); ?></a> | 
				<a href="<?php echo ADVENTURE_LITE_SKTTHEMES_PRO_THEME_URL; ?>"><?php esc_attr_e('Buy Pro', 'adventure-lite'); ?></a> | 
				<a href="<?php echo ADVENTURE_LITE_SKTTHEMES_THEME_DOC; ?>" target="_blank"><?php esc_attr_e('Documentation', 'adventure-lite'); ?></a>
                <div class="space5"></div>
				<hr />                
                <a href="<?php echo ADVENTURE_LITE_SKTTHEMES_THEMES; ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>