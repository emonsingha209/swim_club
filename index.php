<?php
// Autoload classes
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/models/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }

    $file = __DIR__ . '/controllers/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Database connection
require_once 'models/db.php';

// Instantiate the User model and controller
$userModel = new User();
$userController = new UserController($userModel);


// Handle routes
$route = trim($_SERVER['REQUEST_URI'], '/');
$route = $route ? $route : 'swim_management/login';

switch ($route) {
    case 'swim_management/login':
        $userController->login();
        break;
    case 'swim_management':
        $userController->login();
        break;
    case 'swim_management/index.php':
        $userController->login();
        break;
    case 'swim_management/logout':
        $userController->logout();
        break;
    case 'swim_management/register':
        $userController->register();
        break;
    case 'swim_management/update-personal-details':
        $userController->updatePersonalDetails();
        break;
    case 'swim_management/add-swim-performance':
        $userController->addSwimPerformance();
        break;
    case 'swim_management/view-swim-performances':
        $userController->viewSwimmerPerformance();
        break;
    case 'swim_management/test':
        $userController->validateRaceData();
        break;
    default:
        echo "404 Not Found";
        break;
}