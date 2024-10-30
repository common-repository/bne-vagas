<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           BNE
 *
 * @wordpress-plugin
 * Plugin Name:       BNE - Vagas
 * Plugin URI:        https://www.bne.com.br/bne-vagas
 * Description:       Ofereça milhares de vagas de emprego atualizadas diariamente em seu site Wordpress. Publique anúncios de ofertas de emprego catalogadas por área com um filtro de pesquisa simples e eficiente. Assim que encontrar uma vaga de interesse, o usuário será redirecionado para o site do BNE (Banco Nacional de Empregos) para o cadastro do currículo e poderá candidatar-se à vaga escolhida de imediato.
 * Version:           1.0.0
 * Author:            BNE - Banco Nacional de Empregos
 * Author URI:        https://www.bne.com.br/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bne
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bne-activator.php
 */
function activate_BNE() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bne-activator.php';
	BNE_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bne-deactivator.php
 */
function deactivate_BNE() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bne-deactivator.php';
	BNE_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_BNE' );
register_deactivation_hook( __FILE__, 'deactivate_BNE' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bne.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_BNE() {

	$plugin = new BNE();
	$plugin->run();

}
run_BNE();
