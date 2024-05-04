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
    case 'swim_management/addCoach':
        $userController->addCoach();
        break;
    case 'swim_management/admindashboard':
        $userController->adminDashboard();
        break;
    case 'swim_management/manageapplicants':
        $userController->manageApplicants();
        break;
    case 'swim_management/handle_approve':
        $userController->handleApprove();
        break;
    case strpos($route, 'swim_management/rejectapplicants') === 0:
        // Extract the coach ID from the URL
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $id = isset($query['id']) ? $query['id'] : null;
        $userController->rejectApplicants($id);
        break; 
    case 'swim_management/coachDashboard':
        $userController->coachDashboard();
        break;
    case 'swim_management/swimmerdashboard':
        $userController->swimmerDashboard();
        break;
    case 'swim_management/viewallcoach':
        $userController->viewAllCoach();
        break;  
    case 'swim_management/viewallswimmer':
        $userController->viewAllSwimmer();
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
    case 'swim_management/addmeet':
        $userController->addMeet();
        break;  
    case 'swim_management/viewmeets':
        $userController->getAllMeets();
        break;    
    case 'swim_management/meetformupdate':
        $userController->updateMeetAction();
        break;
    case strpos($route, 'swim_management/updatemeet') === 0:
        // Extract the coach ID from the URL
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $meetId = isset($query['meetId']) ? $query['meetId'] : null;
        $userController->showUpdateMeetForm($meetId);
        break;  
    case strpos($route, 'swim_management/deletemeet') === 0:
        // Extract the coach ID from the URL
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $meetId = isset($query['meetId']) ? $query['meetId'] : null;
        $userController->deleteMeet($meetId);
        break;
    case 'swim_management/addrace':
        $userController->addRace();
        break;  
    case 'swim_management/viewraces':
        $userController->getAllRaces();
        break;  
    case 'swim_management/raceformupdate':
        $userController->updateRaceAction();
        break;
    case strpos($route, 'swim_management/updaterace') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $raceId = isset($query['raceId']) ? $query['raceId'] : null;
        $userController->showUpdateRaceForm($raceId);
        break; 
    case strpos($route, 'swim_management/deleterace') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $raceId = isset($query['raceId']) ? $query['raceId'] : null;
        $userController->deleteRace($raceId);
        break;
    case 'swim_management/addresultform':
        $userController->addRaceResult();
        break;
    case strpos($route, 'swim_management/addraceresult') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $raceId = isset($query['raceId']) ? $query['raceId'] : null;
        $userController->addRaceResultPage($raceId);
        break; 
    case strpos($route, 'swim_management/raceresults') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $raceId = isset($query['raceId']) ? $query['raceId'] : null;
        $userController->RaceResultByID($raceId);
        break; 
    case 'swim_management/rresultformupdate':
        $userController->updateRaceResultAction();
        break;
    case strpos($route, 'swim_management/updaterresult') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $raceresultId = isset($query['raceresultId']) ? $query['raceresultId'] : null;
        $userController->showUpdateRaceResultForm($raceresultId);
        break; 
    case strpos($route, 'swim_management/deleterresult') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $raceresultId = isset($query['raceresultId']) ? $query['raceresultId'] : null;
        $userController->deleteRaceResult($raceresultId);
        break;
    case 'swim_management/addsquad':
        $userController->addSquad();
        break;    
    case 'swim_management/viewsquads':
        $userController->getAllSquads();
        break;
    case strpos($route, 'swim_management/squad') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $squadId = isset($query['squadId']) ? $query['squadId'] : null;
        $userController->getSquadById($squadId);
        break; 
    case 'swim_management/sqdformupdate':
        $userController->updateSquadAction();
        break;
    
    case strpos($route, 'swim_management/updatesquad') === 0:
        // Extract the squad ID from the URL
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $squadId = isset($query['squadId']) ? $query['squadId'] : null;
        $userController->showUpdateSquadForm($squadId);
        break;
    
    case strpos($route, 'swim_management/deletesquad') === 0:
        // Extract the squad ID from the URL
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $squadId = isset($query['squadId']) ? $query['squadId'] : null;
        $userController->deleteSquad($squadId);
        break;
    case strpos($route, 'swim_management/addswimmertosquad') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $swimmerId = isset($query['swimmerId']) ? $query['swimmerId'] : null;
        $squadId = isset($query['squadId']) ? $query['squadId'] : null;
        $userController->addSwimmerToSquad($swimmerId, $squadId);
        break;  
    case strpos($route, 'swim_management/removeswimmerfromsquad') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $swimmerId = isset($query['swimmerId']) ? $query['swimmerId'] : null;
        $squadId = isset($query['squadId']) ? $query['squadId'] : null;
        $userController->removeSwimmerFromSquad($swimmerId, $squadId);
        break;  
    case 'swim_management/sessionform':
        $userController->addTrainingSessionAction();
        break;  
    case strpos($route, 'swim_management/addsession') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $squadId = isset($query['squadId']) ? $query['squadId'] : null;
        $userController->addTrainingSession($squadId);
        break;
    case 'swim_management/viewsessions':
        $userController->getAllTrainingSessions();
        break;    
    case 'swim_management/sessionformupdate':
        $userController->updateTrainingSessionAction();
        break;    
    case strpos($route, 'swim_management/updatesession') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $sessionId = isset($query['sessionId']) ? $query['sessionId'] : null;
        $userController->showUpdateTrainingSessionForm($sessionId);
        break;    
    case strpos($route, 'swim_management/deletesession') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $sessionId = isset($query['sessionId']) ? $query['sessionId'] : null;
        $userController->deleteTrainingSession($sessionId);
        break;        
    case 'swim_management/addperformance':
        $userController->addTrainingPerformanceAction();
        break;
    case strpos($route, 'swim_management/performanceform') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $squadId = isset($query['squadId']) ? $query['squadId'] : null;
        $sessionId = isset($query['sessionId']) ? $query['sessionId'] : null;
        $userController->addTrainingPerformance($sessionId, $squadId);
        break; 
    case strpos($route, 'swim_management/viewperformances') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $sessionId = isset($query['sessionId']) ? $query['sessionId'] : null;
        $userController->getAllTrainingPerformances($sessionId);
        break;
    case strpos($route, 'swim_management/updateperformance') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $performanceId = isset($query['performanceId']) ? $query['performanceId'] : null;
        $userController->showUpdateTrainingPerformanceForm($performanceId);
        break;    
    case 'swim_management/actionupdateperformance':
        $userController->updateTrainingPerformanceAction();
        break;    
    case strpos($route, 'swim_management/deleteperformance') === 0:
        $parts = parse_url($route);
        parse_str($parts['query'], $query);
        $performanceId = isset($query['performanceId']) ? $query['performanceId'] : null;
        $userController->deleteTrainingPerformance($performanceId);
        break;        
    case 'swim_management/performancedata':
        $userController->getPerformanceBySwimmer();
        break; 
    case 'swim_management/dataraceresult':
        $userController->getRaceResultBySwimmerID();
        break; 
    default:
        echo "404 Not Found";
        break;
}