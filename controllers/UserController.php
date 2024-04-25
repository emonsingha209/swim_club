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
                else if($userRole === "parent" || $userRole === "swimmer")
                {
                    header("Location: swimmerDashboard");
                }
                exit;            
            } else {
                $error = "Invalid username or password";
            }
        }

       

        require_once 'views/login.php';
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $parent_id = null;
            
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

            $swimmer_id = $this->model->register($data);
   
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
          
                $parent_id = $this->model->register($parentdata);
            }

            if($parent_id) {
                $result = $this->model->addParentSwimmer($parent_id, $swimmer_id);
           
            }
            else if($swimmer_id) {
                $result = $swimmer_id;
            }            

            if ($result) {
                echo "Registration successful";
            } else {
                echo "Error";
            }
        }

        if($_POST['role'] === "coach" || $_POST['role'] === "swimmer") {
            require_once 'views/addCoach.php';
        }
        else {
            require_once 'views/register.php';
        }

        
    }

    public function updatePersonalDetails()
    {
        $this->checkAuth('parent', 'swimmer');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userId = $_POST["user_id"];
            $data = [
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
                'postcode' => $_POST['postcode']
            ];

            $result = $this->model->updatePersonalDetails($userId, $data);

            if ($result === true) {
                echo "Personal details updated successfully";
            } else {
                foreach ($result as $error) {
                    echo $error . "<br>";
                }
            }
        }

        require_once 'views/update_personal_details.php';
    }

    public function addSwimPerformance()
    {
        $this->checkAuth('coach');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userId = $_POST["user_id"];
            $data = [
                'event_name' => $_POST['event_name'],
                'event_date' => $_POST['event_date'],
                'time' => $_POST['time']
            ];

            $result = $this->model->addSwimPerformance($userId, $data);

            if ($result === true) {
                echo "Swim performance data added successfully";
            } else {
                foreach ($result as $error) {
                    echo $error . "<br>";
                }
            }
        }

        require_once 'views/add_swim_performance.php';
    }

    public function addCoach()
    {
        $this->checkAuth('admin');
        
        require_once 'views/addCoach.php';
    }

    public function adminDashboard()
    {
        $this->checkAuth('admin');

        $username = $_SESSION['name'];
        

        require_once 'views/adminDashboard.php';
    }

    public function viewAllCoach()
    {
        $this->checkAuth('admin');
        $allcoaches = $this->model->getAllCoach();

        require_once 'views/viewCoaches.php';
    }

    public function showUpdateCoachForm($coachId)
    {
        // Get coach details
        $coach = $this->model->getCoachById($coachId);

        // Display update form
        require_once 'views/updateCoachForm.php';
    }

    public function updateCoachAction()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'id' => $_POST['id'],
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

            $result = $this->model->updateCoach($data);

            if ($result === true) {
                echo "Coach updated successfully";
            } else {
                echo "Error updating coach: " . implode(", ", $result);
            }
        }
    }


    public function deleteCoach($coachId)
    {
        $result = $this->model->deleteCoach($coachId);

        if ($result === true) {
            echo "Coach deleted successfully";
        } else {
            echo "Error deleting coach";
        }

        header("Location: viewallcoach");
        exit;
    }

    public function viewSwimPerformances()
    {
        $this->checkAuth('admin', 'coach', 'parent', 'swimmer');
        $userId = $_SESSION["user_id"];
        $performances = $this->model->getSwimPerformances($userId);

        require_once 'views/view_swim_performances.php';
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

    public function viewSwimmerPerformance()
    {
        $this->checkAuth('admin', 'coach', 'parent', 'swimmer');

        // Retrieve swimmer ID
        $swimmerId = $_SESSION["user_id"];

        // Check if the current user has permission to view the swimmer's data
        if (!$this->checkSwimmerPermission($swimmerId)) {
            echo "Access denied. You do not have permission to view this swimmer's performance.";
            exit;
        }

        // Retrieve swimmer's performance data
        $performanceData = $this->model->getSwimmerPerformance($swimmerId);

        // Retrieve swimmer's details
        $swimmerDetails = $this->model->getSwimmerDetails($swimmerId);

        // Retrieve relevant swimmers in the club for comparison
        $relevantSwimmers = $this->model->getRelevantSwimmers($swimmerDetails['dob'], $swimmerDetails['id']);

        require_once 'views/view_swimmer_performance.php';
    }

    public function editPersonalDetails()
    {
        $this->checkAuth('parent', 'swimmer');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userId = $_POST["user_id"];
            $data = [
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
                'postcode' => $_POST['postcode']
            ];

            // Non-adult swimmers cannot edit personal details
            if ($this->model->isAdultSwimmer($userId)) {
                $result = $this->model->updatePersonalDetails($userId, $data);

                if ($result === true) {
                    echo "Personal details updated successfully";
                } else {
                    foreach ($result as $error) {
                        echo $error . "<br>";
                    }
                }
            } else {
                echo "You do not have permission to edit personal details.";
            }
        }

        require_once 'views/edit_personal_details.php';
    }

    public function editSwimmerPerformance()
    {
        $this->checkAuth('coach');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $swimmerId = $_POST["swimmer_id"];
            $performanceId = $_POST["performance_id"];
            $data = [
                'event_name' => $_POST['event_name'],
                'event_date' => $_POST['event_date'],
                'time' => $_POST['time']
            ];

            // Only coaches can edit swimmer performance data
            $result = $this->model->editSwimmerPerformance($swimmerId, $performanceId, $data);

            if ($result === true) {
                echo "Swimmer performance data updated successfully";
            } else {
                foreach ($result as $error) {
                    echo $error . "<br>";
                }
            }
        }

        require_once 'views/edit_swimmer_performance.php';
    }


    private function checkSwimmerPermission($swimmerId)
    {
        $userRole = $this->model->getRole();

        // Club administrators and coaches can view any swimmer's performance
        if ($userRole == 'admin' || $userRole == 'coach') {
            return true;
        }

        // Parents and adult swimmers can only view their own performance
        if ($userRole == 'parent' || $userRole == 'swimmer') {
            $userId = $_SESSION["user_id"];
            if ($userId == $swimmerId) {
                return true;
            }
        }

        return false;
    }
}