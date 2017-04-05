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
define('DB_NAME', 'lootr');

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
define('AUTH_KEY',         'lL|kDG:s&@#^;<sy)_P~)x5}P|c1jTCS$!W4;(mw]]MTw1Y*D7!.~Z{+fT RW.{@');
define('SECURE_AUTH_KEY',  'r.l/<r1IEhPL2t.Qmh2lzKk^b>jmED5[R?&5O;4R5jy-,Z3A+1<r*Npj)LU`8WQI');
define('LOGGED_IN_KEY',    'X8,eCi_R._XG$4LUy@`!Dp(7hQEDMv$Z&&7{)aw6$FrC@W=k2S&MEA/z @{->uCj');
define('NONCE_KEY',        '+--zEsE/<Ten.OpB}3Q[#b CsVtW5+68Ul)xEwDgS5UNr+]JUOO9t5dc^(Wp)wV]');
define('AUTH_SALT',        'OhZ+?D&t%QyqzC4n/0wIE$4CXSb:$bUEOm.ZC-YPz,Q}B}F8h^p9u,eb 0:XhVmP');
define('SECURE_AUTH_SALT', '|3$DBw&P)C}DD&.2:ahngeLzBuUDnD_Ba@t7Y|t@.y)%s!AW<R-s%XGPxzO2a_&-');
define('LOGGED_IN_SALT',   '%|e[zAB@Rgv2+,B^3j|R6v(?R^l.gss>5}oA]tT3BR kKA.~Kk|vgHLa#XH<892)');
define('NONCE_SALT',       'x}.J8*pB15d0G|zH%pF4#{G_G~h0LTc{<)u{[OqQZ:;j6(.tKmANPeR~gaCD@=Z[');
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