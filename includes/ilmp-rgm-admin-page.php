<div class="wrap" id="ilmp-wrap">
	<h2>ILMP Responsive Google Map</h2>
	<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<?php 
		if (isset($_POST["ilmp-hidden"])) {
			update_option('ilmp_infow', nl2br($_POST['ilmp-infow']));
			update_option('ilmp_infoh', nl2br($_POST['ilmp-infoh']));
			update_option('ilmp_title', $_POST['ilmp-title']);
			update_option('ilmp_address', nl2br($_POST['ilmp-address']));
			update_option('ilmp_addinfo', nl2br($_POST['ilmp-addinfo']));
			update_option('ilmp_zoom', $_POST['ilmp-zoom']);
			update_option('ilmp_map_link', $_POST['ilmp-link']);
			update_option('ilmp_width', $_POST['ilmp-width']);
			update_option('ilmp_height', $_POST['ilmp-height']);
			update_option('ilmp_resp', $_POST['ilmp-resp']);
			update_option('ilmp_maptype', $_POST['ilmp-mt']);
			update_option('ilmp_ptc', $_POST['ilmp-ptc']);
			update_option('ilmp_ptcs', $_POST['ilmp-ptcs']);

			$ilmp_address = json_encode(get_option('ilmp_address'));
			?>
			<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
			<script>
				var ILMP_DIR = <?php echo json_encode(ILMP_DIR); ?>;
				var ilmpAddress = <?php echo $ilmp_address; ?>;
				geocoder = new google.maps.Geocoder();
				geocoder.geocode( { 'address': ilmpAddress}, function(results, status) {
					$.post( ILMP_DIR + "/includes/ilmp-rgm-update.php", { ilmpLat : results[0].geometry.location.lat(), ilmpLng : results[0].geometry.location.lng() } );
				});
           		
			</script>
			<div class="updated">
				<p>
					<strong><?php _e('Options saved.' ); ?></strong>
				</p>
			</div>
			<?php
		}
		?>
		<p>Place this code on your page <code>[ilmp-rgm]</code> or <code>&lt;&quest;php do_shortcode("[ilmp-rgm]"); &quest;&gt;</code> on your template.</p>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="ilmp-title">Title</label>
					</th>
					<td>
						<input name="ilmp-title" type="text" id="ilmp-title" value="<?php echo get_option('ilmp_title'); ?>" class="regular-text">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ilmp-address">Address</label>
					</th>
					<td>
						<input name="ilmp-address" type="text" id="ilmp-address" value="<?php echo get_option('ilmp_address'); ?>" class="regular-text">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ilmp-addinfo">Additional Information</label>
					</th>
					<td>
						<textarea cols="40" rows="10" name="ilmp-addinfo" id="ilmp-addinfo" class="regular-text"><?php echo str_ireplace(array("<br />","<br>","<br/>"), "", get_option('ilmp_addinfo')); ?></textarea>
						<p class="description">Addition information of your map (e.g. Phone number).</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ilmp-infow">InfoWindow Width</label>
					</th>
					<td>
						<input name="ilmp-infow" type="text" id="ilmp-infow" value="<?php echo get_option('ilmp_infow'); ?>" class="regular-text">
						<p class="description">Default: 100%.</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ilmp-infoh">InfoWindow Height</label>
					</th>
					<td>
						<input name="ilmp-infoh" type="text" id="ilmp-infoh" value="<?php echo get_option('ilmp_infoh'); ?>" class="regular-text">
						<p class="description">Default: 200px.</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ilmp-zoom">Zoom</label>
					</th>
					<td>
						<input name="ilmp-zoom" type="number" step="1" min="1" max="19" id="ilmp-zoom" value="<?php echo get_option('ilmp_zoom'); ?>" class="small-text">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ilmp-link">Link</label>
					</th>
					<td>
						<input name="ilmp-link" type="text" id="ilmp-link" value="<?php echo get_option('ilmp_map_link'); ?>" class="regular-text">
						<p class="description">Link for view larger map.</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ilmp-mt">Map Type</label>
					</th>
					<td>
						<select name="ilmp-mt" id="ilmp-mt">
							<option <?php echo get_option('ilmp_maptype') == "roadmap" ? "selected" : ""; ?> value="roadmap">Roadmap</option>
							<option <?php echo get_option('ilmp_maptype') == "satellite" ? "selected" : ""; ?> value="satellite">Satellite</option>
							<option <?php echo get_option('ilmp_maptype') == "hybrid" ? "selected" : ""; ?> value="hybrid">Hybrid</option>
							<option <?php echo get_option('ilmp_maptype') == "terrain" ? "selected" : ""; ?> value="terrain">Terrain</option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ilmp-width">Width</label>
					</th>
					<td>
						<input name="ilmp-width" type="text" id="ilmp-width" value="<?php echo get_option('ilmp_width'); ?>" class="regular-text">
						<p class="description">Default: 100%.</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ilmp-height">Height</label>
					</th>
					<td>
						<input name="ilmp-height" type="text" id="ilmp-height" value="<?php echo get_option('ilmp_height'); ?>" class="regular-text">
						<p class="description">Default: 300px.</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ilmp-ptcs">Pan to Center</label>
					</th>
					<td>
						<label for="ilmp-ptcs">
							<input type="checkbox" name="ilmp-ptcs" id="ilmp-ptcs" <?php echo get_option('ilmp_ptcs') ? "checked" : "" ; ?>> Force to move the focus on the center of the map.
						</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ilmp-ptc">Seconds</label>
					</th>
					<td>
						<input name="ilmp-ptc" type="text" id="ilmp-ptc" value="<?php echo get_option('ilmp_ptc'); ?>" class="small-text">
						<p class="description">1000 = 1s. Default: 3000.</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ilmp-resp">Responsive Width</label>
					</th>
					<td>
						<input name="ilmp-resp" type="text" id="ilmp-resp" value="<?php echo get_option('ilmp_resp'); ?>" class="regular-text">
						<p class="description">Specify the browser's width to trigger responsive style.</p>
					</td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="ilmp-hidden" value="Y">
		<p class="submit">
			<input type="submit" name="Submit" class="button button-primary" value="Save Changes">
		</p>
	</form>

	<?php /*
		echo "<h2>Preview:</h2>";
		do_action('ilmp-rgm');
		require_once('ilmp-rgm-style.php');
		require_once('ilmp-rgm-script.php');
		*/
	?>
</div>