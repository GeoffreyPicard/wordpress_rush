<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'db_database');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'U86-%F5f`W1W=BG6XM/$hTZZTjHW0O;flXrc3M>)s4,>0hC]DZY=8}d/Z;(ge%${');
define('SECURE_AUTH_KEY',  'Z;,KOJGwFYZcQQnjT/V p@{XDr+gY;KWwVU4cI*2[Kc6m.%Tv`Q]i`XbeEAAq 93');
define('LOGGED_IN_KEY',    '}1YO0 )=O!R()3pzr-ApQK^9UfqR88ndhGGdSR5JCM-bsy#dLSITuwC]?%zNq9,_');
define('NONCE_KEY',        'A~e<-Dxf)KN|=^%3Lj,VrNg1Gzr+JvlkFdy0#r+Qrt}r1S@b-oab*{Nu%yl5_qWl');
define('AUTH_SALT',        'l9cAS`{qF;7Qana=ai6Zpy@JNWl$BN?Nci3.1]k`<%6o>n@>C=qVfe1x0p7E=( T');
define('SECURE_AUTH_SALT', 'NgvD<xw=Y_ui):In9bmI$=D2R<z 3yFy|uQuJdRyNqUHJ)?F?J0n(~7`LB_>Hc1N');
define('LOGGED_IN_SALT',   '$YZ.:qHz(#wLioTb}}27RxH~;1[i|+<DbE{~/!w<p/4#4 v`Kc$jfP,_Q> g)7AG');
define('NONCE_SALT',       '~$1]H!t^7g4C|+^k/UKs!:zcmNe/)MElN@d]5-7~P2sgNC+v8ThUtJ%K^:6X)gtr');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');