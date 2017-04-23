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

