<?php
	/* 
	 * Short Description / title.
	 * 
	 * Overview of what the file does. About a paragraph or two
	 * 
	 * Copyright (c) 2010 Carl Sutton ( dogmatic69 )
	 * 
	 * @filesource
	 * @copyright Copyright (c) 2010 Carl Sutton ( dogmatic69 )
	 * @link http://www.infinitas-cms.org
	 * @package {see_below}
	 * @subpackage {see_below}
	 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
	 * @since {check_current_milestone_in_lighthouse}
	 * 
	 * @author {your_name}
	 * 
	 * Licensed under The MIT License
	 * Redistributions of files must retain the above copyright notice.
	 */

	class CmsController extends CmsAppController {
		public $uses = array();

		public function beforeFilter(){
			parent::beforeFilter();
			
			if($this->request->params['action'] != 'admin_dashboard'){
				$this->redirect(array('action' => 'dashboard'));
			}
			
			return true;
		}

		public function admin_dashboard(){
			$Content = ClassRegistry::init('Cms.CmsContent');
			
			$requireSetup = count($Content->GlobalContent->GlobalLayout->find('list')) >= 1;
			$this->set('requreSetup', $requireSetup);
			$this->set('hasContent', $Content->find('count') >= 1);
		}
	}