<?php

namespace NGFramer\NGFramerPHPExceptions\handlers\supportive;

Trait SourceTrait
{
    public static function getSource($backtrace = null): array
    {
        // Use the provided backtrace if available.
        if (empty($backtrace)) $traces = $backtrace;
        else $traces[] = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        // Initialize the trace map.
        $traceMap = [];

        // Loop through to get the trace elements.
        foreach ($traces as $trace) {
            // Start joining the trace elements.
            $joiningString = $trace['type'] ?? ">>";
            $currentTrace = isset($trace['file']) ? $trace['file'] . $joiningString : '';
            $currentTrace .= isset($trace['class']) ? $trace['class'] . $joiningString : '';
            $currentTrace .= isset($trace['object']) ? $trace['object'] . $joiningString : '';
            $currentTrace .= isset($trace['function']) ? $trace['function'] . $joiningString : '';
            $currentTrace .= isset($trace['line']) ? $trace['line'] . $joiningString : '';

            // Add the current trace to the trace map.
            $traceMap[] = $currentTrace;
        }

        // Return the trace collection
        return $traceMap;
    }
}