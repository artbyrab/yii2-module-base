# Building your module

Before building your own module on the top of this one, it is definately worth running this module by starting the server as per the install guide and having a look at the various files and folders and trying to understand how it all works.

## Replacing module settings

### Quirks

Please note there are various quirks involved with automatically replacing these values. please see the comments on the module settings below for more detail.

If you want to build your module on top of this one you will need to find and replace various module settings to get started. There are 2 ways you can replace the text, manually or using the built in console command.

### What are the module settings

Below are the module settings that need to be replaced:
```
{
    "package-name-camel-case": "Yii2ModuleBase", 
        - the package name used in Yii2 Alias, package namespaces, Yii2 translations and more, should adhere to PSR-4
    "package-name": "Yii2 Module Base", 
        - the package name used in view files etc for display purposes
    "package-author-name": "artbyrab", 
        - your name as an author, used in Yii2 Alias, package namespaces and more, should adhere to PSR-4
    "config-package-name-and-route": "module-base"
        - default route of the module, used in the URL and also in various view partial renders, this will be www.yourwebsite/module-base to access the modules default controller for example
    "rbac-admin-name-camel-case": "moduleBaseAdmin",
        - used in the RBAC, should be camelCase and should be more descriptive than just admin, preferably a camel cased version of your package name sans the Yii2 
    "rbac-admin-name-studly-caps": "ModuleBaseAdmin"
        -used in the RBAC, should be StudlyCaps and should be more descriptive than just admin, preferably a studly caps version of your package name sans the Yii2 
}
```

### The module settings files

The module attribute files are stored in the root of the module:
```
module-settings.json
module-settings-example.json
```

### 1) Manually replacing the text

If you wish to manually replace the text you should open up the module settings files.

The module-settings-example.json is what the module currently uses, you should fill in the values in module-settings with your new values. Next simply replace each one at a time in the order they are in the file.

### 2) Automatically replacing the text

If you prefer you can use the built in console command to automatically replace the text. To do this follow the steps below: 

* fill in the module-settings.json file
* open up a terminal in the module root and navigate to the modules src/tests folder:
```
$ cd src/tests
```

* run the following command as a dry run

```
$ php yii module-settings/replace - dryrun=True
```

* If you don't get any errors and you wish to go ahead run the following:
```
$ php yii module-settings/replace - dryrun
```

### 3) Manual changes

Please note, regardless of which method you use you will also have to:

* Rename the module folders manually
    * Simply change them to match your composer namespace
* You may need to edit the composer file manually, change the following:
    * name
    * description
    * keywords
    * authors
    * autoload psr-4 paths to match yournamespace

### 4) Create RBAC and assets folders

You will need to manually create a couple of folders
