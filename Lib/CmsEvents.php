<?php
	final class CmsEvents extends AppEvents{
		public function onPluginRollCall(){
			return array(
				'name' => 'Cms',
				'description' => 'Content Management',
				'icon' => '/cms/img/icon.png',
				'author' => 'Infinitas',
				'dashboard' => array(
					'plugin' => 'cms',
					'controller' => 'cms',
					'action' => 'dashboard'
				)
			);
		}

		public function onAdminMenu($event){
			$menu['main'] = array(
				'Dashboard' => array('plugin' => 'cms', 'controller' => 'cms', 'action' => 'dashboard'),
				'Content' => array('plugin' => 'cms', 'controller' => 'cms_contents', 'action' => 'index'),
				'Front Page' => array('plugin' => 'cms', 'controller' => 'cms_frontpages', 'action' => 'index'),
				'Featured' => array('plugin' => 'cms', 'controller' => 'cms_features', 'action' => 'index'),
			);

			return $menu;
		}
		
		public function onSetupConfig(){
			return Configure::load('Cms.config');
		}
		
		public function onSetupCache(){
			return array(
				'name' => 'cms',
				'config' => array(
					'duration' => 3600,
					'probability' => 100,
					'prefix' => 'cms.',
					'lock' => false,
					'serialize' => true
				)
			);
		}

		public function onSlugUrl($event, $data){
			$data['data'] = isset($data['data']) ? $data['data'] : $data;
			$data['type'] = isset($data['type']) ? $data['type'] : 'contents';

			return parent::onSlugUrl($event, $data['data'], $data['type']);
		}

		public function onSetupRoutes($event, $data = null) {
			Router::connect(
				'/admin/cms',
				array(
					'admin' => true,
					'prefix' => 'admin',
					'plugin' => 'cms',
					'controller' => 'cms',
					'action' => 'dashboard'
				)
			);
		}
	}