# Pronamic Framework

---

## Components

- Pronamic/Base
- Pronamic/Settings
- Pronamic/Helper

## Pronamic/Base
### Pronamic_Base_Autoload (formerly Pronamic_Autoload)

The autoloader class has been written.  It is now a slightly more complex class that allows for you to specify newer versions of components or individual classes.

#### Usage:
##### Including the class
You require a check to determine if the class exists due to any other existing plugin or theme that may be using pronamic-framework.  A simple statement to include the Pronamic_Base_Autoload from your local plugin/themes pronamic-framework copy is all that is required.

```php
    if ( ! class_exists( 'Pronamic_Base_Autoload' ) )
        include( 'pronamic-framework/Pronamic/Base/Autoload.php' );

```
##### Retrieving the Autoloaders instance
The Pronamic_Base_Autoload is a Singleton object, as it seemed the easiest method to support the features required to allow specifying the location, and in turn, the usage, of newer versions of pronamic-framework classes.

So to start, retrieving the instance of the autoloader is required

```php
    $autoload = Pronamic_Base_Autoload::get_instance();
```

##### Components
Pronamic_Base_Autoload allows you to specify which components you wish to use from the pronamic-framework.

```php
    $autoload->register_components( array( 
        "Pronamic\\Base" => __DIR__ . '/pronamic-framework'
    ) );
```
This is the registration of all components inside the pronamic-framework\Pronamic\Base folder.  You could, for easier sake, just reference the entire Pronamic folder if you want everything from the pronamic-framework.

```php
    $autoload->register_components( array(
        "Pronamic" => __DIR__ . '/pronamic-framework'
    ) );
```

##### Classes
Pronamic_Base_Autoload allows you to also specify exact classes you want.  This could be useful for overiding a component class, or classes from another project that you dont want to keep inside your plugins/themes library folder.

```php
    $autoload->register_classes( array(
        "Pronamic_Base_View" => __DIR__ . '/location/to/file.php'
    ) );
```
The reference must include the extension.

##### Folders
Pronamic_Base_Autoload allows you to specify folders for other classes.  This can be useful for your own plugin or themes class files.  The naming convention is the PEAR convention, so Underscores represent folders.

```php
    $autoload->register_folders( array( 
        __DIR__ . '/lib'
    ) );
```

The priority of the autoloader values files in the folders, then specified classes to finially the register components.  So you can overide classes inside your lib folder if you want.

##### Versioning
As the way it works at the moment, the class files have a version and component number located in the comment block at the top.  The autoloader will prefer the later versions of a class or component regardless of when it was registered. This will guarantee that even if an older plugin has an older version of pronamic-framework, that your new plugin, using a newer pronamic-framework, will correctly get access to the methods it needs.

Development of the pronamic-framework will be sure to protect backwards compatibility with older versions, so that even if the old plugin is now using the new pronamic-framework, you wont have to change anything. ( from here on in )


### Pronamic_Base_View (formerly Pronamic_View)

The Viewloader, is a class to simplify loading views for the many callback methods for WordPress plugins.  It helps seperate the logic and make cleaner plugins.

#### Simple Usage:

```php
    $view = new Pronamic_View( dirname( __FILE__ ) . '/views' );
    $view
        ->set_view( 'name_of_view_file' )
        ->set( 'variable', 'value' )
        ->render();

```

_The only thing that has changed with this class, is its location, and name._

## Pronamic/Settings

These are a collection of classes that simplify the creation of settings pages. ( it is still an ongoing component and not fully fleshed out )

### Pronamic_Settings_Renderer
The renderer is the class that holds all the methods to show the many types of input available for settings. 
_Note: You could overide this class now with your own Renderer with the autoloader_
#### Usage:

```php
    $settings_renderer = new Pronamic_Settings_Renderer();
```

### Pronamic_Settings_Section
The section is your collection of settings under a common title/name (see add_settings_section )
#### Usage:
```php
    $base_section = new Pronamic_Settings_Section( 'ppf_settings_base' );
    $base_section
        ->set_title( 'Pronamic Settings Base Section' )
        ->set_page( 'page_slug_you_want_settings_on' );

```

### Pronamic_Settings_Field
The field is the actual input shown, and which will be associated with a section
#### Usage:
```php
    $extra_title = new Pronamic_Settings_Field( 'ppf_extra_title' );
    $extra_title
        ->set_title( 'PPF Extra Title' )
        ->set_type( 'text' );
```

Once all settings have been defined, and you are ready to register and show those settings, you must pass in the new fields into the Pronamic_Settings_Section of your choosing.  

#### Show and Register

```php
    $base_section
        ->set_field_renderer( $settings_renderer )
        ->add_field( $extra_title )
        ->register( 'option_group_name' );
```

## Pronamic\Helper

### Pronamic_Helper_Html
This is a helper static class for rendering HTML elements.  
At the moment it supports the following:

- text
- select
- textarea
- button
- radio
- hidden
- password

#### Pronamic_Helper_Html::text()
```php
    echo Pronamic_Helper_Html::text( 'inputname', 'inputid', 'value', [ 'class1', 'class2' ] );
    echo Pronamic_Helper_Html::hidden( 'inputname', 'inputid', 'value', [ 'class1', 'class2' ] );
    echo Pronamic_Helper_Html::password( 'inputname', 'inputid', 'value', [ 'class1', 'class2' ] );
```
```html
    <input type="text" name="inputname" id="inputid" value="value" class="class1 class2" />
    <input type="hidden" name="inputname" id="inputid" value="value" class="class1 class2" />
    <input type="password" name="inputname" id="inputid" value="value" class="class1 class2" />
```

#### Pronamic_Helper_Html::select()

```php
    echo Pronamic_Helper_Html::select( 'selectname', 'selectid', '1', ['Yes' => 1, 'No' => 0], ['class1', 'class2'] );
```

```html
<select name="selectname" id="selectid">
    <option value="1" selected="selected">Yes</option>
    <option value="0">No</option>
</select>
```