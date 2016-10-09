<?php
/**
 * Blue Blaze Favicons
 *
 * @author  Blue Blaze Associates
 * @license GPL-2.0+
 * @link    https://github.com/blueblazeassociates/blueblaze--acf-support
 */

/*
 * Plugin Name:       Blue Blaze ACF Support
 * Plugin URI:        https://github.com/blueblazeassociates/blueblaze--acf-support
 * Description:       Provides some extra functions for working with Advanced Custom Fields easier.
 * Version:           1.0.0
 * Author:            Blue Blaze Associates
 * Author URI:        http://www.blueblazeassociates.com
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * GitHub Plugin URI: https://github.com/blueblazeassociates/blueblaze--favicons
 * Requires WP:       4.5
 * Requires PHP:      5.6
*/

if ( ! function_exists( 'acf_support__get_simple_field' ) ) {
/**
 * This is a simple helper function for ACF fields.
 *
 * This function is similar to ACF's get_field and is meant to be used on simple ACF fields that
 * return raw values.
 *
 * This function could be used for structured fields, where data is returned in associative arrays,
 * but that is not recommended.
 *
 * This function contains protective code to prevent accessing ACF functions or values
 * if something isn't right (ie. ACF disabled, incorrect field name, etc).
 *
 * TODO: Move this function into a custom plugin.
 *
 * @param string $field_name The name of the ACF field to retrieved.
 * @param integer $post_id Specific post ID where value is stored. Defaults to the current post ID.
 * @param boolean $format_value Whether or not to format the value loaded from the DB. Defaults to true.
 *
 * @return mixed
 *
 * @see http://www.advancedcustomfields.com/resources/get_field/
 */
function acf_support__get_simple_field( $field_name, $post_id = null, $format_value = true ) {

  // Prepare the $post_id variable, in case it hasn't been set (which is normally the case).
  if ( is_null( $post_id ) ) {
    $post_id = get_the_ID();
  }

  // Initialize a blank field value variable.
  // This will be used throughout this function to capture what needs to be output.
  $field_value = '';

  // Attempt to access the value of the ACF field.
  if ( function_exists( 'get_field' ) ) {
    $field_value = get_field( $field_name, $post_id, $format_value );
  }

  // If the field value doesn't contain anything, set it to the empty string.
  if ( ! isset ( $field_value ) || empty ( $field_value ) ) {
    $field_value = '';
  }

  return $field_value;
}
}

if ( ! function_exists( 'acf_support__simple_field' ) ) {
/**
 * This is a simple helper function for ACF fields.
 *
 * This function is similar to ACF's the_field and is meant to be used on simple ACF fields that
 * return raw values.
 *
 * This function should NOT be used on structured fields where data is returned in associative
 * arrays.
 *
 * This function contains protective code to prevent accessing ACF functions or values
 * if something isn't right (ie. ACF disabled, incorrect field name, etc).
 *
 * If something bad happens while accessing this field, the function will output an HTML comment:
 * <!-- An error occurred while accessing ACF field FIELD_NAME -->
 *
 * TODO: Move this function into a custom plugin.
 *
 * @param string $field_name The name of the ACF field to retrieved.
 * @param integer $post_id Specific post ID where value is stored. Defaults to the current post ID.
 *
 * @return string
 *
 * @see http://www.advancedcustomfields.com/resources/the_field/
 */
function acf_support__simple_field( $field_name, $post_id = null ) {

  // Prepare the $post_id variable, in case it hasn't been set (which is normally the case).
  if ( is_null( $post_id ) ) {
    $post_id = get_the_ID();
  }

  // Grab the field value.
  $field_value = acf_support__get_simple_field( $field_name, $post_id );

  if ( ! is_string( $field_value ) ) {
    $field_value = (string) $field_value;
  }

  // If the field value doesn't contain anything, set it to a helpful HTML comment.
  if ( ! isset ( $field_value ) || empty ( $field_value ) ) {
    $field_value = '<!-- An error occurred while accessing ACF field ' . $field_name . ' -->';
  }

  print $field_value;
}
}

if ( ! function_exists( 'acf_support__get_image_field' ) ) {
/**
 * TODO: Documentation
 * TODO: Move this function into a custom plugin.
 *
 * @param string $field_name The name of the ACF field to retrieved.
 * @param integer $post_id Specific post ID where value is stored. Defaults to the current post ID.
 * @param boolean $format_value Whether or not to format the value loaded from the DB. Defaults to true.
 *
 * @return array
 *
 * @see http://www.advancedcustomfields.com/resources/get_field/
 */
function acf_support__get_image_field( $field_name, $post_id = null, $format_value = true ) {

  // Prepare the $post_id variable, in case it hasn't been set (which is normally the case).
  if ( is_null( $post_id ) ) {
    $post_id = get_the_ID();
  }

  // Initialize a blank field value variable.
  // This will be used throughout this function to capture what needs to be output.
  $field_value = null;

  // Attempt to access the value of the ACF field.
  if ( function_exists( 'get_field' ) ) {
    $field_value = get_field( $field_name, $post_id, $format_value );
  }

  // If the field value doesn't contain anything, set it to an empty array.
  if ( ! isset ( $field_value ) || empty ( $field_value ) ) {
    $field_value = array();
  }

  return $field_value;
}
}

if ( ! function_exists( 'acf_support__image_field' ) ) {
/**
 * TODO: Documentation
 * TODO: Move this function into a custom plugin.
 *
 * @param string $field_name The name of the ACF field to retrieved.
 * @param integer $post_id Specific post ID where value is stored. Defaults to the current post ID.
 *
 * @return string
 *
 * @see http://www.advancedcustomfields.com/resources/the_field/
 */
function acf_support__image_field( $field_name, $post_id = null ) {

  // Prepare the $post_id variable, in case it hasn't been set (which is normally the case).
  if ( is_null( $post_id ) ) {
    $post_id = get_the_ID();
  }

  // Grab the field value.
  $field_value = acf_support__get_image_field( $field_name, $post_id );

  // If the field value doesn't contain anything, set it to a helpful HTML comment.
  if ( ! isset ( $field_value ) || empty ( $field_value ) ) {
    $field_value = '<!-- An error occurred while accessing ACF field ' . $field_name . ' -->';
  } else {

    // Generate HTML <img> tag.

    $image_alt = '';
    $image_url = '';

    if ( isset ( $field_value['alt'] ) && ! empty ( $field_value['alt'] ) ) {
      $image_alt = $field_value['alt'];
    }

    if ( isset ( $field_value['url'] ) && ! empty ( $field_value['url'] ) ) {
      $image_url = $field_value['url'];
    }

    $field_value = '<img alt="' . $image_alt . '" src="' . $image_url . '" />';
  }

  print $field_value;
}
}
