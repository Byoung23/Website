<?php

if (!defined('UPDRAFTPLUS_DIR')) die('No access.');

/**
 * Handles UpdraftCentral Plugin Commands which basically handles
 * the installation and activation of a plugin
 */
class UpdraftCentral_Plugin_Commands extends UpdraftCentral_Commands {

	private $switched = false;

	/**
	 * Function that gets called before every action
	 *
	 * @param string $command    a string that corresponds to UDC command to call a certain method for this class.
	 * @param array  $data       an array of data post or get fields
	 * @param array  $extra_info extrainfo use in the udrpc_action, e.g. user_id
	 *
	 * link to udrpc_action main function in class UpdraftPlus_UpdraftCentral_Listener
	 */
	public function _pre_action($command, $data, $extra_info) {
		// Here we assign the current blog_id to a variable $blog_id
		$blog_id = get_current_blog_id();
		if (!empty($data['site_id'])) $blog_id = $data['site_id'];
	
		if (function_exists('switch_to_blog') && is_multisite() && $blog_id) {
			$this->switched = switch_to_blog($blog_id);
		}
	}
	
	/**
	 * Function that gets called after every action
	 *
	 * @param string $command    a string that corresponds to UDC command to call a certain method for this class.
	 * @param array  $data       an array of data post or get fields
	 * @param array  $extra_info extrainfo use in the udrpc_action, e.g. user_id
	 *
	 * link to udrpc_action main function in class UpdraftPlus_UpdraftCentral_Listener
	 */
	public function _post_action($command, $data, $extra_info) {
		// Here, we're restoring to the current (default) blog before we switched
		if ($this->switched) restore_current_blog();
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->_admin_include('plugin.php', 'file.php', 'template.php', 'class-wp-upgrader.php', 'plugin-install.php', 'update.php');
	}

	/**
	 * Checks whether the plugin is currently installed and activated.
	 *
	 * @param array $query Parameter array containing the name of the plugin to check
	 * @return array Contains the result of the current process
	 */
	public function is_plugin_installed($query) {

		if (!isset($query['plugin']))
			return $this->_generic_error_response('plugin_name_required');


		$result = $this->_get_plugin_info($query['plugin']);
		return $this->_response($result);
	}

	/**
	 * Applies currently requested action for plugin processing
	 *
	 * @param string $action The action to apply (e.g. activate or install)
	 * @param array  $query  Parameter array containing information for the currently requested action
	 *
	 * @return array
	 */
	private function _apply_plugin_action($action, $query) {

		$result = array();
		switch ($action) {
			case 'activate':
			case 'network_activate':
				$info = $this->_get_plugin_info($query['plugin']);
				if ($info['installed']) {
					if (is_multisite() && 'network_activate' === $action) {
						$activate = activate_plugin($info['plugin_path'], '', true);
					} else {
						$activate = activate_plugin($info['plugin_path']);
					}

					if (is_wp_error($activate)) {
						$result = $this->_generic_error_response('generic_response_error', array($activate->get_error_message()));
					} else {
						$result = array('activated' => true);
					}
				} else {
					$result = $this->_generic_error_response('plugin_not_installed', array($query['plugin']));
				}
				break;
			case 'deactivate':
			case 'network_deactivate':
				$info = $this->_get_plugin_info($query['plugin']);
				if ($info['active']) {
					if (is_multisite() && 'network_deactivate' === $action) {
						deactivate_plugins($info['plugin_path'], false, true);
					} else {
						deactivate_plugins($info['plugin_path']);
					}

					if (!is_plugin_active($info['plugin_path'])) {
						$result = array('deactivated' => true);
					} else {
						$result = $this->_generic_error_response('deactivate_plugin_failed', array($query['plugin']));
					}
				} else {
					$result = $this->_generic_error_response('not_active', array($query['plugin']));
				}
				break;
			case 'install':
				$api = plugins_api('plugin_information', array(
					'slug' => $query['slug'],
					'fields' => array(
						'short_description' => false,
						'sections' => false,
						'requires' => false,
						'rating' => false,
						'ratings' => false,
						'downloaded' => false,
						'last_updated' => false,
						'added' => false,
						'tags' => false,
						'compatibility' => false,
						'homepage' => false,
						'donate_link' => false,
					)
				));

				if (is_wp_error($api)) {
					$result = $this->_generic_error_response('generic_response_error', array($api->get_error_message()));
				} else {
					$info = $this->_get_plugin_info($query['plugin']);
					$installed = $info['installed'];

					if (!$installed) {
						// WP < 3.7
						if (!class_exists('Automatic_Upgrader_Skin')) include_once(UPDRAFTPLUS_DIR.'/central/classes/class-automatic-upgrader-skin.php');

						$skin = new Automatic_Upgrader_Skin();
						$upgrader = new Plugin_Upgrader($skin);

						$download_link = $api->download_link;
						$installed = $upgrader->install($download_link);
					}

					if (!$installed) {
						$result = $this->_generic_error_response('plugin_install_failed', array($query['plugin']));
					} else {
						$result = array('installed' => true);
					}
				}
				break;
		}

		return $result;
	}

