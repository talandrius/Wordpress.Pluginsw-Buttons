<div class="wrap">
<h1>Paramètres de Swikly Buttons</h1>
  
  <hr/>

  
  <form method="post" action="options.php">
	<?php settings_fields( 'swikly_buttons_settings' ); ?>
    <?php do_settings_sections( 'swikly_buttons_settings-buttons-settings' ); ?>
	
	  
  <h3>Style et affichage du bouton</h3>
  <table style="text-align:left;width:35%">
	<tbody>
		<tr>
			<th>Texte par défaut</th>
			<td style="text-align:right"><input type="text" style="width:100%" value="<?php echo get_option( 'swikly_button_text' )  == "" ? "Créer formulaire" : get_option('swikly_button_text'); ?>" name="swikly_button_text" />
			</tr>
		<tr>
			<th>Classe css</th>
			<td style="text-align:right"><input type="text" style="width:100%" value="<?php echo get_option( 'swikly_button_class' )  == "" ? "button" : get_option('swikly_button_class'); ?>" name="swikly_button_class" /></td>
		</tr>
		<tr>
			<th><label for='swikly_displayed_on_cart'>L'afficher sur la page panier</label></th>
			
			<td style="text-align:left">
				<input id="swikly_displayed_on_cart" name="swikly_displayed_on_cart" 
				
				value="1" <?php checked(1, get_option('swikly_displayed_on_cart'), true); ?> type="checkbox" />
			</td>
		</tr>
		<tr>
			<th>Description par défaut <span style="cursor:pointer" onclick="alert('Texte affiché sur le formulaire')">(?)</span></th>
			
			<td style="text-align:left">
				<input id="swikly_form_description" name="swikly_form_description" type="text" value="<?php echo get_option( 'swikly_form_description' )  == "" ? "Exemple" : get_option('swikly_form_description'); ?>" />
			</td>
		</tr>
	</tbody>
  </table>


	
  <h3>Informations Swikly</h3>
	  <table id="tableSwiklyAccount" style="width:50%;text-align:left">
		<tbody>
			<tr>
				<th style="width:25%">User Id *</th>
				<td>
					<input type="text" style="width:100%" name="swikly_user_id" value="<?php echo get_option( 'swikly_user_id' ); ?>"/>
				</td>
			</tr>
			<tr>
				<th>Secret *</th>
				<td>
					<input type="text" style="width:100%" name="swikly_secret" value="<?php echo get_option( 'swikly_secret' ); ?>"/>
				</td>
			</tr>
			<tr>
				<th>Link id *</th>
				<td>
					<input type="text" style="width:100%" name="swikly_link_id" value="<?php echo get_option( 'swikly_link_id' ); ?>"/>
				</td>
			</tr>
			<tr>
				<th>Frais de service client *</th>
				<td>
					<input type="text" style="width:100%" name="swikly_forced_client_fee" value="<?php echo get_option( 'swikly_forced_client_fee' ); ?>"/>
				</td>
			</tr>


			
		</tbody>
	  </table> 
    <?php submit_button(); ?>
  </form>
	<hr />
	<h3>
		Informations relatives au plugin
	</h3>
	<h4>Ou obtenir les informations swikly ?</h4>
	<ul>
		<li><strong>User Id</strong> : Sur swikly, menu "Développeurs"</li>
		<li><strong>Secret</strong> : Sur swikly, menu "Développeurs" </li>
		<li><strong>Link Id</strong> : Pour avoir cet id il faut génerer un lien sur https://lelien.swikly.com</li>
		<li><strong>Frais de service client</strong> : <br/>
		Montant des frais de service client à payer par le client en centimes. <br/> • Si à 0 reporte le ces frais sur la facture Fournisseur <br/> • Si vide, le montant prévu au contrat sera payé par le client lors de l'acceptation du swik.</li> 
	</ul>
	<h4>Shortcode</h4>
	<p>
	Afin de placer un ou plusieurs boutons sur vos pages, vous pouvez utiliser le shortcode suivant :
	<br/>
	[swikly-button description="" montant="" class=""]<br />
		&nbsp;&nbsp;contenu<br />
	[/swikly-button]<br />
	• description : facultatif, prends la valeur renseignée dans le formulaire de paramétrage ci dessus par défaut <br />
	&nbsp;&nbsp;&nbsp; <i>Description affichée dans le formulaire généré</i> <br/>
	• montant : <strong>obligatoire</strong>, si ce n'est pas renseigné le bouton ne sera pas affiché. Format : 00,00 <br />
	• class : facultatif, classe css du bouton, par défaut prends la valeur renseignée ci-dessus
	</p>


  <script type="text/javascript">
	function detailsForcedFees() {
		var details = "Montant des frais de service client à payer par le client en centimes. \n Si à 0 reporte le ces frais sur la facture Fournisseur \n Si vide, le montant prévu au contrat sera payé par le client lors de l'acceptation du swik.";
			
		alert(details);
	}
	</script>
 
</div>