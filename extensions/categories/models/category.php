<?php
/**
* Comment Template.
*
* @todo Implement .this needs to be sorted out.
*
* Copyright (c) 2009 Carl Sutton ( dogmatic69 )
*
* Licensed under The MIT License
* Redistributions of files must retain the above copyright notice.
* @filesource
* @copyright Copyright (c) 2009 Carl Sutton ( dogmatic69 )
* @link http://infinitas-cms.org
* @package sort
* @subpackage sort.comments
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @since 0.5a
*/

class Category extends CategoriesAppModel {
	var $name = 'Category';

	var $order = array(
		'Category.lft' => 'ASC'
	);

	var $validate = array(
		'title' => array(
			'notempty' => array('rule' => array('notempty')),
		)
	);

	var $belongsTo = array(
		'Parent' => array(
			'className' => 'Categories.Category',
			'counterCache' => true
		),
		'Management.Group',
		'Locker' => array(
			'className' => 'Management.User',
			'foreignKey' => 'locked_by',
			'conditions' => '',
			'fields' => array(
				'Locker.id',
				'Locker.username'
			),
			'order' => ''
		)
	);
}

?>