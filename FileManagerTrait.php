<?php

/**
 * @copyright Copyright (c) 2013-2017 Sajflow Services
 * @link https://www.sajflow.com
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

namespace tecsin\filemanager;

use \elFinder;
use \elFinderConnector;
use yii\web\Response;

/**
 * Description of FileManager
 *
 * @author Samuel Onyijne <samuel@sajflow.com>
 */
Trait FileManagerTrait {
    public  $debug = false; 
    public  $ftpUser = '';
    public  $ftpPassword = '';
    public  $ftpDir = '/';
    public  $ftpHost = 'localhost';
    public  $ftpTimeOut = 10;
    public  $_uploadPath;
    public  $_uploadUrl;
    
    public function access($attr, $path, $data, $volume) {
	return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
    }
     
    /**
     * call the connector method in an action specfied as the connector url for file manager. 
     * You can call your options inside the action calling this method before calling this method.
     */
     public function connector() {
        // Enable FTP connector netmount
         elFinder::$netDrivers['ftp'] = 'FTP';
         $this->access('write', '/', '', '');
         $opts = [
	    'debug' => $this->debug,
	    'roots' => $this->volumeRoots()
         ];
\Yii::$app->response->format = Response::FORMAT_JSON;
         $connector = new elFinderConnector(new elFinder($opts));
         $connector->run();
    
    }
    
    /**
     * 
     * @return array the volumn roots to use in options. override this methos to change roots settings
     */
    public function volumeRoots(){
        return [
		[
			'driver'        => 'LocalFileSystem',           // driver for accessing file system (REQUIRED)
			'path'          => $this->uploadPath, // path to files (REQUIRED)
			'URL'           => $this->uploadUrl, // URL to files (REQUIRED)
			//'uploadDeny'    => array('all'),                // All Mimetypes not allowed to upload
			//'uploadAllow'   => array('image', 'text/plain'),// Mimetype `image` and `text/plain` allowed to upload
			//'uploadOrder'   => array('deny', 'allow'),      // allowed Mimetype `image` and `text/plain` only
			'accessControl' => 'access'                     // disable and hide dot starting files (OPTIONAL)
		],
            [
                        'driver'        => 'FTP',
                        'host'          => $this->ftpHost,
                        'user'          => $this->ftpUser,
                        'pass'          => $this->ftpPassword,
                        'port'          => 21,
                        'mode'          => 'passive',
                        'path'          => $this->ftpDir,
                        'timeout'       => $this->ftpTimeOut,
                        'owner'         => true,
                        'dirMode'       => 0755,
                        'fileMode'      => 0644
            ]
	];
    }
    
    public function setUploadPath($path){
        $this->_uploadPath = (isset($path))? $path : \Yii::getAlias('@web').'/uploads/';
        return $this->_uploadPath;
    }
    
    public function getUploadPath(){
        return $this->_uploadPath;
    }

    public function setUploadUrl($url = ''){
        $this->_uploadUrl = (isset($url))? $url : \Yii::getAlias('@web').'/uploads/';
        return $this->_uploadUrl;
    }
    
    public function getUploadUrl(){
        return $this->_uploadUrl;
    }
    
    public function actionUpload(){
        
    }
}
