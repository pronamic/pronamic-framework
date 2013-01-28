# Pronamic Plugin Framework

---

## Components

- Pronamic_Autoload
- Pronamic_View
- Pronamic/Settings

---

### Pronamic_Autoload

The Autoloader class is a simple class to streamline the loading of classes in plugins.  It requires a check to ensure the class doesn't already exist ( from another plugin for example )

#### Usage:

```php

<?php
    
    if ( ! class_exists( 'Pronamic_Autoload' ) ) {
        include( '/lib/Pronamic/Autoload.php' );
        Pronamic_Autoload::register();
    }
        
    Pronamic_Autoload::add_directory( dirname( __FILE__ ) . '/lib' );
        
```

### Pronamic_View

The Viewloader, is a class to simplify loading views for the many callback methods for WordPress plugins.  It helps seperate the logic and make cleaner plugins.

#### Simple Usage:

```php
<?php

    $view = new Pronamic_View( dirname( __FILE__ ) . '/views' );
    $view
        ->set_view( 'name_of_view_file' )
        ->set( 'variable', 'value' )
        ->render();

```

### Pronamic/Settings

These are a collection of classes that simplify the creation of settings pages. ( it is still an ongoing component and not fully fleshed out )

#### Usage:
##### Renderer
The renderer is the class that holds all the methods to show the many types of input available for settings. 

_Note: Preferably this would be an interface, other people can then extend that interface with additional inputs for specific purposes in their plugin.  For now its a normal class._

```php
<?php

    // Define a renderer
    $settings_renderer = new Pronamic_Settings_Renderer();

```

##### Section
The section is your collection of settings under a common title/name (see add_settings_section )

```php
<?php

    // A new section
    $base_section = new Pronamic_Settings_Section( 'ppf_settings_base' );
    $base_section
        ->set_title( 'Pronamic Settings Base Section' )
        ->set_page( 'page_slug_you_want_settings_on' );

```

##### Field
The field is the actual input shown, and which will be associated with a section

```php
<?php

    // Extra Title Field
    $extra_title = new Pronamic_Settings_Field( 'ppf_extra_title' );
    $extra_title
        ->set_title( 'PPF Extra Title' )
        ->set_type( 'text' );
```

Once all settings have been defined, and you are ready to register and show those settings, you must pass in the new fields into the Pronamic_Settings_Section of your choosing.  

#### Show and Register

```php
<?php

    // Register these settings
    $base_section
        ->set_field_renderer( $settings_renderer )
        ->add_field( $extra_title )
        ->register( 'option_group_name' );
```

Some more detailed documentation to come.