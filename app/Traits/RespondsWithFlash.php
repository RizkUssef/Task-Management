<?php

namespace App\Traits;

trait RespondsWithFlash
{
    protected function respond($condition, string $successMessage, string $errorMessage, $successRoute = null, $errorRoute = null)
    {
        if ($condition) {
            // Redirect to the success route if available; otherwise, redirect back with a success message.
            return ($successResponse ?? redirect()->back())->with('success', $successMessage);
        }
        // Redirect to the error route if available; otherwise, redirect back with an error message.
        return ($errorResponse ?? redirect()->back())->with('error', $errorMessage);
    }
}
