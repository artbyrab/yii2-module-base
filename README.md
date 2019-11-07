# Yii2 Module Base

![Image](files/graphics/yii2-module-base-plain-logo-large.png?raw=true)

## Overview

This is a base module you can use to create new Yii2 modules suitable for installation with Composer.

The key points of this module are:

* Easy way to see a working Yii2 module
* A simple base to build your own Yii2 module from
* Working features and examples of the following:
    * Using an SqlLite database
    * Unit testing of a module
    * Functional testing of a module
    * Translating a module
    * Using AppAssets in your module
    * UrlRuleGroups in modules
    * RBAC in modules
    * Using sub controllers in modules
    * Module attributes
    * Overriding view files
    * Overriding models via Yii2 dependancy injection
    * Overriding controllers
    * Commands and running commands from modules
    * php-cs-fixer included to clean your code to PSR standards
* A Yii2 app included in the module
    * When running locally you can view your app while building it
    * No need to install a seperate Yii2 app
    * Makes version control very simple

## Why did i create this?

I created this module base because i myself really struggled to find a comprehensive tutorial when i was building my own Yii2 modules. The official Yii2 documenation is great, but it does not cover everything you might want in a module. Specifically i struggled with various parts of building a module including RBAC, translating, testing, testing databases, URL routing, module attributes, overriding layouts, sub controllers and more.

Therefore this module contains an example module with a built in Yii2 app for local viewing and testing of the module. This saves you having to install a new Yii2 app and then installing the module to view it. Therefore, local development of your module will be vastly simplified and there are examples of key things you may want to utilise in your own module.

## Installing

As you will use the module as a base you simply want to git clone it to your local workspace

```
$ git clone https://artbyrab@bitbucket.org/artbyrab/yii2-module-base.git your-app-name-here
```

Then you need to setup the rest of the install. Please read the full install guide in our guides section below.

## Guides

In alphabetic order below are the guides for the module:

* [Building your module](documents/guides/building-your-module.md)
* [Code checks](documents/guides/code-checks.md)
* [Databases](documents/guides/databases.md)
* [Features of this module](documents/guides/features-of-this-module.md)
* [Installing the module](documents/guides/installing.md)
* [Internationalisation in the module](documents/guides/internationalisation.md)
* [Layout files](documents/guides/layout-files.md)
* [Migrations](documents/guides/migrations.md)
* [Overriding Controllers](documents/guides/overriding-controllers.md)
* [Overriding Models](documents/guides/overriding-models.md)
* [Overriding Routes](documents/guides/overriding-routes.md)
* [Role Based Access Control](documents/guides/rbac.md)
* [Resources - Third party useful resources](documents/guides/resources.md)
* [Testing the module](documents/guides/testing.md)
* [Using your module in a Yii2 app](documents/guides/using-your-module-in-a-yii2-app.md)