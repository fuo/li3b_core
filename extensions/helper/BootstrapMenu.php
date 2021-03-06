<?php
/**
 * Menu Helper
 *
*/
namespace li3b_core\extensions\helper;

use li3b_core\models\BootstrapMenu as Menu;
use lithium\template\View;
use lithium\util\Inflector;
use lithium\storage\Cache;
use lithium\net\http\Router;

class BootstrapMenu extends \lithium\template\Helper {

    /**
     * This renders a menu for use with Twitter Bootstrap
     * CSS and JS for Twitter Bootstrap style drop down menus.
     *
     * Note: No need to pass class names, etc. unless they are different
     * than what Twitter Bootstrap requires.
     *
     * @param string $name The menu name
     * @param array $options
     * @return string HTML code for the menu
     */
    public function render($name=null, $options=array()) {
        $defaults = array(
            //'cache' => '+1 day'
            'cache' => false,
            'menuId' => '',
            'menuClass' => '',
            'activeClass' => 'active'
        );
        $options += $defaults;

        if(empty($name) || !is_string($name)) {
            return '';
        }

        // Get the current URL (false excludes the domain)
        $here = $this->_context->html->here(false);

        // set the cache key for the menu
        $cache_key = (empty($name)) ? 'li3b_menus.all':'li3b_menus.' . $name;
        $menu = false;

        // if told to use the menu from cache (note: filters will not be applied for this call because Menu::staticMenu() should not be called provided there's a copy in cache)
        if(!empty($options['cache'])) {
            $menu = Cache::read('default', $cache_key);
        }

        // if the menu hasn't been set in cache or it was empty for some reason, get a fresh copy of its data
        if(empty($menu)) {
            $menu = Menu::staticMenu($name);
        }

        // if using cache, write the menu data to the cache key
        if(!empty($options['cache'])) {
            Cache::write('default', $cache_key, $menu, $options['cache']);
        }

        // Format the HTML for the menu
        // option for additional custom menu class
        $menuClass = ' ' . $options['menuClass'];
        $activeClassName = ' ' . $options['activeClass'];

        $string = "\n";
        $string .= '<ul class="nav nav-pills ' . $name . '_menu' . $menuClass . '" id="' . $options['menuId'] . '">';
        $string .= "\n";

        if(is_array($menu)) {
            $i = 1;
            $total = count($menu);
            foreach($menu as $parent) {
                $title = (isset($parent['title']) && !empty($parent['title'])) ? $parent['title']:false;
                $url = (isset($parent['url']) && !empty($parent['url'])) ? $parent['url']:false;
                $activeIf = (isset($parent['activeIf']) && !empty($parent['activeIf'])) ? $parent['activeIf']:array();
                $options = (isset($parent['options']) && is_array($parent['options'])) ? $parent['options']:array();
                $sub_items = (isset($parent['subItems']) && is_array($parent['subItems'])) ? $parent['subItems']:array();
                if($parent == 'separator' || $parent == 'spacer' || $parent == 'divider') {
                    $string .= '<li class="divider-vertical"></li>';
                } else {
                    if($title && $url) {
                        $string .= "\t";

                        $matched_route = false;
                        try {
                            $matched_route = Router::match($url);
                        } catch(\Exception $e) {
                        }

                        // /admin is of course admin_ prefix actions
                        $activeClass = ($matched_route == $here || (strstr($here, '/admin' . $matched_route))) ? $activeClassName:'';

                        // This plus the Router::match() above really needs some love.
                        // Less if statements...Should be some shorter/nicer way to write it.
                        if(!empty($activeIf)) {
                            if(isset($activeIf['library']) && isset($this->_context->request()->params['library'])) {
                                if($activeIf['library'] == $this->_context->request()->params['library']) {
                                $activeClass = $activeClassName;
                                }
                            } elseif(isset($this->_context->request()->params['controller']) && (isset($activeIf['controller']) && $activeIf['controller'] == $this->_context->request()->params['controller'])) {
                                $activeClass = $activeClassName;
                            } elseif(isset($activeIf['url']) && $activeIf['url'] == $this->_context->request()->url) {
                                $activeClass = $activeClassName;
                            }
                        }

                        $string .= '<li class="dropdown ' . $activeClass . '">' . $this->_context->html->link($title, $url, $options += array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
                        // sub menu items
                        if(count($sub_items) > 0) {
                            $string .= "\n\t";
                            $string .= '<ul class="dropdown-menu">';
                            $string .= "\n";
                            foreach($sub_items as $child) {
                                // let any of these do it
                                if($child == 'separator' || $child == 'spacer' || $child == 'divider') {
                                    $string .= '<li class="divider"></li>';
                                } else {
                                    $title = (isset($child['title']) && !empty($child['title'])) ? $child['title']:false;
                                    $url = (isset($child['url']) && !empty($child['url'])) ? $child['url']:false;
                                    $options = (isset($child['options']) && is_array($child['options'])) ? $child['options']:array();
                                    if($title && $url) {
                                        $string .= "\t\t";
                                        $string .= '<li>' . $this->_context->html->link($title, $url, $options) . '</li>';
                                        $string .= "\n";
                                    }
                                }
                            }
                            $string .= "\t";
                            $string .= '</ul>';
                            $string .= "\n";
                        }
                        $string .= '</li>';
                        $string .= "\n";
                    }
                }
                $i++;
            }
        }

        $string .= '</ul>';
        $string .= "\n";

        return $string;
    }
}
?>
