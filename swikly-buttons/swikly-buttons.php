<?php
/**
 * @package swikly-buttons
 * @version 1.0.0
 */
/*
Plugin Name: Swikly Buttons
Plugin URI: -
Description: Thanks to this plugin, you can create buttons redirecting to swikly forms easily.
Author: Pedro Cristino
Version: 1.0.0
Author URI: https://www.linkedin.com/in/pedro-cristino/
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


const PLUGIN_NAME = "Swikly Buttons";

add_action("wp_footer", "createButton");
add_action('wp_enqueue_scripts','initSwiklyButtonsJavascript');
add_action('admin_menu', 'addAdminMenu' );
add_action('admin_init', 'update_swikly_buttons_info' );
add_shortcode("swikly-button", "swiklyShortcode");


function addAdminMenu()
{
      add_menu_page(
        PLUGIN_NAME . " administration page", 
        PLUGIN_NAME, 
        'manage_options', 
		'swikly-buttons/includes/adminPage.php', 
		'',
		'dashicons-media-spreadsheet'
    );
}

function update_swikly_buttons_info() {
	register_setting( 'swikly_buttons_settings', 'swikly_user_id' );
	register_setting( 'swikly_buttons_settings', 'swikly_link_id' );
	register_setting( 'swikly_buttons_settings', 'swikly_secret' );
	register_setting( 'swikly_buttons_settings', 'swikly_forced_client_fee' );
	register_setting( 'swikly_buttons_settings', 'swikly_button_text' );
	register_setting( 'swikly_buttons_settings', 'swikly_button_class' );
	register_setting( 'swikly_buttons_settings', 'swikly_displayed_on_cart' );
	register_setting( 'swikly_buttons_settings', 'swikly_form_description' );
  }

function swiklyShortcode($atts, $content, $tag){
	if($atts == null || !array_key_exists("montant",$atts))
	{
		return;
	}
	$message = isset($atts["description"]) ?
					$atts["description"] :
					(get_option("swikly_form_description") == "" ? "button" : get_option("swikly_form_description"));
	$montant = $atts["montant"];
	$classe = isset($atts["class"]) ? 
				$atts["class"] : 
				(get_option("swikly_button_class") == "" ? "button" : get_option("swikly_button_class"));
	$texte =  $content == "" ? (get_option("swikly_button_text") == "" ? "Créer formulaire" : get_option("swikly_button_text")) : $content;
	return "<a class='".$classe."' href='".generateFormUrl($message,$montant)."'>".$texte ."</a>";
}
function initSwiklyButtonsJavascript() {
    wp_enqueue_script( 'script', plugins_url( '/includes/js/swikly-buttons.js', __FILE__ ));
}

function createButton() {
	if (wc_get_page_id( 'cart' ) == get_the_ID()) {
		
		global $woocommerce;
		$total = $woocommerce->cart->cart_contents_total; 	
		
		$classe = get_option("swikly_button_class") == "" ? "button" : get_option("swikly_button_class");
		$texte =  get_option("swikly_button_text") == "" ? "Créer formulaire" : get_option("swikly_button_text");
		$url = generateFormUrl("",$total);
		echo "<script>addButton('".$texte."','".$classe."','". $url ."')</script>";
	}
}

function generateFormUrl($message,$amountPayment){

	$baseUrl = "https://www.swikly.com/checkout/";
	
	$description = $message == "" ? urlencode(get_option('swikly_form_description')) : urlencode($message);
	$linkId = get_option("swikly_link_id");
	$userId = get_option("swikly_user_id");
	$amountDeposit = "0";
	$amountPayment=$amountPayment*100;
	$amountReservation="0";

	$forcedClientFee = get_option("swikly_forced_client_fee");
	$cityTax = "";
	$freeText = "";

	$ctrlKey = generateCtrlKey($forcedClientFee,
					$amountDeposit,
					$amountReservation,
					$amountPayment,
					$cityTax,
					$userId,
					$linkId,
					$freeText);
	
	return $baseUrl . "?" .
	"description=" . $description . "&" .
	"linkId=" . $linkId . "&" .
	"userId=" . $userId . "&" .
	"amountDeposit=" . $amountDeposit . "&" .
	"ctrlKey=" . $ctrlKey . "&" .
	"amountPayment=" . $amountPayment . "&" .
	"amountReservation=" . $amountReservation;
}

function generateCtrlKey($forcedClientFee,$amountDeposit,$amountReservation,$amountPayment,$cityTax,$userId,$linkId,$freeText){
	$secret = get_option("swikly_secret");
	$key = $forcedClientFee .
	 $amountDeposit . 
	 $amountReservation . 
	 $amountPayment . 
	 $cityTax . 
	 $userId . 
	 $linkId . 
	 $freeText . 
	 $secret;


	 //https://www.swikly.com/checkout/?description=bonjour&linkId=85n7bonuh17hsg8p2rvnvwc6ehk6m94t&userId=d8175f561cf52349aaf37d6bf06d549d&amountDeposit=0&ctrlKey=57edd1a083c11914f3c79519cad0b50f52e37da4f8bd74d49316a987050a160e&amountPayment=5000&amountReservation=0
	 //https://www.swikly.com/checkout/?description=bonjour&linkId=85n7bonuh17hsg8p2rvnvwc6ehk6m94t&userId=d8175f561cf52349aaf37d6bf06d549d&amountDeposit=0&ctrlKey=2839b6770577537c88c3f49a5214d82095ebd7ba915ee811e7c4eb90bec0bf64&amountPayment=5000&amountReservation=0
	return hash("sha256",$key);
}

?>