	/**
	 * Preloads the submitted credentials to the global $_POST variable
	 *
	 * @param array $query Parameter array containing information for the currently requested action
	 */
	private function _preload_credentials($query) {
		if (!empty($query) && isset($query['filesystem_credentials'])) {
			parse_str($query['filesystem_credentials'], $filesystem_credentials);
			if (is_array($filesystem_credentials)) {
				foreach ($filesystem_credentials as $key => $value) {
					// Put them into $_POST, which is where request_filesystem_credentials() checks for them.
					$_POST[$key] = $value;
				}
			}
		}
	}

	/**
	 * Checks whether we have the required fields submitted and the user has
	 * the capabilities to execute the requested action
	 *
	 * @param array $query        The submitted information
	 * @param array $fields       The required fields to check
	 * @param array $capabilities The capabilities to check and validate
	 *
	 * @return array|string
	 */
	private function _validate_fields_and_capabilities($query, $fields, $capabilities) {

		$error = '';
		if (!empty($fields)) {
			for ($i=0; $i<count($fields); $i++) {
				$field = $fields[$i];

				if (!isset($query[$field])) {
					if ('keyword' === $field) {
						$error = $this->_generic_error_response('keyword_required');
					} else {
						$error = $this->_generic_error_response('plugin_'.$query[$field].'_required');
					}
					break;
				}
			}
		}

		if (empty($error) && !empty($capabilities)) {
			for ($i=0; $i<count($capabilities); $i++) {
				if (!current_user_can($capabilities[$i])) {
					$error = $this->_generic_error_response('plugin_insufficient_permission');
					break;
				}
			}
		}

		return $error;
	}

	/**
	 * Activates the plugin
	 *
	 * @param array $query Parameter array containing the name of the plugin to activate
	 * @return array Contains the result of the current process
	 */
	public function activate_plugin($query) {

		$error = $this->_validate_fields_and_capabilities($query, array('plugin'), array('activate_plugins'));
		if (!empty($error)) {
			return $error;
		}

		$action = 'activate';
		if (!empty($query['multisite']) && (bool) $query['multisite']) $action = 'network_'.$action;

		$result = $this->_apply_plugin_action($action, $query);
		if (empty($result['activated'])) {
			return $result;
		}

		return $this->_response($result);
	}

	/**
	 * Deactivates the plugin
	 *
	 * @param array $query Parameter array containing the name of the plugin to deactivate
	 * @return array Contains the result of the current process
	 */
	public function deactivate_plugin($query) {

		$error = $this->_validate_fields_and_capabilities($query, array('plugin'), array('activate_plugins'));
		if (!empty($error)) {
			return $error;
		}

		$action = 'deactivate';
		if (!empty($query['multisite']) && (bool) $query['multisite']) $action = 'network_'.$action;

		$result = $this->_apply_plugin_action($action, $query);
		if (empty($result['deactivated'])) {
			return $result;
		}

		return $this->_response($result);
	}

	/**
	 * Download, install and activates the plugin
	 *
	 * @param array $query Parameter array containing the filesystem credentials entered by the user along with the plugin name and slug
	 * @return array Contains the result of the current process
	 */
	public function install_activate_plugin($query) {

		$error = $this->_validate_fields_and_capabilities($query, array('plugin', 'slug'), array('install_plugins', 'activate_plugins'));
		if (!empty($error)) {
			return $error;
		}

		$this->_preload_credentials($query);

		$result = $this->_apply_plugin_action('install', $query);
		if (!empty($result['installed']) && $result['installed']) {
			$action = 'activate';
			if (!empty($query['multisite']) && (bool) $query['multisite']) $action = 'network_'.$action;

			$result = $this->_apply_plugin_action($action, $query);
			if (empty($result['activated'])) {
				return $result;
			}
		} else {
			return $result;
		}

		return $this->_response($result);
	}

	/**
	 * Download, install the plugin
	 *
	 * @param array $query Parameter array containing the filesystem credentials entered by the user along with the plugin name and slug
	 * @return array Contains the result of the current process
	 */
	public function install_plugin($query) {

		$error = $this->_validate_fields_and_capabilities($query, array('plugin', 'slug'), array('install_plugins'));
		if (!empty($error)) {
			return $error;
		}

		$this->_preload_credentials($query);

		$result = $this->_apply_plugin_action('install', $query);
		if (empty($result['installed'])) {
			return $result;
		}

		return $this->_response($result);
	}

	/**
	 * Uninstall/delete the plugin
	 *
	 * @param array $query Parameter array containing the filesystem credentials entered by the user along with the plugin name and slug
	 * @return array Contains the result of the current process
	 */
	public function delete_plugin($query) {

		$error = $this->_validate_fields_and_capabilities($query, array('plugin'), array('delete_plugins'));
		if (!empty($error)) {
			return $error;
		}

		$this->_preload_credentials($query);
		$info = $this->_get_plugin_info($query['plugin']);

		if ($info['installed']) {
			$deleted = delete_plugins(array($info['plugin_path']));

			if ($deleted) {
				$result = array('deleted' => true);
			} else {
				$result = $this->_generic_error_response('delete_plugin_failed', array($query['plugin']));
			}
		} else {
			$result = $this->_generic_error_response('plugin_not_installed', array($query['plugin']));
		}

		return $this->_response($result);
	}

