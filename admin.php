<?php
/**
 * Function to create an options page
 */
add_action( 'admin_menu', 'gplus_publisher_page' );

function gplus_publisher_page() {
	$gplus_publisher_admin_hook = add_options_page( 'Gplus Publisher Setting', 'Gplus Publisher', 'manage_options', 'gplus_publisher', 'gplus_publisher_options_page' );
	
	// add CSS styles specific to our options page on our options page only
	add_action( "admin_head-{$gplus_publisher_admin_hook}", 'gplus_publisher_admin_style' );	
}

/**
 * Function to add CSS styles on our Options page
 */
function gplus_publisher_admin_style() {
?>
	<style type="text/css">

	</style>
<?php
}

/**
 * Function to draw the options page
 */
function gplus_publisher_options_page() {
?>
	<div class="wrap">
		<?php screen_icon( 'plugins' ); ?>
		<h2>Gplus Publisher Setting</h2>
		
		<form action="options.php" method="post">
			<?php settings_fields( 'gplus_publisher_options' ); ?>
			<?php do_settings_sections( 'gplus_publisher' ); ?>
			<br />
			<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e( 'Save' ); ?>" />
		</form>
	</div>
<?php	
}

/**
 * WordPress Settings API to save plugin's data
 */
add_action( 'admin_init', 'gplus_publisher_init' );

function gplus_publisher_init() {
	register_setting(
		'gplus_publisher_options',	// same to the settings_field
		'gplus_publisher',		// options name
		'gplus_publisher_validate'	// validation callback
	);
	add_settings_section(
		'default',			// settings section (a setting page must have a default section, since we created a new settings page, we need to create a default section too)
		'Main settings',		// section title
		'gplus_publisher_section_text',		// text for the section
		'gplus_publisher'		// specify the output of this section on the options page, same as in do_settings_section
	);
	add_settings_field(
		'gplus_publisher_id',		// field ID
		'Gplus Page ID',	// Field title
		'gplus_publisher_setting',	// display callback
		'gplus_publisher',		// which settings page?
		'default'			// which settings section?
	);
}

function gplus_publisher_section_text() {
?>
The plugin <strong>puts the required code in the WITHOUT-AUTOR-pages of your blog</strong> (and JUST in them, is it supposed that in the with-autor-pages you have rel="author" and rel="me" codes to relate an author with a Google+ Profile) in order to get a "identified site" in reference to a Google+ Page.<br/>
In Google's words:
<blockquote>Connecting your site to your Google+ page helps you connect with friends, fans, and customers. It also helps Google consolidate +1's from your site and your page, and makes your site eligible for Google+ Direct Connect.</blockquote>
<br/><br/>
<strong>Just locate the ID of your Google+ Page and write it down</strong><br/>
¿Need help? The ID is a big number in the URL of your G+ Page with the format https://plus.google.com/[yourpageID]/ <a href="https://developers.google.com/+/plugins/badge/?hl=es#faq-find-page-id">¿Still need help?</a>)<br/>
You can check if it is working fine <a href="http://www.google.com/webmasters/tools/richsnippets?url=<?php echo home_url(); ?>">here</a>

<?php
}

function gplus_publisher_setting() {
	$options = get_option( 'gplus_publisher' );
	echo "<input id='gplus_publisher_id' name='gplus_publisher[id]' size='30' type='text' value='{$options['id']}' />";
}

function gplus_publisher_validate( $input ) {
	if ( !is_numeric($input['id']) ) {
		add_settings_error(
			'gplus_publisher_id',				// title (?)
			'gplus_publisher_id_url_error',			// error ID (?)
			'Does not looks like a proper Google+ Page ID',	// error message
			'error'						// message type
		);
	}
	return $input;	
}
