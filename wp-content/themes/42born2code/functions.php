<?php

add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Main Menu' ),
		));
}

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 200, 150, true ); // Normal post thumbnails

add_custom_background();

// Custom comment listing
function wpbx_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	$commenter = get_comment_author_link();
	if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
		$commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
	} else {
		$commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
	}
	$avatar_email = get_comment_author_email();
    $avatarURL = get_bloginfo('template_directory');
	$avatar = str_replace( "class='avatar", "class='avatar", get_avatar( $avatar_email, 40, $default = $avatarURL . '/images/gravatar-blank.jpg' ) );
?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<div id="div-comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo $avatar . ' <span class="fn n">' . $commenter . '</span>'; ?>
			</div>
			<div class="comment-meta">
				<?php printf(__('%1$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'wpbx'),
					get_comment_date('j M Y', '', '', false),
					get_comment_time(),
					'#comment-' . get_comment_ID() );
					edit_comment_link(__('Edit', 'wpbx'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>');
				?>
				<span class="reply-link">
					<span class="meta-sep">|</span> <?php comment_reply_link(array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</span>
			</div>

			<?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'wpbx') ?>

			<div class="comment-content"><?php comment_text() ?></div>
		</div>
<?php
}
// wpbx_comment()

// For category lists on category archives: Returns other categories except the current one (redundant)
function wpbx_cat_also_in($glue) {
	$current_cat = single_cat_title( '', false );
	$separator = "\n";
	$cats = explode( $separator, get_the_category_list($separator) );
	foreach ( $cats as $i => $str ) {
		if ( strstr( $str, ">$current_cat<" ) ) {
			unset($cats[$i]);
			break;
		}
	}
	if ( empty($cats) )
		return false;

	return trim(join( $glue, $cats ));
}

// For tag lists on tag archives: Returns other tags except the current one (redundant)
function wpbx_tag_also_in($glue) {
	$current_tag = single_tag_title( '', '',  false );
	$separator = "\n";
	$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
	foreach ( $tags as $i => $str ) {
		if ( strstr( $str, ">$current_tag<" ) ) {
			unset($tags[$i]);
			break;
		}
	}
	if ( empty($tags) )
		return false;

	return trim(join( $glue, $tags ));
}

// Generate custom excerpt length
function wpbx_excerpt_length($length) {
	return 75;
}
add_filter('excerpt_length', 'wpbx_excerpt_length');


// Add post type

function wpm_custom_post_type() {

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x( 'Room', 'Post Type General Name'),
		// Le nom au singulier
		'singular_name'       => _x( 'Room', 'Post Type Singular Name'),
		// Le libellé affiché dans le menu
		'menu_name'           => __( 'Room'),
		// Les différents libellés de l'administration
		'all_items'           => __( 'Toutes les Room'),
		'view_item'           => __( 'Voir les Room'),
		'add_new_item'        => __( 'Ajouter une nouvelle Room'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer la Room'),
		'update_item'         => __( 'Modifier la Room'),
		'search_items'        => __( 'Rechercher Room'),
		'not_found'           => __( 'Non trouvée'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
	);
	
	// On peut définir ici d'autres options pour notre custom post type
	
	$args = array(
		//'label'               => __( 'Room'),
		//'description'         => __( 'Tous sur séries TV'),
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		/* 
		* Différentes options supplémentaires
		*/	
		//'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		//'rewrite'			  => array( 'slug' => 'Room'),

	);
	
	// On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
	register_post_type( 'seriestv', $args );
	register_taxonomy(
	'location',
	'seriestv',
	array(
		'label' => 'Location',
		'labels' => array(
			'name' => 'Location',
			'singular_name' => 'Location',
			'all_items' => 'Tous les Location',
			'edit_item' => 'Éditer le Location',
			'view_item' => 'Voir le Location',
			'update_item' => 'Mettre à jour le Location',
			'add_new_item' => 'Ajouter un Location',
			'new_item_name' => 'Nouveau Location',
			'search_items' => 'Rechercher parmi les Location',
			'popular_items' => 'Location les plus utilisés'
			),
		'hierarchical' => true
		)
	);
	
	register_taxonomy_for_object_type( 'location', 'seriestv' );

}
//

// Widgets plugin: intializes the plugin after the widgets above have passed snuff
function wpbx_widgets_init() {
	if ( !function_exists('register_sidebars') ) {
		return;
	}
	// Formats the theme widgets, adding readability-improving whitespace
	$p = array(
		'before_widget'  =>   '<li id="%1$s" class="widget %2$s">',
		'after_widget'   =>   "</li>\n",
		'before_title'   =>   '<h3 class="widget-title">',
		'after_title'    =>   "</h3>\n"
	);
	register_sidebars( 1, $p );
	register_sidebar( array(
	'name' => 'Footer',
	'id' => 'footer-sidebar-1',
	'description' => 'Appears in the footer area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );
} // ici on ferme la fonction function wpbx_widgets_init()


function add_login_logout_link($items, $args) {
       ob_start();
       wp_loginout('index.php');
       $loginoutlink = ob_get_contents();
       ob_end_clean();
       $items .= '<li class="annonce_button"><a href="#">Ajouter une annonce</a></li>';
       $items .= '<li class="login_button">'. $loginoutlink .'</li>';
       
       return $items;
}

// add meta box

function initialisation_metaboxes(){
  //on utilise la fonction add_metabox() pour initialiser une metabox
  add_meta_box('id_prix', 'Prix par nuit', 'ft_prix_par_nuit', 'seriestv', 'side', 'high');
  add_meta_box('id_property', 'Type de propriete', 'ft_property', 'seriestv', 'side', 'high');
  // add_meta_box('id_equipement', 'Equipements', 'ft_equipement', 'seriestv', 'side', 'high');
  add_meta_box('conditionnement_vin', 'Conditionnements disponnibles pour ce vin', 'conditionnement_vin', 'seriestv', 'side', 'high');
}
function ft_property($post)
{
	$dispo = get_post_meta($post->ID,'_dispo_produit',true);
	echo '<label for="dispo_meta">Type de propriété :</label>';
	echo '<select name="dispo_produit">';
	echo '<option ' . selected( 'Maison', $dispo, false ) . ' value="Maison">Maison</option>';
	echo '<option ' . selected( 'Appartement', $dispo, false ) . ' value="Appartement">Appartement</option>';
	echo '</select>';
}

// build meta box, and get meta
function ft_prix_par_nuit($post){
  // on récupère la valeur actuelle pour la mettre dans le champ
  $val = get_post_meta($post->ID,'valeur_prix',true);
  echo '<label for="price">Prix par nuit : </label>';
  echo '<input id="price" type="number" name="price" value="'.$val.'" />';
}

function check($cible,$test){
  if(in_array($test,$cible)){return ' checked="checked" ';}
}
function conditionnement_vin($post){
  $cond = get_post_meta($post->ID,'_conditionnement_vin',false);
  echo 'Equipements :</br>';
  echo '<label><input type="checkbox" ' . check( $cond, 5 ) . ' name="cond[]" value="5" />Cuisine</label></br>';
  echo '<label><input type="checkbox" ' . check( $cond, 35 ) . ' name="cond[]" value="35" />Chauffage</label></br>';
  echo '<label><input type="checkbox" ' . check( $cond, 37 ) . ' name="cond[]" value="37" />Internet</label></br>';
}

// save meta box with update

function save_metaboxes($post_ID){
  // si la metabox est définie, on sauvegarde sa valeur
  if(isset($_POST['price'])){
    update_post_meta($post_ID,'valeur_prix', esc_html($_POST['price']));
  }
  if(isset($_POST['dispo_produit'])){
    update_post_meta($post_ID,'_dispo_produit', esc_html($_POST['dispo_produit']));
  }
  if(isset($_POST['cond'])){
    // je supprime toutes les entrées pour cette meta
    delete_post_meta($post_ID, '_conditionnement_vin');
    // et pour chaque conditionnement coché, j'ajoute une metadonnée
    foreach($_POST['cond'] as $c){
      add_post_meta($post_ID, '_conditionnement_vin', intval($c) );
    }
  }
}

//

// add_action( 'init', 'register_cpt_produit' );

// function register_cpt_produit() {

//     $labels = array( 
//         'name' => _x( 'Location', 'location' ),
//         'singular_name' => _x( 'location', 'location' ),
//         'add_new' => _x( 'Ajouter', 'location' ),
//         'add_new_item' => _x( 'Ajouter un location', 'location' ),
//         'edit_item' => _x( 'Editer un location', 'location' ),
//         'new_item' => _x( 'Nouveau location', 'location' ),
//         'view_item' => _x( 'Voir le location', 'location' ),
//         'search_items' => _x( 'Rechercher un location', 'location' ),
//         'not_found' => _x( 'Aucun location trouvé', 'location' ),
//         'not_found_in_trash' => _x( 'Aucun location dans la corbeille', 'location' ),
//         'parent_item_colon' => _x( 'location parent :', 'location' ),
//         'menu_name' => _x( 'locations', 'location' ),
//     );

//     $args = array( 
//         'labels' => $labels,
//         'hierarchical' => false,
//         'description' => 'Location',
//         'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'revisions' ),
//         'taxonomies' => array( 'category', 'post_tag' ),
//         'public' => true,
//         'show_ui' => true,
//         'show_in_menu' => true,
//         'menu_position' => 5,

//         'show_in_nav_menus' => true,
//         'publicly_queryable' => true,
//         'exclude_from_search' => false,
//         'has_archive' => true,
//         'query_var' => true,
//         'can_export' => true,
//         'rewrite' => true,
//         'capability_type' => 'post'
//     );

//     register_post_type( 'produit', $args );
// }

// Runs our code at the end to check that everything needed has loaded
add_action( 'init', 'wpbx_widgets_init' );
add_action( 'init', 'wpm_custom_post_type', 0 );
add_action('add_meta_boxes','initialisation_metaboxes');
add_action('save_post','save_metaboxes');

// Adds filters for the description/meta content
add_filter( 'archive_meta', 'wptexturize' );
add_filter( 'archive_meta', 'convert_smilies' );
add_filter( 'archive_meta', 'convert_chars' );
add_filter( 'archive_meta', 'wpautop' );
add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);

// Translate, if applicable
load_theme_textdomain('wpbx');


// Construct the WordPress header
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'next_post_rel_link');
remove_action('wp_head', 'previous_post_rel_link');