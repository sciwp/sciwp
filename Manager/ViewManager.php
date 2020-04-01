<?php
namespace MyPlugin\Sci\Manager;

defined('WPINC') OR exit('No direct script access allowed');

use Exception;
use MyPlugin\Sci\Plugin;
use MyPlugin\Sci\Manager;
use MyPlugin\Sci\View;

/**
 * ViewManager
 *
 * @author		Eduardo Lazaro Rodriguez <me@mcme.com>
 * @author		Kenodo LTD <info@kenodo.com>
 * @copyright	2018 Kenodo LTD
 * @license		http://opensource.org/licenses/MIT	MIT License
 * @version     1.0.0
 * @link		https://www.Sci.com 
 * @since		Version 1.0.0 
 */
class ViewManager extends Manager
{    
    /** @var array $directory View folder */
    private $directory = [];

	/**
	 * Class constructor
     *
     * @return \MyPlugin\Sci\Manager\ViewManager
	 */
	protected function __construct()
    {
        parent::__construct();
    }

	/**
	 * Return a view
	 *
     * @param string $views The view relative route
     * @param string $module The plugin module
	 * @return \MyPlugin\Sci\Manager\StyleManager
	 */
	public function view($view, $module = false)
	{
        if (!isset($this->zones[$zone])) return $this;

        foreach($this->styles as $handle => $style) {
            if (in_array($handle, $this->zones[$zone])) {
                wp_register_style($handle, $style->getSrc(), $style->getDependences(), $style->getVersion(), $style->getMedia());
            }
        }

        foreach($this->zones[$zone] as $handle) {
            wp_enqueue_style($handle);
        }

        return $this;
    }

    /**
     * Add filters to WordPress so the styles are processed
     *
     * @return \MyPlugin\Sci\Manager\StyleManager
     */
	public function addFilters()
	{
        // Enqueue frontend styles
        add_action( 'wp_enqueue_scripts', function() {
            $this->enqueue('front');
        });

        // Enqueue admin panel styles
        add_action( 'admin_enqueue_scripts', function() {
            $this->enqueue('admin');
        });

        // To avoid repeating this action
        $this->filtersAdded = true;
        return $this;
    }
}