<?php
    /**
     * Blog pagination view element file.
     *
     * this is a custom pagination element for the blog plugin.  you can
     * customize the entire blog pagination look and feel by modyfying this file.
     *
     * Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     *
     * Licensed under The MIT License
     * Redistributions of files must retain the above copyright notice.
     *
     * @filesource
     * @copyright     Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     * @link          http://www.dogmatic.co.za
     * @package       blog
     * @subpackage    blog.views.elements.pagination.navigation
     * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
     */
?>
<div class="clr">&nbsp;</div>
<div class="pagination">
    <div class="wrap">
        <div class="limit">
            Display #
            <select id="limit" class="inputbox" size="1" name="limit">
                <option selected="selected" value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="button2-right">
            <div class="start">
                <?php
                    echo $this->Html->link(
                        __( 'Start', true ),
                        $paginator->url( array( 'page' => 1 ), true )
                    );
                ?>
            </div>
        </div>
        <div class="button2-right">
            <div class="prev">
                <?php
                    echo $paginator->prev(
                        __( 'Prev', true ),
                        array(
                            'escape' => false,
                            'tag' => 'span',
                            'class' => ''
                        ),
                        null,
                        array(
                            'escape' => false,
                            'tag' => 'span',
                            'class' => ''
                        )
                    );
                ?>
            </div>
        </div>
        <div class="button2-left">
            <div class="numbers">
                <?php
                    $numbers = $paginator->numbers(
                        array(
                            'tag' => 'span',
                            'before' => null,
                            'after' => null,
                            'model' => null,
                            'modulus' => '8',
                            'separator' => '',
                            'first' => null,
                            'last' => null
                        )
                    );

                    if ( $numbers === false )
                    {
                        echo '<span><b>1</b></span>';
                    }
                    else
                    {
                        echo $numbers;
                    }
                ?>
                <span class="blank"></span>
            </div>
        </div>
        <div class="button2-left">
            <div class="next">
                <?php
                    echo $paginator->prev(
                        __( 'Next', true ),
                        array(
                            'escape' => false,
                            'tag' => 'span',
                            'class' => ''
                        ),
                        null,
                        array(
                            'escape' => false,
                            'tag' => 'span',
                            'class' => ''
                        )
                    );
                ?>
            </div>
        </div>
        <div class="button2-left">
            <div class="last">
                <?php
                    echo $this->Html->link(
                        __( 'End', true ),
                        $paginator->url(
                            array(
                                'page' => $paginator->params['paging'][Inflector::singularize( $this->name )]['pageCount']
                            ),
                            true
                        )
                    );
                ?>
            </div>
        </div>
        <span>
            <?php echo $this->Letter->paginationCounter( $paginator ); ?>
        </span>
        <div class="clr">&nbsp;</div>
    </div>
</div>