	/**
	 * Updates/upgrade the plugin
	 *
	 * @param array $query Parameter array containing the filesystem credentials entered by the user along with the plugin name and slug
	 * @return array Contains the result of the current process
	 */
	public function update_plugin($query) {

		$error = $this->_validate_fields_and_capabilities($query, array('plugin', 'slug'), array('update_plugins'));
		if (!empty($error)) {
			return $error;
		}

		$this->_preload_credentials($query);
		$info = $this->_get_plugin_info($query['plugin']);

		// Make sure that we still have the plugin installed before running
		// the update process
		if ($info['installed']) {
			// Load the updates command class if not existed
			if (!class_exists('UpdraftCentral_Updates_Commands')) include_once('updates.php');
			$update_command = new UpdraftCentral_Updates_Commands($this->rc);

			$result = $update_command->update_plugin($info['plugin_path'], $query['slug']);
			if (!empty($result['error'])) {
				$result['values'] = array($query['plugin']);
			}
		} else {
			$result = $this->_generic_error_response('plugin_not_installed', array($query['plugin']));
		}

		return $this->_response($result);
	}

	/**
	 * Gets the plugin information along with its active and install status
	 *
	 * @internal
	 * @param array $plugin The name of the plugin to pull the information from
	 * @return array Contains the plugin information
	 */
	private function _get_plugin_info($plugin) {

		$info = array(
			'active' => false,
			'installed' => false
		);
		
		// Clear plugin cache so that newly installed/downloaded plugins
		// gets reflected when calling "get_plugins"
		wp_clean_plugins_cache();
		
		// Gets all plugins available.
		$get_plugins = get_plugins();

		// Loops around each plugin available.
		foreach ($get_plugins as $key => $value) {
			// If the plugin name matches that of the specified name, it will gather details.
			if ($value['Name'] === $plugin) {
				$info['installed'] = true;
				$info['active'] = is_plugin_active($key);
				$info['plugin_path'] = $key;
				$info['data'] = $value;
				break;
			}
		}

		return $info;
	}

	/**
	 * Loads all available plugins with additional attributes and settings needed by UpdraftCentral
	 *
	 * @param array $query Parameter array Any available parameters needed for this action
	 * @return array Contains the result of the current process
	 */
	public function load_plugins($query) {

		$error = $this->_validate_fields_and_capabilities($query, array(), array('install_plugins', 'activate_plugins'));
		if (!empty($error)) {
			return $error;
		}

		$website = get_bloginfo('name');
		$results = array();

		// Load the updates command class if not existed
		if (!class_exists('UpdraftCentral_Updates_Commands')) include_once('updates.php');
		$updates = new UpdraftCentral_Updates_Commands($this->rc);

		// Get plugins for update
		$plugin_updates = $updates->get_item_updates('plugins');

		// Get all plugins
		$plugins = get_plugins();

		foreach ($plugins as $key => $value) {
			$slug = basename($key, '.php');

			$plugin = new stdClass();
			$plugin->name = $value['Name'];
			$plugin->description = $value['Description'];
			$plugin->slug = $slug;
			$plugin->version = $value['Version'];
			$plugin->author = $value['Author'];
			$plugin->status = is_plugin_active($key) ? 'active' : 'inactive';
			$plugin->website = $website;
			$plugin->multisite = is_multisite();

			if (!empty($plugin_updates[$key])) {
				$update_info = $plugin_updates[$key];

				if (version_compare($update_info->Version, $update_info->update->new_version, '<')) {
					if (!empty($update_info->update->new_version)) $plugin->latest_version = $update_info->update->new_version;
					if (!empty($update_info->update->package)) $plugin->download_link = $update_info->update->package;
					if (!empty($update_info->update->sections)) $plugin->sections = $update_info->update->sections;
				}
			}

			if (empty($plugin->short_description) && !empty($plugin->description)) {
				// Only pull the first sentence as short description, it should be enough rather than displaying
				// an empty description or a full blown one which the user can access anytime if they press on
				// the view details link in UpdraftCentral.
				$temp = explode('.', $plugin->description);
				$short_description = $temp[0];

				// Adding the second sentence wouldn't hurt, in case the first sentence is too short.
				if (isset($temp[1])) $short_description .= '.'.$temp[1];

				$plugin->short_description = $short_description.'.';
			}

			$results[] = $plugin;
		}

		$result = array(
			'plugins' => $results
		);

		$result = array_merge($result, $this->_get_backup_credentials_settings(WP_PLUGIN_DIR));
		return $this->_response($result);
	}

	/**
	 * Gets the backup and security credentials settings for this website
	 *
	 * @param array $query Parameter array Any available parameters needed for this action
	 * @return array Contains the result of the current process
	 */
	public function get_plugin_requirements() {
		return $this->_response($this->_get_backup_credentials_settings(WP_PLUGIN_DIR));
	}
}
