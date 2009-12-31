<?php
    /**
     * Comment Template.
     *
     * @todo -c Implement .this needs to be sorted out.
     *
     * Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     *
     * Licensed under The MIT License
     * Redistributions of files must retain the above copyright notice.
     *
     * @filesource
     * @copyright     Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     * @link          http://www.dogmatic.co.za
     * @package       sort
     * @subpackage    sort.comments
     * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
     * @since         0.5a
     */

    class Content extends CmsAppModel
    {
    	var $name = 'Content';

        var $order = array(
            'Content.category_id' => 'ASC',
            'Content.ordering' => 'ASC'
        );

    	var $validate = array(
    		'title' => array(
    			'notempty' => array('rule' => array('notempty')),
    		),
    	);

        var $actsAs = array(
            'Core.Sluggable',
            'Core.Viewable',
            'Core.Ordered' => array(
                'foreign_key' => 'category_id'
            )
        );

    	var $belongsTo = array(
            'Category' => array(
                'className' => 'Cms.Category',
                'counterCache' => true
            ),
            'Core.Group'
    	);

    	var $hasMany = array(
    		'Cms.ContentFrontpage'
    	);

    }
?>