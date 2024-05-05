<?php
class UserController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function login()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];            

            if ($this->model->login($username, $password)) {
                $userRole = $this->model->getRole();
                if($userRole === "admin")
                {
                    header("Location: admindashboard");
                }
                else if($userRole === "coach")
                {
                    header("Location: coachDashboard");
                }
                else if($userRole === "swimmer")
                {
                    header("Location: swimmerdashboard");
                }
                else if($userRole === "parent")
                {
                    header("Location: parentdashboard");
                }
                exit;            
            } else {
                $error = "Invalid username or password";
                echo $userRole;
            }
        }

       

        require_once 'views/login.php';
    }

    public function adminDashboard()
    {
        $this->checkAuth('admin');

        $username = $_SESSION['name'];

        $swimmer = "swimmer";

        $swimmernumber = $this->model->getUserCountByRole($swimmer);     
        
        $coach = "coach";

        $coachnumber = $this->model->getUserCountByRole($coach); 

        $squadnumber = $this->model->getSquadCount(); 

        require_once 'views/adminDashboard.php';
    }

    public function coachDashboard()
    {
        $this->checkAuth('coach');

        $username = $_SESSION['name'];
        

        require_once 'views/coachDashboard.php';
    }

    public function swimmerDashboard()
    {
        $this->checkAuth('swimmer');

        $username = $_SESSION['name'];     

        require_once 'views/swimmerDashboard.php';
    }

    public function parentDashboard()
    {
        $this->checkAuth('parent');

        $username = $_SESSION['name'];     

        require_once 'views/parentDashboard.php';
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'dob' => $_POST['dob'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
                'postcode' => $_POST['postcode'],
                'role' => $_POST['role']
            ];

            $uniqueuser = $this->model->checkUser($_POST['username']);

            if($uniqueuser) {
               echo "Username already exists";
               return;
            }

            // Check if the role is "swimmer" or "parent"
            if ($_POST['role'] === 'swimmer' || $_POST['role'] === 'parent') {
                // Store in applicants table
                $applicant_id = $this->model->storeApplicant($data);

                $parent_id = null;

                if (isset($_POST['parent_username'])) {
                    $parentdata = [
                        'username' => $_POST['parent_username'],
                        'password' => $_POST['parent_password'],
                        'first_name' => $_POST['parent_first_name'],
                        'last_name' => $_POST['parent_last_name'],
                        'email' => $_POST['parent_email'],   
                        'dob' => isset($_POST['parent_dob']) ? $_POST['parent_dob'] : '1970-01-01',
                        'phone' => $_POST['parent_phone'],
                        'address' => $_POST['parent_address'],
                        'postcode' => $_POST['parent_postcode'],
                        'role' => $_POST['parent_role']
                    ];
    
                    $uniqueuser = $this->model->checkUser($_POST['parent_username']);
    
                    if($uniqueuser) {
                       echo "Already username existed";
                    }  
                    else {
                        $parent_id = $this->model->storeApplicant($parentdata);
                        $addParent = $this->model->addParentForAppli($parent_id, $applicant_id);
                    }        
                    
                }

                if ($applicant_id && $parent_id) {
                    echo "Application submitted successfully. Please wait for approval.";
                } else {
                    echo "Failed to submit application.";
                }

                
            } else {
                // For roles other than "swimmer" or "parent", directly register to users table
                $user_id = $this->model->register($data);

                if ($user_id) {
                    echo "Registration successful";
                } else {
                    echo "Registration unsuccessful";
                }
            }
        }

        require_once 'views/register.php';  
    }

    public function handleApprove() {
        $this->checkAuth('admin');
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['approve_applicant'])) {
            $applicant_id = $_POST['applicant_id'];

            $parent_id = null;

            // Call the model method to approve the applicant
            $result = $this->model->approveApplicant($applicant_id);

            if($_POST['parent_id']) {
                $parent_id = $_POST['parent_id'];
                $result2 = $this->model->approveApplicant($parent_id);
            }

            if($parent_id) {
                $relation = $this->model->addParentSwimmer($result2, $result);           
            }

            if ($result) {
                echo "Applicant approved successfully";
            } else {
                echo "Failed to approve applicant";
            }
        } else {
            echo "Invalid request";
        }
    }

    public function manageApplicants()
    {
        $this->checkAuth('admin');

        $applicants = $this->model->getApplicantsByRole("swimmer");
        
        require_once 'views/manageApplicants.php';
    }

    public function rejectApplicants($id)
    {
        $this->checkAuth('admin');
        $result = $this->model->rejectApplicants($id);

        if ($result === true) {
            echo "Rejected";
        } else {
            echo "Error deleting";
        }

        header("Location: manageapplicants");
        exit;
    }

    public function profile()
    {
        $this->checkAuth('admin', 'coach', 'parent', 'swimmer');

        $userId = $_SESSION['user_id'];
        
        $user = $this->model->getUserById($userId);
        
        require_once 'views/userProfile.php';
    }

    public function compare()
    {
        $this->checkAuth('admin', 'coach', 'parent', 'swimmer');

        $swimmer_id = null;

        $swimmer_id2 = null;    
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['swimmer_id'])) {
                $swimmer_id = $_POST['swimmer_id'];
            } 
            
            if (isset($_POST['swimmer_id2'])) {
                $swimmer_id2 = $_POST['swimmer_id2'];
            } 
        }

        $trainingPerformance = $this->model->getPerformanceBySwimmer($swimmer_id);;

        $raceResult = $this->model->getRaceResultBySwimmerID($swimmer_id);        

        $trainingPerformance2 = $this->model->getPerformanceBySwimmer($swimmer_id2);;

        $raceResult2 = $this->model->getRaceResultBySwimmerID($swimmer_id2);

        $users = $this->model->getUserByRole("swimmer");
        
        require_once 'views/compare.php';
    }

    public function profileUpdate()
    {
        $this->checkAuth('admin', 'coach', 'parent', 'swimmer');

        $userId = $_SESSION['user_id'];

        $user2 = null;

        if($_SESSION['role'] == "swimmer") {
            $isAdult = $this->model->isUnderageSwimmer($userId);
            if( $isAdult)
            {
                echo "You are under age. Not permit to update.";
                return;
            }
        }  
        
        if($_SESSION['role'] == "parent") {
            $swimmer_id = $this->model->getSwimmerId($_SESSION["user_id"]);
            $user2 = $this->model->getUserById($swimmer_id);
        }    
        
        $user = $this->model->getUserById($userId);
        
        require_once 'views/updateProfile.php';
    }

    public function addCoach()
    {
        $this->checkAuth('admin');
        
        require_once 'views/addCoach.php';
    }    

    public function viewAllCoach()
    {
        $this->checkAuth('admin');
        $allcoaches = $this->model->getUserByRole("coach");
        
        require_once 'views/viewCoaches.php';
    }

    public function viewAllSwimmer()
    {
        $this->checkAuth('admin');
        $allSwimmers = $this->model->getUserByRole("swimmer");
        
        require_once 'views/viewSwimmer.php';
    }

    public function showUpdateUserForm($id)
    {
        $this->checkAuth('admin');
        // Get coach details
        $user = $this->model->getUserById($id);

        // Display update form
        require_once 'views/updateUserForm.php';
    }

    public function updateUserAction()
    {
        $this->checkAuth('admin', 'coach', 'parent', 'swimmer');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'id' => $_POST['id'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'current_password' => $_POST['current_password'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'dob' => $_POST['dob'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
                'postcode' => $_POST['postcode'],
                'role' => $_POST['role']
            ];

            $result = false;

            $uniqueuser = $this->model->checkUser($_POST['username']);

            if(!$uniqueuser || $uniqueuser == $_POST['id']) {              
               $result = $this->model->updateUser($data); 
            }  
            else {
                echo "Already username existed";
            }                         

            if ($result === true) {
                echo "User updated successfully";
            } else {
                echo "Error updating user: ";
                echo $_POST['id'];
                echo $uniqueuser;
            }
        }
    }

    public function deleteUser($id)
    {
        $this->checkAuth('admin');
        $result = $this->model->deleteUser($id);

        if ($result === true) {
            echo "User deleted successfully";
        } else {
            echo "Error deleting coach";
        }
    }

    public function addMeet()
    {
        $this->checkAuth('admin');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $data = [
                'meet_name' => $_POST['meet_name'],
                'meet_date' => $_POST['meet_date'],
                'meet_location' => $_POST['meet_location']
            ];          

            $result = $this->model->addMeet($data);
            
            if ($result) {
                echo "Added Meet successful";
            } else {
                echo "Error";
            }
        }

        require_once 'views/addMeet.php';
    }

    public function getAllMeets()
    {
        $this->checkAuth('admin', 'coach', 'parent', 'swimmer');
        $allmeets = $this->model->getAllMeets();

        require_once 'views/viewMeets.php';
    }

    public function showUpdateMeetForm($meetId)
    {
        $this->checkAuth('admin');
        $meet = $this->model->getMeetById($meetId);
        
        require_once 'views/updateMeetForm.php';
    }

    public function updateMeetAction()
    {
        $this->checkAuth('admin');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'id' => $_POST['id'],
                'meet_name' => $_POST['meet_name'],
                'meet_date' => $_POST['meet_date'],
                'meet_location' => $_POST['meet_location']
            ];

            $result = $this->model->updateMeet($data);

            if ($result === true) {
                echo "Meet updated successfully";
                header("Location: viewmeets");
                exit;
            } else {
                echo "Error updating meets: " . implode(", ", $result);
            }
        }
    }

    public function deleteMeet($meetId)
    {
        $this->checkAuth('admin');
        $result = $this->model->deleteMeet($meetId);

        if ($result === true) {
            echo "Meet deleted successfully";
        } else {
            echo "Error deleting Meet";
        }

        header("Location: viewmeets");
        exit;
    }

    public function addRace()
    {
        $this->checkAuth('admin');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'race_name' => $_POST['race_name'],
                'distance' => $_POST['race_distance'],
                'stroke' => $_POST['race_stroke'],
                'date' => $_POST['race_date'],
                'location' => $_POST['race_location'],
                'meet_id' => $_POST['meet_id']
            ];

            $result = $this->model->addRace($data);

            if ($result === true) {
                echo "Added Race successfully";
            } else {
                echo "Error: " . implode(", ", $result);
            }
        }

        $allmeets = $this->model->getAllMeets();

        require_once 'views/addRace.php';
    }

    public function getAllRaces()
    {
        $this->checkAuth('admin', 'coach', 'parent', 'swimmer');
        $allRaces = $this->model->getAllRaces();
        foreach ($allRaces as &$race) {
            // Getting meet details for each race
            $meet = $this->model->getMeetById($race['MeetID']);
            // Adding MeetName to the race details
            $race['MeetName'] = $meet['MeetName'];
        }
        unset($race);
        require_once 'views/viewRaces.php';
    }

    public function showUpdateRaceForm($raceId)
    {
        $this->checkAuth('admin');
        $race = $this->model->getRaceById($raceId);
        $meet = $this->model->getMeetById($race['MeetID']);
        $allmeets = $this->model->getAllMeets();
        $race['MeetName'] = $meet['MeetName'];
        require_once 'views/updateRaceForm.php';
    }

    public function updateRaceAction()
    {
        $this->checkAuth('admin');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'id' => $_POST['id'],
                'race_name' => $_POST['race_name'],
                'distance' => $_POST['race_distance'],
                'stroke' => $_POST['race_stroke'],
                'date' => $_POST['race_date'],
                'location' => $_POST['race_location'],
                'meet_id' => $_POST['meet_id']
            ];

            $result = $this->model->updateRace($data);

            if ($result === true) {
                echo "Race updated successfully";
                header("Location: viewraces");
                exit;
            } else {
                echo "Error updating race: " . implode(", ", $result);
            }
        }
    }

    public function deleteRace($raceId)
    {
        $this->checkAuth('admin');
        $result = $this->model->deleteRace($raceId);

        if ($result === true) {
            echo "Race deleted successfully";
        } else {
            echo "Error deleting Race";
        }

        header("Location: viewraces");
        exit;
    }

    public function addRaceResult()
    {
        $this->checkAuth('admin');        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $race_id = $_POST['race_id'];
            $num_swimmers = $_POST['num_swimmers'];
            $participant_id = $_POST['participant_id'];
            $participant_hours = $_POST['participant_hours'];
            $participant_minutes = $_POST['participant_minutes'];
            $participant_seconds = $_POST['participant_seconds'];
            $places = $_POST['place'];
            
            // Initialize an array to hold combined data
            $participant_times = [];
            $data = array();
            
            // Combine hours, minutes, and seconds for each participant
            for ($i = 0; $i < count($participant_hours); $i++) {
                $time_taken = $participant_hours[$i] . ":" . $participant_minutes[$i] . ":" . $participant_seconds[$i];
                $participant_times[] = $time_taken;
            }            

            for ($i = 0; $i < $num_swimmers; $i++) {
                $time_taken = $participant_hours[$i] . ":" . $participant_minutes[$i] . ":" . $participant_seconds[$i];
                $participant_data = array(
                    'race_id' => $race_id,
                    'swimmer_id' => $participant_id[$i],
                    'time_taken' => $time_taken,
                    'place_achieved' => $places[$i]
                );

                $data[] = $participant_data;
            }

            foreach ($data as $participant_data) {
                $result = $this->model->addRaceResult($participant_data);
                if (!$result) {
                    // Handle insertion failure
                    echo "Failed to add race result ";
                }
            }

            echo "result added";
           
        }

        $allRaces = $this->model->getAllRaces();
        $allSwimmers = $this->model->getUserByRole("swimmer");

        require_once 'views/addRaceResult.php';
    }

    public function addRaceResultPage($raceId)
    {
        $this->checkAuth('admin');  
        $raceId = $raceId;
        require_once 'views/addRaceResult.php';
    }

    public function getAllRaceResults()
    {
        $this->checkAuth('admin', 'coach', 'parent', 'swimmer');
        $allRaceResults = $this->model->getAllRaceResults();
        foreach ($allRaceResults as &$raceResult) {
            // Getting race and swimmer details for each race result
            $race = $this->model->getRaceById($raceResult['RaceID']);
            $swimmer = $this->model->getUserById($raceResult['SwimmerID']);
            $meet = $this->model->getMeetById($race['MeetID']);
            // Adding RaceName and SwimmerName to the race result details
            $raceResult['RaceName'] = $race['RaceName'];
            $raceResult['SwimmerName'] = $swimmer['first_name']." ".$swimmer['last_name'] . " - " .$swimmer['id'];
            $raceResult['MeetName'] = $meet['MeetName'];
        }
        unset($raceResult);
        require_once 'views/viewRaceResults.php';
    }

    public function RaceResultByID($raceResultId)
    {
        $this->checkAuth('admin', 'coach', 'parent', 'swimmer');
        $allRaceResults = $this->model->getRaceResultByRaceID($raceResultId);
        foreach ($allRaceResults as &$raceResult) {
            // Getting race and swimmer details for each race result
            $race = $this->model->getRaceById($raceResult['RaceID']);
            $swimmer = $this->model->getUserById($raceResult['SwimmerID']);
            $meet = $this->model->getMeetById($race['MeetID']);
            // Adding RaceName and SwimmerName to the race result details
            $raceResult['RaceName'] = $race['RaceName'];
            $raceResult['SwimmerName'] = $swimmer['first_name']." ".$swimmer['last_name'] . " - " .$swimmer['id'];
            $raceResult['MeetName'] = $meet['MeetName'];
        }
        unset($raceResult);
        require_once 'views/viewRaceResults.php';
    }

    public function showUpdateRaceResultForm($raceResultId)
    {
        $this->checkAuth('admin');
        $raceResult = $this->model->getRaceResultById($raceResultId);
        list($raceResult["hours"], $raceResult["minutes"], $raceResult["seconds"]) = explode(':', $raceResult["TimeTaken"]);
        $race = $this->model->getRaceById($raceResult['RaceID']);
        $swimmer = $this->model->getUserById($raceResult['SwimmerID']);
        $allRaces = $this->model->getAllRaces();
        $allSwimmers = $this->model->getUserByRole("swimmer");
        $raceResult['RaceName'] = $race['RaceName'];
        $raceResult['SwimmerName'] = $swimmer['first_name']." ".$swimmer['last_name'] . " - " .$swimmer['id'];
        require_once 'views/updateRaceResultForm.php';
    }

    public function updateRaceResultAction()
    {
        $this->checkAuth('admin');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $hours = $_POST['hours'];
            $minutes = $_POST['minutes'];
            $seconds = $_POST['seconds'];
            
            // Combine hours, minutes, and seconds into a single field
            $time_taken = $hours . ":" . $minutes . ":" . $seconds;
            $data = [
                'id' => $_POST['id'],
                'race_id' => $_POST['race_id'],
                'swimmer_id' => $_POST['swimmer_id'],
                'time_taken' => $time_taken,
                'place_achieved' => $_POST['place_achieved']
            ];

            $result = $this->model->updateRaceResult($data);

            if ($result === true) {
                echo "Race result updated successfully";
                header("Location: viewraces");
                exit;
            } else {
                echo "Error updating race result: " . implode(", ", $result);
            }
        }
    }

    public function deleteRaceResult($raceResultId)
    {
        $this->checkAuth('admin');
        $result = $this->model->deleteRaceResult($raceResultId);

        if ($result === true) {
            echo "Race result deleted successfully";
        } else {
            echo "Error deleting race result";
        }

        header("Location: viewraces");
        exit;
    }

    public function addSquad()
    {
        $this->checkAuth('admin');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $training_days = implode(",", $_POST['training_days']);
            
            $data = [
                'squad_name' => $_POST['squad_name'],
                'training_days' => $training_days,
                'coach_id' => $_POST['coach_id'],
                'start_time' => $_POST['start_time'],
                'end_time' => $_POST['end_time']
            ];          

            $result = $this->model->addSquad($data);           
            
            if ($result) {
                echo "Added Squad successfully";
            } else {
                echo "Error: " . implode(", ", $result);
            }
        }

        $coaches = $this->model->getUserByRole("coach");

        require_once 'views/addSquad.php';
    }

    public function getAllSquads()
    {
        $this->checkAuth('admin', 'coach');
        $allsquads = $this->model->getAllSquads();

        foreach ($allsquads as &$squad) {
            if ($squad['coach_id'] !== null && $squad['coach_id'] != 0) {
                $coach = $this->model->getUserById($squad['coach_id']);
            
                // Set the coach_name for the squad
                $squad['coach_name'] = $coach['first_name']." ".$coach['last_name'] . " - " .$coach['id'];
            } else {
                // If coach_id is null, set coach_name to null
                $squad['coach_name'] = null;
            }
            unset($squad);
        }

        require_once 'views/viewSquads.php';
    }

    public function getSquadById($squadId)
    {
        $this->checkAuth('admin', 'coach');
        $squad = $this->model->getSquadById($squadId);

        $coach = $this->model->getUserById($squad['coach_id']);

        if($coach)
        {
            $squad['coach_name'] = $coach['first_name']." ".$coach['last_name'] . " - " .$coach['id'];
            if (!$this->checkCoachPermission($coach['id'])) {
                echo "Access denied. You do not have permission to view this squad.";
                exit;
            }
        }
        else
        {
            if($_SESSION['role'] != "admin")
            {
                echo "Access denied. You do not have permission to view this squad.".$_SESSION['user_id'];
                exit;
            }
        }


        $swimmers = $this->model->getSwimmerIdBySquad($squad['squad_id']);

        $allswimmers = $this->model->getUserByRole("swimmer");

        require_once 'views/viewSingleSquad.php';
    }

    public function showUpdateSquadForm($squadId)
    {
        $this->checkAuth('admin', 'coach');
        $squad = $this->model->getSquadById($squadId);
        $coaches = $this->model->getUserByRole("coach");
        if (!$this->checkCoachPermission($squad['coach_id'])) {
            echo "Access denied. You do not have permission to view this squad performance.";
            exit;
        }
        
        require_once 'views/updateSquadForm.php';
    }

    public function updateSquadAction()
    {
        $this->checkAuth('admin');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $training_days = implode(",", $_POST['training_days']);
            $data = [
                'squad_id' => $_POST['squad_id'],
                'squad_name' => $_POST['squad_name'],
                'coach_id' => $_POST['coach_id'],
                'training_days' =>  $training_days,
                'start_time' => $_POST['start_time'],
                'end_time' => $_POST['end_time']
            ];

            $result = $this->model->updateSquad($data);

            if ($result === true) {
                echo "Squad updated successfully";
                header("Location: viewsquads");
                exit;
            } else {
                echo "Error updating squad: " . implode(", ", $result);
            }
        }
    }

    public function deleteSquad($squadId)
    {
        $this->checkAuth('admin');
        $result = $this->model->deleteSquad($squadId);

        if ($result === true) {
            echo "Squad deleted successfully";
        } else {
            echo "Error deleting Squad";
        }

        header("Location: viewsquads");
        exit;
    }

    public function addSwimmerToSquad($swimmerId, $squadId)
    {
        $this->checkAuth('admin');
        
        $data = [
            'squad_id' => $squadId,
            'id' => $swimmerId
        ];          

        $result = $this->model->AddUserToSquad($data);           
        
        if ($result) {
            echo "Added to Squad successfully";
            header("Location: squad?squadId=$squadId");
            exit;
        } else {
            echo "Error: " . implode(", ", $result);
        }
    }

    public function removeSwimmerFromSquad($swimmerId, $squadId)
    {
        $this->checkAuth('admin', 'coach');  

        $result = $this->model->RemoveUserFromSquad($swimmerId);     
        
        if ($result) {
            header("Location: squad?squadId=$squadId");
            exit;
        } else {
            echo "Error: " . implode(", ", $result);
        }
    }

    public function addTrainingSession($squadId)
    {
        $this->checkAuth('coach');
        $squadId = $squadId;
        require_once 'views/addTrainingSession.php';
    }

    public function addTrainingSessionAction()
    {
        $this->checkAuth('coach');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $data = [
                'date' => $_POST['session_date'],
                'distance' => $_POST['session_distance'],
                'stroke' => $_POST['session_stroke'],
                'squad_id' => $_POST['squad_id']
            ];          

            $result = $this->model->addTrainingSession($data);
            
            if ($result === true) {
                echo "Added Training Session successfully";
            } else {
                echo "Error: " . implode(", ", $result);
            }
        }

        require_once 'views/addTrainingSession.php';
    }

    public function getAllTrainingSessions()
    {
        $this->checkAuth('admin', 'coach', 'parent', 'swimmer');
        $allsessions = $this->model->getAllTrainingSessions();        

        require_once 'views/viewTrainingSessions.php';
    }

    public function showUpdateTrainingSessionForm($sessionId)
    {
        $this->checkAuth('coach');
        $session = $this->model->getTrainingSessionById($sessionId);
        
        require_once 'views/updateTrainingSessionForm.php';
    }

    public function updateTrainingSessionAction()
    {
        $this->checkAuth('coach');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'id' => $_POST['id'],
                'date' => $_POST['date'],
                'distance' => $_POST['distance'],
                'stroke' => $_POST['stroke'],
                'squad_id' => $_POST['squad_id']
            ];

            $result = $this->model->updateTrainingSession($data);

            if ($result === true) {
                echo "Training Session updated successfully";
                header("Location: viewsessions");
                exit;
            } else {
                echo "Error updating training session: " . implode(", ", $result);
            }
        }
    }

    public function deleteTrainingSession($sessionId)
    {
        $this->checkAuth('coach');
        $result = $this->model->deleteTrainingSession($sessionId);

        if ($result === true) {
            echo "Training Session deleted successfully";
        } else {
            echo "Error deleting Training Session";
        }

        header("Location: viewsessions");
        exit;
    }

    public function addTrainingPerformance($sessionId, $squadId)
    {
        $this->checkAuth('coach');
        $sessionId = $sessionId;
        $swimmers = $this->model->getSwimmerIdByForPerformance($sessionId, $squadId);
        require_once 'views/addTrainingPerformance.php';
    }

    public function addTrainingPerformanceAction()
    {
        $this->checkAuth('coach');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $session_id = $_POST['session_id'];
            $swimmer_ids = $_POST['swimmer_id'];
            $time_hours = $_POST['time_hours'];
            $time_minutes = $_POST['time_minutes'];
            $time_seconds = $_POST['time_seconds'];
            $comments = $_POST['comment'];            
    
            // Add each training performance
            foreach ($swimmer_ids as $key => $swimmer_id) {
                $time_taken = $time_hours[$key] . ':' . $time_minutes[$key] . ':' . $time_seconds[$key];
                $data = [
                    'session_id' => $session_id,
                    'swimmer_id' => $swimmer_id,
                    'time_taken' => $time_taken,
                    'comment' => $comments[$key]
                ];
                $result = $this->model->addTrainingPerformance($data);
    
                if ($result !== true) {
                    echo "Error: " . implode(", ", $result);
                    
                }
            }
            echo "Training Performance added successfully";
            header("Location: viewsessions");
            exit();
        }
        require_once 'views/addTrainingPerformance.php';
        
    }

    public function getAllTrainingPerformances($sessionId)
    {
        $this->checkAuth('admin', 'coach', 'parent', 'swimmer');
        $swimmers = $this->model->getSwimmerIdBySquadAndSession($sessionId);
        
        require_once 'views/viewTrainingPerformances.php';
    }

    public function getPerformanceBySwimmer()
    {
        $this->checkAuth('admin', 'coach', 'parent', 'swimmer');

        if($_SESSION["role"] == "parent")
        {           
            $swimmer_id = $this->model->getSwimmerId($_SESSION["user_id"]);
        }
        else 
        {
            $swimmer_id = $_SESSION["user_id"];
        }
        
        $performances = $this->model->getPerformanceBySwimmer($swimmer_id);
        
        require_once 'views/trainingPerformance.php';
    }


    public function showUpdateTrainingPerformanceForm($performanceId)
    {
        $this->checkAuth('coach');
        $trainingPerformance = $this->model->getTrainingPerformanceById($performanceId);
        
        require_once 'views/updateTrainingPerformanceForm.php';
    }

    public function updateTrainingPerformanceAction()
    {
        $this->checkAuth('coach');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'id' => $_POST['id'],
                'session_id' => $_POST['session_id'],
                'swimmer_id' => $_POST['swimmer_id'],
                'time_taken' => $_POST['time_taken'],
                'comment' => $_POST['comment']
            ];

            $result = $this->model->updateTrainingPerformance($data);

            if ($result === true) {
                echo "Training Performance updated successfully";
            } else {
                echo "Error updating training performance: " . implode(", ", $result);
            }
        }
    }

    public function deleteTrainingPerformance($performanceId)
    {
        $this->checkAuth('coach');
        $result = $this->model->deleteTrainingPerformance($performanceId);

        if ($result === true) {
            echo "Training Performance deleted successfully";
        } else {
            echo "Error deleting Training Performance";
        }

    }

    public function getRaceResultBySwimmerID()
    {
        $this->checkAuth('admin', 'coach', 'parent', 'swimmer');

        if($_SESSION["role"] == "parent")
        {           
            $swimmer_id = $this->model->getSwimmerId($_SESSION["user_id"]);
        }
        else 
        {
            $swimmer_id = $_SESSION["user_id"];
        }
        
        $results = $this->model->getRaceResultBySwimmerID($swimmer_id);
        
        require_once 'views/raceResult.php';
    }

    public function logout()
    {
        $this->model->logout();
        header("Location: index.php");
        exit;
    }    

    public function checkAuth(...$allowedRoles)
    {
        if (!$this->model->isLoggedIn()) {
            header("Location: index.php");
            exit;
        }

        $userRole = $this->model->getRole();
        if (!in_array($userRole, $allowedRoles)) {
            echo "Access denied. You do not have permission to access this page.";
            exit;
        }
    }

    private function checkCoachPermission($coachId)
    {
        $userRole = $this->model->getRole();

        // Club administrators and coaches can view any swimmer's performance
        if ($userRole == 'admin') {
            return true;
        }

        // Parents and adult swimmers can only view their own performance
        if ($userRole == 'coach') {
            $userId = $_SESSION["user_id"];
            if ($userId == $coachId) {
                return true;
            }
        }

        return false;
    }

    private function checkSwimmerPermission($swimmerId)
    {
        $userRole = $this->model->getRole();

        // Club administrators and coaches can view any swimmer's performance
        if ($userRole == 'admin' || $userRole == 'coach') {
            return true;
        }

        // Parents and adult swimmers can only view their own performance
        if ($userRole == 'parent') {
            // $swimmers = $this->model->getSwimmerIdBySquad($squad['squad_id']);
            $userId = $_SESSION["user_id"];
            if ($userId == $swimmerId) {
                return true;
            }
        }

        if ($userRole == 'swimmer') {
            $userId = $_SESSION["user_id"];
            if ($userId == $swimmerId) {
                return true;
            }
        }

        return false;
    }
}