<?php

namespace NGFramer\NGFramerPHPExceptions;

use App\Config\ApplicationConfig;
use NGFramer\NGFramerPHPExceptions\Renderer\ApiExceptionRenderer;
use NGFramer\NGFramerPHPExceptions\Renderer\CliExceptionRenderer;
use NGFramer\NGFramerPHPExceptions\Renderer\HtmlExceptionRenderer;
use NGFramer\NGFramerPHPExceptions\Renderer\Supportive\BaseRenderer;

class Render
{
    /**
     * Creates and returns an appropriate Exception renderer based on the environment.
     *
     * @returns BaseRenderer
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
