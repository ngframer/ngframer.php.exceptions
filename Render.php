<?php

namespace NGFramer\NGFramerPHPExceptions;

use app\config\ApplicationConfig;
use NGFramer\NGFramerPHPExceptions\renderer\ApiExceptionRenderer;
use NGFramer\NGFramerPHPExceptions\renderer\CliExceptionRenderer;
use NGFramer\NGFramerPHPExceptions\renderer\HtmlExceptionRenderer;
use NGFramer\NGFramerPHPExceptions\renderer\supportive\_BaseRenderer;

class Render
{
    /**
     * Creates and returns an appropriate Exception renderer based on the environment.
     *
     * @returns _BaseRenderer
     */
    public static function create()
    {
        // Check the environment and return the appropriate renderer.
        // Check if the environment is cli.
        if (php_sapi_name() === 'cli') {
            return new CLIExceptionRenderer();
        }

        // Check if the environment is api.
        if (ApplicationConfig::get('appType') === 'api') {
            return new APIExceptionRenderer();
        }

        // If the environment is not cli or api, return the default renderer.
        return new HtmlExceptionRenderer();
    }

}
