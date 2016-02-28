<?php
namespace ObservantRecords\WordPress\Plugins\ArtistConnector;
?>
<div class="wrap obrc-meta">
	<h2>Observant Records Artist Connector Settings</h2>
	<form method="post" action="options.php">
		<?php settings_fields( WP_PLUGIN_DOMAIN . '-group' ); ?>

		<?php do_settings_sections( WP_PLUGIN_DOMAIN ); ?>

		<?php submit_button(); ?>
	</form>
</div>