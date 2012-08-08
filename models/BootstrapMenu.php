<?php
namespace li3b_core\models;

class BootstrapMenu extends \lithium\core\StaticObject {

	/**
	 * Default static menus.
	 *
	 * @var array
	*/
	static $static_menus = array(
		'admin' => array(
			'm1_dashboard' => array(
				'title' => 'Dashboard',
				'url' => '/admin',
				'options' => array()
			)
		)
	);

	/**
	 * Returns a static menu.
	 * Static menus are defined as arrays.
	 * There is a default admin menu and a default public site menu.
	 *
	 * This method is filterable so the menus can be added, added to or changed.
	 *
	 * @param string $name The name of the static menu to return (empty value returns all menus)
	 * @param array $options
	 * @return array The static menu(s)
	*/
	public static function static_menu($name=null, $options=array()) {
		$defaults = array();
		$options += $defaults;
		$params = compact('name', 'options');
		
		$filter = function($self, $params) {
			$options = $params['options'];
			$name = $params['name'];
			$static_menus = array();
			
			// get a specific menu or all menus to return
			if(empty($name)) {
				$static_menus = $self::$static_menus;
			} else {
				$static_menus = isset($self::$static_menus[$params['name']]) ? $self::$static_menus[$params['name']]:array();
			}
			
			// sort parent menu items by key name
			ksort($static_menus);
			
			// return the static menus
			return $static_menus;
		};
		
		return static::_filter(__FUNCTION__, $params, $filter);
	}

}
?>