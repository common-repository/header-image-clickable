<?php
/**
 * Include all logic files here.
 */

// Add options in header image section to add link and target check box
add_action( 'customize_register', 'Header_Image_Clickable_customize_register' );
function Header_Image_Clickable_customize_register( $wp_customize ) {
	
	$wp_customize->add_setting( 'htc_link_setting_id', array(
		'type' => 'option',
		'capability' => 'manage_options',
		'default' => home_url(),
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'htc_link_setting_id', array(
		'type' => 'text',
		'priority' => 50,
		'section' => 'header_image',
		'label' => __( 'Link', 'header-image-clickable' ),
		'description' => __( 'Header image link.', 'header-image-clickable' ),
		'active_callback' => 'has_header_image',
	) );

	$wp_customize->add_setting( 'htc_link_target_setting_id', array(
		'type' => 'option',
		'capability' => 'manage_options',
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'htc_link_target_setting_id', array(
		'type' => 'checkbox',
		'priority' => 51,
		'section' => 'header_image',
		'label' => __( 'Link Target', 'header-image-clickable' ),
		'description' => __( 'Open link in new tab?', 'header-image-clickable' ),
		'active_callback' => 'has_header_image',
	) );

}

// Modify the get_header_image_tag HTML
add_filter( 'get_header_image_tag', 'Header_Image_Clickable_get_header_image_tag', 10, 1 );
function Header_Image_Clickable_get_header_image_tag( $html ) {

	$link = esc_url( get_option( 'htc_link_setting_id', home_url() ) );

	// Return original HTML, if the link is empty.
	if( empty( $link ) ) {
		return $html;
	}

	$link_target = esc_html( get_option( 'htc_link_target_setting_id', '0' ) );

	if( $link_target == 1 ) {
		$last_link_target = 'target="_blank"';
	} else {
		$last_link_target = '';
	}


	$pre_replaced = '<a ' . $last_link_target . ' href="' . $link . '"><img';

	$html = str_replace( '<img', $pre_replaced, $html ); // add the a tag opener
	$html = str_replace( '/>', '/></a>', $html ); // add the a tag closer

	return $html;
}

// Add plugin action link.
add_filter( 'plugin_action_links_' . Header_Image_Clickable_BASENAME, 'Header_Image_Clickable_plugin_action_links', 10, 4 );
function Header_Image_Clickable_plugin_action_links( $actions ) {
	$custom_link = array(
		'configure' => sprintf( '<a target="_blank" href="%s">%s</a>', wp_customize_url() . '?autofocus[section]=header_image', __( 'Manage Header Image Link', 'header-image-clickable' ) ),
		);
	return array_merge( $custom_link, $actions );
}
