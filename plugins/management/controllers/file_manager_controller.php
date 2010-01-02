<?php
    /**
     *
     *
     */
    class FileManagerController extends ManagementAppController
    {
        var $name = 'FileManager';

        var $uses = array( 'Management.Files' ); //'Management.Folder' );

        function admin_index( $path = null )
        {
            $this->Files->recursive = 2;
            $files = $this->Files->find(
                'all',
                array(
                    'fields' => array(
                    ),
                    'conditions' => array(
                        'path' => '/'
                    ),
                    'order' => array(
                        'name' => 'ASC'
                    )
                )
            );

            $this->set( compact( 'files' ) );
        }

        function admin_view( $file = null )
        {
            if ( !$file )
            {
                $this->Session->setFlash( __( 'Please select a file first', true ) );
                $this->redirect( $this->referer() );
            }

            // @todo mediaViews
        }

        function admin_download( $file = null )
        {
            if ( !$file )
            {
                $this->Session->setFlash( __( 'Please select a file first', true ) );
                $this->redirect( $this->referer() );
            }

            // @todo mediaViews
        }

        function admin_delete( $file = null )
        {
            if ( !$file )
            {
                $this->Session->setFlash( __( 'Please select a file first', true ) );
                $this->redirect( $this->referer() );
            }

            if ( $this->FileManager->delete( $file ) )
            {
                $this->Session->setFlash( __( 'File deleted', true ) );
                $this->redirect( $this->referer() );
            }

            $this->Session->setFlash( __( 'File could not be deleted', true ) );
            $this->redirect( $this->referer() );
        }
    }
?>