Yii2 File Manager
=================
A file manager on elFinder 2.1.20 and TinyMCE 4 for Yii2

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
    use \tecsin\filemanager\FileManagerTrait;
    
    public function actionFileManager() {
        return $this->render('file-manager');
    }
   
  public function actionUpload(){
      $this->_uploadPath = Yii::getAlias('@webroot').'/files/';
      $this->_uploadUrl = Yii::getAlias('@web').'/files/';
      $this->connector();
  }
  
  public function actionFileBrowser(){
      return $this->renderAjax('file-browser');//use ajax not to have a new site load in the file browser window
  }
  
}
```

elFinder File Manager for Web  :
file-manager action view file
-----

```php

<?= \tecsin\filemanager\elFinder\ElFinderWidget::widget([
    'id' => 'working',
    'clientOptions' => [
        'url' => '/admin/upload'
    ]
]); ?>
```

tinyMCE WYSIWYG Editor  :
with model
-----

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
-----

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
-----

```php
<?= \tecsin\filemanager\elFinder\ElFinderWidget::widget([
    'id' => 'working',
    'useWithTinyMCE' => true,//REQUIRED
    'clientOptions' => [
        'url' => '/admin/upload'
    ]
]); ?>
```