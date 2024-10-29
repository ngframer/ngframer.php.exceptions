# Using Exception Renderer
This guide will show you how to use the exception renderer to render exceptions in a custom way.


## 1. Identifying the initial point
The first step is to identify the initial point where the application starts from.  
If you're using 'ngframer.php,' the initial point is index.php inside the public directory.  
If you're using a different file, you should identify the file that is the entry point of your application.


## 2. Creating a handler class
If you're in 'ngframer.php,' it's available by default on ```project/exceptions/factory```.  
To create your own renders, place it inside ```project/exceptions/renderers```.  
Else, you can use the following code:

```php
<?php

namespace app\exceptions\factory;

use Throwable;
use Exception;
use app\config\ApplicationConfig;
use NGFramer\NGFramerPHPExceptions\Render;
use NGFramer\NGFramerPHPExceptions\Exceptions\BaseError;
use NGFramer\NGFramerPHPExceptions\Renderer\Supportive\BaseRenderer;

class RendererFactory
{
    /**
     * Function to handle exceptions globally.
     *
     * @param Throwable $exception
     * @throws Exception
     */
    public function globalHandler(Throwable $exception): void
    {
        // Get the AppMode from the config.
        // If you're not using ngframer.php, get config data your own way.
        // For ngframer.php, you can use the following code.
        $appMode = ApplicationConfig::get('appMode');

        // Check if the appMode is development.
        // Applicable to if you're using ngframer.php or not.
        if ($appMode == 'development') {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        } else {
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
            error_reporting(E_ALL);
        }

        // Use this snippet of code to use your own renderer.
        // $renderer = $this->create();
        // Use this snippet of code to use the default renderer.
        $renderer = Render::create();

        // This will be applicable to both the default and custom renderer.
        $renderer->render($exception);
    }

    /**
     * Function to register the exception handler.
     */
    public function register(): void
    {
        set_error_handler([(new BaseError()), 'convertToException']);
        set_exception_handler([$this, 'globalHandler']);
    }

    /**
     * Function to create a new renderer factory.
     * Creates and returns an appropriate Exception renderer based on the environment.
     *
     * @returns BaseRenderer
     */
    public static function create(): BaseRenderer
    {
        // Check the environment and return the appropriate renderer.
        // Check if the environment is cli.
        if (php_sapi_name() === 'cli') {
            return new CLIExceptionRenderer();
        }

        // Check if the environment is api.
        if (ApplicationConfig::get('appType') === 'api') {
            if (ApplicationConfig::get('appMode') === 'development') {
                return new ApiExceptionDevelopmentRenderer();
            }
            return new ApiExceptionProductionRenderer();
        }

        // If the environment is not cli or api, return the default renderer.
        return new HtmlExceptionRenderer();
    }
}
```

Make changes to conditions as per your necessity.
And change the return value to the renderer you have created.

You can find the model for the ExceptionRender classes examples here:
- [CLIExceptionRenderer](https://github.com/ngframer/ngframer.php.exceptions/renderer/CliExceptionRenderer.php)
- [ApiExceptionRenderer](https://github.com/ngframer/ngframer.php.exceptions/renderer/ApiExceptionRenderer.php)
- [HtmlExceptionRenderer](https://github.com/ngframer/ngframer.php.exceptions/renderer/HtmlExceptionRenderer.php)


## 3. Registering the handler
If you're on 'ngframer.php,' it's already registered in the ```public/index.php``` file.  
After creating the handler class, you should register it in the initial point of your application.  
Sample code for registering:
    
```php
$renderFactory = new RendererFactory();
$renderFactory->register();
```

## 4. Customizing and updating
Feel free to customize and update the renderer as per your requirements.  
Use appropriate name spaces and directories for the management of the engine.  
