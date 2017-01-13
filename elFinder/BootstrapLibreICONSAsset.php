<?php

/**
 * @copyright Copyright (c) 2013-2017 Sajflow Services
 * @link https://www.sajflow.com
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

namespace tecsin\filemanager\elFinder;

use yii\web\AssetBundle;

/**
 * REGISTERS ASSETS FOR ELFINDER
 *
 * @author Samuel Onyijne <samuel@sajflow.com>
 */

class BootstrapLibreICONSAsset extends AssetBundle
{
    public $sourcePath = '@vendor/tecsin/yii2-file-manager/assets/';

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
    ];
    public function init()
    {
        parent::init();
        $this->css[] =  'css/theme-bootstrap-libreicons-svg.css';
    }
}