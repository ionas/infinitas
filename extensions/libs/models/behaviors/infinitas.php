<?php
	class InfinitasBehavior extends ModelBehavior {
		var $_defaults = array();

		var $blockedPlugins = array(
			'DebugKit',
			'Filter',
			'Libs'
		);

		/**
		 * JSON error messages.
		 *
		 * Set up some errors for json.
		 * @access public
		 */
		var $_json_messages = array(
		    JSON_ERROR_NONE      => 'No error',
		    JSON_ERROR_DEPTH     => 'The maximum stack depth has been exceeded',
		    JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
		    JSON_ERROR_SYNTAX    => 'Syntax error',
		);

		/**
		 * error messages from checking json
		 */
		var $__jsonErrors = array();

		function setup(&$Model, $config = null) {
			if (is_array($config)) {
				$this->settings[$Model->alias] = array_merge($this->_defaults, $config);
			} else {
				$this->settings[$Model->alias] = $this->_defaults;
			}
		}


		/**
		 * Get all the tables
		 *
		 * @param array $Model
		 * @param string $connection the connection to use for getting tables.
		 *
		 * @return array list of tables.
		 */
		function getTables(&$Model, $connection = 'default'){
			$this->db    = ConnectionManager::getDataSource($connection);
			$tables      = $this->db->query('SHOW TABLES;');
			$databseName = $this->db->config['database'];

			unset($this->db);

			return Set::extract('/TABLE_NAMES/Tables_in_'.$databseName, $tables);
		}

		/**
		 * Get tables with a certain field.
		 *
		 * Gets a list of tables with the selected field in the selected connection.
		 *
		 * @param mixed $Model
		 * @param string $connection the connection to use when finding tables
		 * @param mixed $field the tables with this field are returned
		 *
		 * @return false when no field set, else array of tables with model/plugin.
		 */
		function getTablesByField(&$Model, $connection = 'default', $field = null){
			if (!$field) {
				return false;
			}

			$tableNames = $this->getTables($Model, $connection);
			$return = array();

			$this->db    = ConnectionManager::getDataSource($connection);

			foreach($tableNames as $table ){
				$fields = $this->db->query('DESCRIBE '.$table);
				$fields = Set::extract('/COLUMNS/Field', $fields);

				if (in_array($field, $fields)) {
					$_table = explode('_', $table, 2);

					$plugin = ucfirst(count($_table) == 2 ? $_table[0] : '');
					$plugin = ($plugin == 'Core') ? 'Management' : $plugin;

					$return[] = array(
						'plugin' => $plugin,
						'model'  => Inflector::classify(isset($_table[1]) ? $_table[1] : $_table[0]),
						'table'  => $table
					);
				}
			}
			return $return;
		}

		/**
		 * convert json data.
		 *
		 * takes a string and returns some data. can pass return false for validation.
		 *
		 * @params string $data a string of json data.
		 * @params array $config the params to pass to json_decode (assoc && depth)
		 * @params bool $return will return the array/object by default but can be set to false to just check its valid.
		 */
		function getJson(&$Model, $data = null, $config = array(), $return = true){
			if (!$data) {
				$this->_errors[] = 'No data for json';
				return false;
			}

			$defaultConfig = array('assoc' => true);
			$config = array_merge($defaultConfig, (array)$config);
			$json = json_decode($data, $config['assoc']);

			if (!$json) {
				$Model->__jsonErrors[] = $this->_json_messages[json_last_error()];
				return false;
			}

			if ($return) {
				return $json;
			}

			unset($json);
			return true;
		}

		/**
		 * Get a list of plugins.
		 *
		 * Just gets a list of plugins and returns them after rempving the plugins
		 * that should not be displayed to the user.
		 *
		 * @return array an array of all the plugins in infinitas.
		 */
		function getPlugins($skipBlocked = true){
			$plugins = Configure::listObjects('plugin');

			if ($skipBlocked === false) {
				return $plugins;
			}

			foreach($plugins as $plugin){
				if (!in_array($plugin, $this->blockedPlugins)){
					$return[Inflector::underscore($plugin)] = $plugin;
				}
			}

			return array('' => 'None') + (array)$return;
		}
	}
?>