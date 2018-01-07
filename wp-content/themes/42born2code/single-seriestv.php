<?php get_header() ?>
<div id="content">
	<?php the_post() ?>
	<div class="entry-single">
		<div class="entry-top">
			<h2 class="entry-title"><?php the_title() ?></h2>
			<div class="entry-meta-top">
				<span class="entry-date"><?php unset($previousday); printf( __( '%1$s', 'wpbx' ), the_date( 'D, j M Y', '', '', false ) ) ?></span>
				<span class="entry-meta-sep">|</span>
				<span class="entry-comm">Publié dans <?php the_category(', '); ?></span>
			</div>
		</div>
		<div class="entry-content clearfix">
			<?php the_content() ?>
		</div>
		<div class="entry-meta entry-bottom">
			<?php the_tags( __( '<span class="tag-links">Tags: ', 'wpbx' ), ", ", "</span>\n" ) ?>
		</div>
		<?php
		$key_1_value = get_post_meta( get_the_ID(), 'valeur_prix', true );
			// Check if the custom field has a value.
		if ( ! empty( $key_1_value ) ) {
    		echo 'Prix par nuit : ' . $key_1_value . '€<br>';
		}
		$key_2_value = get_post_meta( get_the_ID(), '_dispo_produit', true );
			// Check if the custom field has a value.
		if ( ! empty( $key_2_value ) ) {
    		echo 'Propriété: ' . $key_2_value . '<br>';
		}
		$key_3_value = get_post_meta( get_the_ID(), '_conditionnement_vin', false );
			// Check if the custom field has a value.
		$equip = array(
			5 => 'Cuisine',
			35 => 'Chauffage',
			37 => 'Internet'
		);
		if ( ! empty( $key_3_value ) ) {
			echo 'Equipement :<br> ';
			foreach($key_3_value as $c){
      			echo  '- ' . $equip[$c] . '<br>';
    		}
		}
		$ville = wp_get_post_terms( get_the_ID(), 'location', $args ); 
		//print_r($ville);
		echo 'Ville : ' ;
		echo $ville[0]->name;
		?>
	</div><!-- .post -->
	<?php comments_template(); ?>
</div><!-- #content -->
<?php get_footer() ?>