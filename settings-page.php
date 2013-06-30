<?php
gp_title( sprintf( __('%s &lt; GlotPress'), __('Google Analytics') ) );

gp_breadcrumb( array(
	__('Google Analytics'),
) );

gp_tmpl_header();
?>

<h2><?php _e('Google Analytics'); ?></h2>


<form action="" method="post">
	<dl>
		<h4><?php _e( 'Settings' ); ?></h4>

		<dt><label for="trackingscode"><?php _e( 'Trackings code' ); ?></label></dt>
		<dd>
			<input type="text" name="trackingscode" value="<?php echo $trackingscode; ?>" id="trackingscode">
		</dd>
	</dl>

	<p>
		<input type="submit" name="update" value="<?php _e( 'Save' ); ?>" id="submit">
		<span class="or-cancel">
			or <a href="javascript:history.back();"><?php _e( 'Cancel' ); ?></a>
		</span>
	</p>
</form>


<?php gp_tmpl_footer();
