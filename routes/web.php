
<?php

use Illuminate\Support\Facades\Route;

// Load Frontend Routes
if (file_exists($frontendRoutes = __DIR__ . '/frontend_route.php')) {
    require $frontendRoutes;
}

// Load Backend Routes
if (file_exists($backendRoutes = __DIR__ . '/backend_route.php')) {
    require $backendRoutes;
}

// Fallback Route (optional)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

?>


