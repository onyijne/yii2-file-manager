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

class ElFinderAsset extends AssetBundle
{
    public $sourcePath = '@vendor/studio-42/elfinder/';

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
    ];
    public function init()
    {
        parent::init();
        $this->js[] = YII_DEBUG ? 'js/elfinder.full.js' : 'js/elfinder.min.js';
        $this->css[] =  YII_DEBUG ? 'css/elfinder.min.css' : 'css/elfinder.full.css';
        $this->css[] = 'css/theme.css';
    }
}