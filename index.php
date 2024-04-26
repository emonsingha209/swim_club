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
    case 'swim_management':
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
    case 'swim_management/addCoach':
        $userController->addCoach();
        break;
    case 'swim_management/admindashboard':
        $userController->adminDashboard();
        break;
    case 'swim_management/viewallcoach':
        $userController->viewAllCoach();
        break;   
    case strpos($route, 'swim_management/updatecoach') === 0:
        // Extract the coach ID from the URL
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $coachId = isset($query['coachId']) ? $query['coachId'] : null;
        $userController->showUpdateCoachForm($coachId);
        break;    
    case 'swim_management/coachformupdate':
        $userController->updateCoachAction();
        break;
    case strpos($route, 'swim_management/deletecoach') === 0:
        // Extract the coach ID from the URL
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $coachId = isset($query['coachId']) ? $query['coachId'] : null;
        $userController->deleteCoach($coachId);
        break;      
    default:
        echo "404 Not Found";
        break;
}