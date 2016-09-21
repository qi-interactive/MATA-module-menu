MATA Module Menu
==========================================

Manages and groups modules for MATA applications.

Installation
------------

- Add the module using composer:

```json
"mata/mata-module-menu": "~1.0.0"
```

-  Run migrations
```
php yii migrate/up --migrationPath=@vendor/mata/mata-module-menu/migrations
```


Changelog
---------

## 1.0.3.5-alpha, September 21, 2016

- Reverted changes from the previous release

## 1.0.3.4-alpha, September 19, 2016

- Saving ModuleId via addModuleMenuPrompt in lowercase

## 1.0.3.3-alpha, September 24, 2015

- Added additional links for subnavigation items

## 1.0.3.2-alpha, September 16, 2015

- Updated migration for matamodulemenu_module (change Id from Int to Varchar)

## 1.0.3.1-alpha, August 23, 2015

- Updated ModuleMenuManager and added migration for removing mata modules

## 1.0.3-alpha, August 21, 2015

- Added ModuleMenuManager

## 1.0.2-alpha, July 20, 2015

- Added migration for matamodulemenu_module (change Id from Int to Varchar)

## 1.0.1-alpha, June 9, 2015

- Added dependency on mata/mata-framework : ~1.1.0-alpha

## 1.0.0-alpha, May 18, 2015

- Initial release.
