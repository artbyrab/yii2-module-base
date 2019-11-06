# Overriding routes

If you want to override any of the default routes from the module it is easy. 

* First you need to set the module to not load it's own url rules so you can overwrite them. To do that set it when intialising the module in your app's config file as below. Just change the names below from this module's name to whatever this module is.

```
'modules' => [
    'this-modules-name' => [
        'class' => 'artbyrab\Yii2ThisModulesName\Module',
        'useModuleUrlRules' => False,
    ],
    ...
```

* Update your config file, whether it is web.php, test.php or another name
* In the 'urlManager' section add in the routes you wish to overide
* Please see the example below:

```
...
'urlManager' => [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '/your/new/route/index' => '/module/existing/route/index',
        '/your/new/route/section/create' => '/module/existing/route/section/create',
    ],
...
```

In this particular module the routes you can overide are:
```
// frontend tier pages
'/your/new/route' => '/tiers/index', // main tiers index page
// backend/admin tier pages
'/your/new/route' => '/tiers/admin/index', // tiers admin index page
'/your/new/route' => '/tiers/admin/tier/index', // tiers admin tier model index page
'/your/new/route' => '/tiers/admin/tier/create', // tiers admin create a new tier page
'/your/new/route' => '/tiers/admin/tier/<id:\d+>', // tiers admin view a tier page
'/your/new/route' => '/tiers/admin/tier/<id:\d+>/update', // tiers admin update a tier page
'/your/new/route' => '/tiers/admin/tier/<id:\d+>/delete', // tiers admin delete a tier page
'/your/new/route' => '/tiers/admin/tier/search', // tiers admin search for a tier
```