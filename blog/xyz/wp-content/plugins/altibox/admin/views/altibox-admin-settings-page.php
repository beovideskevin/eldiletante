<div id="wrap" class="<?php echo $this->plugin_name ?>">
	<?php
		$plugin = new Altibox_Admin($this->plugin_name, $this->version);
		if( isset($_POST['submit']) && check_admin_referer( 'submit_form', $this->plugin_name . '_nonce' ) ) {
			//$plugin->save_form( $_POST );
			$plugin->generate_js();
		}
		$plugin->display_messages();
	?>
	<h2>CSS Lightbox — Altibox <span><?php _e('by', $this->plugin_name); ?> <a href="http://alticreation.com/en">alticreation.com</a></span></h2>
	<p class="description"><?php _e('Altibox is a lightweight image viewer.', $this->plugin_name); ?></p>
	<div class="altibox-main-container">
			<form method="POST" enctype="multipart/form-data">
			<?php wp_nonce_field( 'submit_form', $this->plugin_name . '_nonce' ); ?>
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row">
								<label for=""><span class="dashicons dashicons-editor-code"></span> <?php _e('CSS Selectors', $this->plugin_name); ?></label>
							</th>
							<td>
								<input type="text" name="altibox_selectors" id="altibox_selectors" style="width:80%;" value='<?php echo $plugin->get_custom_selectors(); ?>'>
								<p class="description"><?php _e('Default is:', $this->plugin_name); ?> <code>a[href$="jpg"], a[href$="jpeg"], a[href$="png"], a[href$="gif"], a[href$="bmp"]</code></p>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for=""><span class="dashicons dashicons-sos"></span> <?php _e('Selector Guidelines', $this->plugin_name); ?></label>
							</th>
							<td>
								<p><?php _e('Adding CSS selectors will trigger the Altibox Image Viewer. You can separate them by a coma.<br> i.e: <code>.altibox, .image, #myid-for-image</code>: This will apply Altibox for any clicked element that have one of the previous CSS selectors. <br> More information on <a href="http://www.w3schools.com/cssref/css_selectors.asp" target="_blank">css selectors</a>', $this->plugin_name); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for=""><span class="dashicons dashicons-sos"></span> <?php _e('Gallery Feature', $this->plugin_name); ?></label>
							</th>
							<td>
								<p><?php _e('For images on a same page you can navigate with arrows between them without leaving the Altibox Image Viewer. <br> To do so, add a same rel attribute to images: <code>rel="gallery1"</code>', $this->plugin_name); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for=""><span class="dashicons dashicons-editor-help"></span> <?php _e('Documentation', $this->plugin_name); ?></label>
							</th>
							<td>
								<p><?php _e('Need help? Check the <a href="http://www.alticreation.com/en/altibox" target="_blank">documentation</a>.', $this->plugin_name); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row">
							</th>
							<td>
								<input type="submit" id="submit" value="<?php _e('Update', $this->plugin_name); ?>" name="submit" class="button button-primary">
							</td>
						</tr>
					</tbody>
				</table>
			</form>

	</div>

	<?php require_once dirname( __FILE__ ) . '/includes/altibox-admin-sidebar.php'; ?>

</div>