<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('luxury_wine_storage_get')) {
	function luxury_wine_storage_get($var_name, $default='') {
		global $LUXURY_WINE_STORAGE;
		return isset($LUXURY_WINE_STORAGE[$var_name]) ? $LUXURY_WINE_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('luxury_wine_storage_set')) {
	function luxury_wine_storage_set($var_name, $value) {
		global $LUXURY_WINE_STORAGE;
		$LUXURY_WINE_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('luxury_wine_storage_empty')) {
	function luxury_wine_storage_empty($var_name, $key='', $key2='') {
		global $LUXURY_WINE_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($LUXURY_WINE_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($LUXURY_WINE_STORAGE[$var_name][$key]);
		else
			return empty($LUXURY_WINE_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('luxury_wine_storage_isset')) {
	function luxury_wine_storage_isset($var_name, $key='', $key2='') {
		global $LUXURY_WINE_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($LUXURY_WINE_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($LUXURY_WINE_STORAGE[$var_name][$key]);
		else
			return isset($LUXURY_WINE_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('luxury_wine_storage_inc')) {
	function luxury_wine_storage_inc($var_name, $value=1) {
		global $LUXURY_WINE_STORAGE;
		if (empty($LUXURY_WINE_STORAGE[$var_name])) $LUXURY_WINE_STORAGE[$var_name] = 0;
		$LUXURY_WINE_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('luxury_wine_storage_concat')) {
	function luxury_wine_storage_concat($var_name, $value) {
		global $LUXURY_WINE_STORAGE;
		if (empty($LUXURY_WINE_STORAGE[$var_name])) $LUXURY_WINE_STORAGE[$var_name] = '';
		$LUXURY_WINE_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('luxury_wine_storage_get_array')) {
	function luxury_wine_storage_get_array($var_name, $key, $key2='', $default='') {
		global $LUXURY_WINE_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($LUXURY_WINE_STORAGE[$var_name][$key]) ? $LUXURY_WINE_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($LUXURY_WINE_STORAGE[$var_name][$key][$key2]) ? $LUXURY_WINE_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('luxury_wine_storage_set_array')) {
	function luxury_wine_storage_set_array($var_name, $key, $value) {
		global $LUXURY_WINE_STORAGE;
		if (!isset($LUXURY_WINE_STORAGE[$var_name])) $LUXURY_WINE_STORAGE[$var_name] = array();
		if ($key==='')
			$LUXURY_WINE_STORAGE[$var_name][] = $value;
		else
			$LUXURY_WINE_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('luxury_wine_storage_set_array2')) {
	function luxury_wine_storage_set_array2($var_name, $key, $key2, $value) {
		global $LUXURY_WINE_STORAGE;
		if (!isset($LUXURY_WINE_STORAGE[$var_name])) $LUXURY_WINE_STORAGE[$var_name] = array();
		if (!isset($LUXURY_WINE_STORAGE[$var_name][$key])) $LUXURY_WINE_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$LUXURY_WINE_STORAGE[$var_name][$key][] = $value;
		else
			$LUXURY_WINE_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('luxury_wine_storage_merge_array')) {
	function luxury_wine_storage_merge_array($var_name, $key, $value) {
		global $LUXURY_WINE_STORAGE;
		if (!isset($LUXURY_WINE_STORAGE[$var_name])) $LUXURY_WINE_STORAGE[$var_name] = array();
		if ($key==='')
			$LUXURY_WINE_STORAGE[$var_name] = array_merge($LUXURY_WINE_STORAGE[$var_name], $value);
		else
			$LUXURY_WINE_STORAGE[$var_name][$key] = array_merge($LUXURY_WINE_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('luxury_wine_storage_set_array_after')) {
	function luxury_wine_storage_set_array_after($var_name, $after, $key, $value='') {
		global $LUXURY_WINE_STORAGE;
		if (!isset($LUXURY_WINE_STORAGE[$var_name])) $LUXURY_WINE_STORAGE[$var_name] = array();
		if (is_array($key))
			luxury_wine_array_insert_after($LUXURY_WINE_STORAGE[$var_name], $after, $key);
		else
			luxury_wine_array_insert_after($LUXURY_WINE_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('luxury_wine_storage_set_array_before')) {
	function luxury_wine_storage_set_array_before($var_name, $before, $key, $value='') {
		global $LUXURY_WINE_STORAGE;
		if (!isset($LUXURY_WINE_STORAGE[$var_name])) $LUXURY_WINE_STORAGE[$var_name] = array();
		if (is_array($key))
			luxury_wine_array_insert_before($LUXURY_WINE_STORAGE[$var_name], $before, $key);
		else
			luxury_wine_array_insert_before($LUXURY_WINE_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('luxury_wine_storage_push_array')) {
	function luxury_wine_storage_push_array($var_name, $key, $value) {
		global $LUXURY_WINE_STORAGE;
		if (!isset($LUXURY_WINE_STORAGE[$var_name])) $LUXURY_WINE_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($LUXURY_WINE_STORAGE[$var_name], $value);
		else {
			if (!isset($LUXURY_WINE_STORAGE[$var_name][$key])) $LUXURY_WINE_STORAGE[$var_name][$key] = array();
			array_push($LUXURY_WINE_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('luxury_wine_storage_pop_array')) {
	function luxury_wine_storage_pop_array($var_name, $key='', $defa='') {
		global $LUXURY_WINE_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($LUXURY_WINE_STORAGE[$var_name]) && is_array($LUXURY_WINE_STORAGE[$var_name]) && count($LUXURY_WINE_STORAGE[$var_name]) > 0) 
				$rez = array_pop($LUXURY_WINE_STORAGE[$var_name]);
		} else {
			if (isset($LUXURY_WINE_STORAGE[$var_name][$key]) && is_array($LUXURY_WINE_STORAGE[$var_name][$key]) && count($LUXURY_WINE_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($LUXURY_WINE_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('luxury_wine_storage_inc_array')) {
	function luxury_wine_storage_inc_array($var_name, $key, $value=1) {
		global $LUXURY_WINE_STORAGE;
		if (!isset($LUXURY_WINE_STORAGE[$var_name])) $LUXURY_WINE_STORAGE[$var_name] = array();
		if (empty($LUXURY_WINE_STORAGE[$var_name][$key])) $LUXURY_WINE_STORAGE[$var_name][$key] = 0;
		$LUXURY_WINE_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('luxury_wine_storage_concat_array')) {
	function luxury_wine_storage_concat_array($var_name, $key, $value) {
		global $LUXURY_WINE_STORAGE;
		if (!isset($LUXURY_WINE_STORAGE[$var_name])) $LUXURY_WINE_STORAGE[$var_name] = array();
		if (empty($LUXURY_WINE_STORAGE[$var_name][$key])) $LUXURY_WINE_STORAGE[$var_name][$key] = '';
		$LUXURY_WINE_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('luxury_wine_storage_call_obj_method')) {
	function luxury_wine_storage_call_obj_method($var_name, $method, $param=null) {
		global $LUXURY_WINE_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($LUXURY_WINE_STORAGE[$var_name]) ? $LUXURY_WINE_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($LUXURY_WINE_STORAGE[$var_name]) ? $LUXURY_WINE_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('luxury_wine_storage_get_obj_property')) {
	function luxury_wine_storage_get_obj_property($var_name, $prop, $default='') {
		global $LUXURY_WINE_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($LUXURY_WINE_STORAGE[$var_name]->$prop) ? $LUXURY_WINE_STORAGE[$var_name]->$prop : $default;
	}
}
?>