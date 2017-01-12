<?php
/**
 * @copyright Copyright (c) 2013-2017 Sajflow Services
 * @link https://www.sajflow.com
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace tecsin\filemanager\tinyMCE;

use yii\web\AssetBundle;

class TinymceLangAsset extends AssetBundle
{
    public $sourcePath = '@vendor/tecsin/yii2-file-manager/tinyMCE/assets';

    public $depends = [
        'tecsin\filemanager\tinyMCE\TinymceAsset'
    ];
}
