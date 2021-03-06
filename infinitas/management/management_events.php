<?php
	class ManagementEvents {
		function onSetupCacheStart(){
			Cache::config(
				'core',
				array(
					'engine' => 'File',
					'duration' => 3600,
					'probability' => 100,
					'prefix' => '',
					'lock' => false,
					'serialize' => true,
					'path' => CACHE . 'core'
				)
			);
		}

		function onSetupConfigStart(&$event, $data){
			return $data;
		}

		function onSetupConfigEnd(&$event){
		}

		function onSetupThemeStart(&$event){
			return true;
		}

		function onSetupThemeLayout(&$event, $data){
			return $data['layout'];
		}

		function onSetupThemeSelector(&$event, $data){
			return $data['theme'];
		}

		function onSetupThemeRoutes(&$event){
			return true;
		}

		function onSetupThemeEnd(&$event, $data){
			return $data['theme'];
		}

		function onFindBrowser(&$event){
			return false;
		}

		function onFindOperatingSystem(&$event){
			return false;
		}

		function onSlugUrl(&$event, $data){
			switch($data['type']){
				case 'comments':
					return array(
						'plugin' => $data['data']['plugin'],
						'controller' => $data['data']['controller'],
						'action' => $data['data']['action'],
						'id' => $data['data']['id'],
						'category' => 'news-feed'
					);
					break;
			} // switch
		}
	}