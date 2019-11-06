# Layout files

As Yii2 makes it easy to style your app using layout files i wanted to make it easy to style the various views without having to do any complex config file edits to make it work. Typically you could do controllerMap and overide each controller but that would be laborious and tedious. Therefore there is an easy way to set the modules various layout files.

# Admin layout file

The admin layout file is called in the admin controller and the controllers under the sub folder /admin in the controllers folder. 

You can set it by specifying the module option in your app's config file as shown by the example below

```
'modules' => [
    'module-base' => [
        'class' => 'artbyrab\Yii2ModuleBase\Module',
        'adminLayoutViewFilePath' => '@app/views/layouts/admin.php',
    ],
],
```

If you want to understand how the layout works all the admin controllers extend a BaseAdminController class.

```
/**
 * Base Admin Controller
 * 
 * The base admin controller will implement the RBAC for the admin controllers 
 * in the module. As we want to only allow logged in users, and also logged in 
 * users that have been assigned the role 'productPackagesAdmin' which is the 
 * admin role for this module.
 * 
 * @author artbyrab
 */
class BaseAdminController extends Controller
{
...
```

This has a bit of code in the beforeAction that set's the layout if it exists in your module options.

```
public function setAdminLayout()
{
    $module = Yii::$app->controller->module->id;
    $adminModuleViewFilePath = \Yii::$app->getModule($module)->adminLayoutViewFilePath;

    if (isset($adminModuleViewFilePath) && !empty($adminModuleViewFilePath)) {
        $this->layout = $adminModuleViewFilePath;
    }
}
```


