Yii2 File Manager
=================
A file manager on elFinder 2.1.20 and TinyMCE 4 for Yii2

PLEASE NOTE
------------
This extension is no longer maintained. The two components which make up this extension has been split into two 
different extensions for ease of maintenance and future development.

elFinder is now at [elFinder](https://github.com/tecsin/yii2-elfinder) while 
tinyMCE is now at [tinyMCE](https://github.com/tecsin/yii2-tinymce) 

Please use the above extensions for new installs. 
As for old installs, it is easy to migrate, just remove 

```
"tecsin/yii2-file-manager": "*"
```
from the require part of your composer.json file and add

```
"tecsin/yii2-elfinder": "*"
```
and 

```
"tecsin/yii2-tinymce": "*"
```
then change the namespace accordingly in the files you have used them.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist tecsin/yii2-file-manager "*"
```

or add

```
"tecsin/yii2-file-manager": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Controller

```php
class AdminController extends Controller
{
    
    public function actionFileManager() {
        return $this->render('file-manager');
    }
   
  public function actionUpload(){
     $fileManager = new \tecsin\filemanager\FileManager();
      $fileManager->_uploadPath = Yii::getAlias('@webroot').'/files/';
      $fileManager->_uploadUrl = Yii::getAlias('@web').'/files/';
      /*to use google drive starts. OPTIONAL*/
      $fileManager->googleDrive = [
                  'clientID' => 'xxxxxx',
                  'clientSecret' => 'xxxxxxx',
                  'refreshToken' => 'xxxxxx',
                  'useCache' => true //optional
                  ]; 
      /*to use google drive ends*/
      $fileManager->connector();
  }
  
  public function actionFileBrowser(){
      return $this->renderAjax('file-browser');//use ajax not to have a new site load in the file browser window
  }
  
}
```

elFinder File Manager for Web  :
-----
file-manager action view file


```php

<?= \tecsin\filemanager\elFinder\ElFinderWidget::widget([
    'id' => 'working',
    'clientOptions' => [
        'url' => '/admin/upload'
    ]
]); ?>
```

tinyMCE WYSIWYG Editor  :
-----
with model


```php
<?= $form->field($model, 'content')->widget(\tecsin\filemanager\tinyMCE\Tinymce::className(), [
    'options' => ['rows' => 6],
    'language' => 'en_GB',
    'clientOptions' => [
        'plugins' => [
            "image imagetools  lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        'toolbar' => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons "
    ],
/*elfinder options*/
'file'  => '/admin/file-browser',//relative or absolute url
'title' => 'file browser',
'width' => 750,
'height' => 350,
'resizable' => 'yes'
]);?>
```

without model


```php
<?= \tecsin\filemanager\tinyMCE\Tinymce::widget([
    'options' => ['rows' => 6],
    'language' => 'en_GB',
    'clientOptions' => [
        'plugins' => [
            "image imagetools  lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        'toolbar' => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons "
    ]
]); ?>
```


file-browser file


```php
<?= \tecsin\filemanager\elFinder\ElFinderWidget::widget([
    'id' => 'working',
    'useWithTinyMCE' => true,//REQUIRED
    'clientOptions' => [
        'url' => '/admin/upload'
    ]
]); ?>
```
