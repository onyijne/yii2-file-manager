<?php

/**
 * @copyright Copyright (c) 2013-2017 Sajflow Services
 * @link https://www.sajflow.com
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

namespace tecsin\filemanager\elFinder;

use yii\jui\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * Renders the elFinder file manager for web
 *
 * @author Samuel Onyijne <samuel@sajflow.com>
 */
class ElFinderWidget extends Widget
{
    
    /**
     * @var array clientOptions the js options for the WYSIWYG configuration.
     * @see https://github.com/elfinder/wiki For full list of configurable options.
     */
    public $clientOptions = [];
    
    public $id = 'elfinder';
    
    public $useWithTinyMCE = false;


    public function init() {
        parent::init();
        if(!ArrayHelper::keyExists('url', $this->clientOptions)){
            throw \yii\base\InvalidConfigException('Url key is missing in clientOptions');
        }
    }

    public function run() {
        echo Html::tag('div', '', ['id' => $this->id]);
        $this->register();
    }

    public function register() {
        $view = $this->getView();
        ElFinderAsset::register($view);
        $options = Json::encode($this->clientOptions);
        $view->registerJs(($this->useWithTinyMCE == false) ? $this->js($options) : $this->tinymce($options));
    }
    
    public function js($options) {
          $js = <<< JS
        var options = $options;
                  
        $('#$this->id').elfinder(options);
JS;
          return $js;
    }
    
    public function tinymce($options) {
          $js = <<< JS
        let options = $options;
        options['getFileCallback'] =  function(file) { 
                     
        FileBrowserDialogue.mySubmit(file, elf); // pass selected file path to TinyMCE 
      }
        var elf = $('#$this->id').elfinder(options).elfinder('instance');
        var FileBrowserDialogue = {
            init: function() {
            // Here goes your code for setting your custom things onLoad.
            },
            mySubmit: function (file, elf) {
               // pass selected file data to TinyMCE
                parent.tinymce.activeEditor.windowManager.getParams().oninsert(file, elf);
               // close popup window
               parent.tinymce.activeEditor.windowManager.close();
            }
        }
JS;
          return $js;
    }
}
