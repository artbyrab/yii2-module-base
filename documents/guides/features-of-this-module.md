# Features of this module

This module contains lots of features designed to show how you can do various things with Yii2 modules. The reason i built this module was that i simply struggled to understand how to do some of these things myself. I started to build my own modules and then struggled to implement testing and learn how to configure routes, RBAC and more. I looked on Github at some of the many amazing Yii2 modules but many of them had various ways to achieve similar things and very few were implement testing in the same way you might see it in the basic Yii2 app. This is why i created this module to hopefully give a little back to everyone using the amazing Yii2 framework.

## Features

Below are each of the features of the module explained in a bit more detail.

### Using an SqlLite database

This module has an SqlLite database that just makes getting started nice and easy. Do you have to use this database? No just configure the one you want as normal in your config files.

### Easy unit and functional testing

This module has unit and functional testing built in which can be used as an easy example of how to test your own module.

### Translation

This module has translations working already. They are registered in the main src/Module.php file and you can learn more by reading the internationalisation guide here.

### Using app assets

If your module needs to have its own CSS, custom javascript or something similar then you might need to have a custom app asset. This module already implements an app asset which you can see by looking at the src/assets folder.

### URL rule groups

This module uses a custom URL rule group to prettyfy the CRUD views for modules under the module-base/admin route. The reason for using a rule group is detailed in the Yii2 official guide and we specify it in the src/Module.php file and then you have to bootstrap it into your app via its config file. You can see an example of the bootstrapping into the config file in the test app at src/tests/app/config/test.php file.

### RBAC

This module utilises Role Based Access Control to limit the module-base/admin routes to logged in users. You can learn more about it by reading the RBAC guide included in this module.

### Sub controllers

Sub controllers are utilised in this module to build a simple admin area. You can look into how this works more by investigating the src/controllers folder.

### Module attributes

Module attributes are just that, the various attributes of a module that are all overwritable when you configure the module for use in your parent app.

### Overriding view files

Overriding view files is easy using the built in Yii2 functionality.

### Overriding models via Yii2 dependency injection

Overriding models is possible thanks to the Yii2 dependency injection functionality. You can see a working example of it here in this module's app folder.

### Overriding controllers

Overriding controllers is easy using the built in Yii2 functionality.

### Commands and running commands from modules

It is simple to run commands from modules and you can see an example of how to get it to work in this module's Module file.

### PHP-CS-Fixer

php-cs-fixer is included to run code checks and you can learn how to utilise it via reading the code-checks guide included in this module.

### Yii2 app included in the module

To get this up and running just have a look at the testing guide included in this module.