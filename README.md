# Winter MVC

Extra lightweight MVC library suitable for WordPress Plugins or other cases, inspired by CodeIgniter

# How to integrate into WordPress Plugin?

To simplify development, make code structure naicer and easy to maintain we suggestint to use WP Boilerplate file structure: https://wppb.me/

Copy Winter_MVC folder into: wp-content\plugins\{your-plugin-name}\vendor

Create application structure:

```
wp-content\plugins\{your-plugin-name}\application
wp-content\plugins\{your-plugin-name}\application\controllers
wp-content\plugins\{your-plugin-name}\application\core
wp-content\plugins\{your-plugin-name}\application\models
wp-content\plugins\{your-plugin-name}\application\views
```

In your plugin admin file, if you using wppb: wp-content\plugins\{your-plugin-name}\admin\class-{your-plugin-name}-admin.php

Create method admin_page_display()

```
public function admin_page_display() {
  global $Winter_MVC;

  $page = '';
      $function = '';

  if(isset($_GET['page']))$page = wmvc_xss_clean($_GET['page']);
  if(isset($_GET['function']))$function = wmvc_xss_clean($_GET['function']);

  $Winter_MVC = new MVC_Loader(plugin_dir_path( __FILE__ ).'../');
  $Winter_MVC->load_helper('basic');
  $Winter_MVC->load_controller($page, $function, array());
}
```

this method you can call from wp menu this way:

```
add_submenu_page(..., array($this, 'admin_page_display'));
```

Based on page and funciton GET parameters, library will call specific controller file and method/function:

```
wp-content\plugins\{your-plugin-name}\application\controllers\{Your-plugin-name}.php
```

First character uppercase!

Create this controller file and class should look like:

```
<?php
defined('WINTER_MVC_PATH') OR exit('No direct script access allowed');

class {Your-plugin-name}_index extends Winter_MVC_Controller {

	public function __construct(){
		parent::__construct();
	}
    
	public function index()
	{
        // Your controller logic code cooming here
        
        // Load view
        $this->load->view('{your-plugin-name}/index', $this->data);
  }
	public function datatable()...

```

in this example we added _index in classname as example but have in mind that this is not required, but useful only if class {Your-plugin-name} already exists what is common if using wppb

Create also your view file:

```
wp-content\plugins\{your-plugin-name}\application\views\{your-plugin-name}\index.php
```

# Changelog

v2.5, 03-12-2022

- Upload multiple added support video upload

v2.4, 29-10-2022

- Form validation for json mobile APIs

v2.3, 20-07-2022

- Child theme support for view files
- Versioning improvements

v2.2, 08-06-2022

- XSS improvements
- DB limit query improvements
- Media Element improvement

...