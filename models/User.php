<?php
class User
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    private function validateRequired($value)
    {
        return !empty($value);
    }

    private function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    private function validateLength($value, $min, $max)
    {
        $length = strlen($value);
        return $length >= $min && $length <= $max;
    }

    public function login($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                session_start();
                if ($user['role'] == 'parent') {
                    // Fetch swimmer_id from parent_swimmer table
                    $swimmer_id = $this->getSwimmerId($user['id']);
                    if ($swimmer_id !== false) {
                        $_SESSION['user_id'] = $swimmer_id;
                    } else {
                        // Unable to fetch swimmer_id, return false
                        return false;
                    }
                } else {
                    $_SESSION['user_id'] = $user['id'];
                }
                $_SESSION['username'] = $user['username'];
                $_SESSION['name'] = $user['first_name'] . " " . $user['last_name'];
                $_SESSION['role'] = $user['role'];
                return $user['role'];
            }
        }

        return false;
    }

    public function checkUser($username)
    {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['id'];
        }

        return false;
    }

    private function getSwimmerId($parent_id)
    {
        $sql = "SELECT swimmer_id FROM parent_swimmer WHERE parent_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $parent_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['swimmer_id'];
        }

        return false;
    }


    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
    }

    public function isLoggedIn()
    {
        session_start();
        return isset($_SESSION['user_id']);
    }

    public function getRole()
    {
        if (isset($_SESSION['role'])) {
            return $_SESSION['role'];
        }
        return null;
    }

    public function register($data)
    {
        $errors = [];

        if (!$this->validateRequired($data['username'])) {
            $errors[] = "Username is required";
        }

        if (!$this->validateRequired($data['password'])) {
            $errors[] = "Password is required";
        }

        if (!$this->validateRequired($data['first_name'])) {
            $errors[] = "First name is required";
        }

        if (!$this->validateRequired($data['last_name'])) {
            $errors[] = "Last name is required";
        }

        if (!$this->validateRequired($data['email'])) {
            $errors[] = "Email is required";
        } elseif (!$this->validateEmail($data['email'])) {
            $errors[] = "Invalid email format";
        }

        if (!$this->validateRequired($data['dob'])) {
            $errors[] = "Date of birth is required";
        } elseif (!$this->validateDate($data['dob'])) {
            $errors[] = "Invalid date format";
        }

        if (!$this->validateRequired($data['phone'])) {
            $errors[] = "Phone number is required";
        }

        if (!$this->validateRequired($data['address'])) {
            $errors[] = "Address is required";
        }

        if (!$this->validateRequired($data['postcode'])) {
            $errors[] = "Postcode is required";
        }

        if (!$this->validateRequired($data['role'])) {
            $errors[] = "Role is required";
        }

        if (!$this->validateLength($data['first_name'], 1, 50)) {
            $errors[] = "First name must be between 1 and 50 characters";
        }

        if (!$this->validateLength($data['last_name'], 1, 50)) {
            $errors[] = "Last name must be between 1 and 50 characters";
        }

        if (!$this->validateRequired($data['dob'])) {
            $errors[] = "Date of birth is required";
        } elseif (!$this->validateDate($data['dob'])) {
            $errors[] = "Invalid date format";
        } else {
            // Check if dob is after 1950
            if (strtotime($data['dob']) < strtotime('1950-01-01')) {
                $errors[] = "Date of birth must be after 1950";
            }
        
            // Check if dob is more than 3 years ago
            $threeYearsAgo = date('Y-m-d', strtotime('-3 years'));
            if (strtotime($data['dob']) > strtotime($threeYearsAgo)) {
                $errors[] = "Date of birth cannot be within 3 years from today";
            }
        }
        

        if (empty($errors)) {
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    
            $sql = "INSERT INTO users (username, password, first_name, last_name, email, dob, phone, address, postcode, role)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssssssss", $data['username'], $hashedPassword, $data['first_name'], $data['last_name'], $data['email'], $data['dob'], $data['phone'], $data['address'], $data['postcode'], $data['role']);
    
            if ($stmt->execute()) {
                return $this->conn->insert_id;
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function storeApplicant($data) {
        // Store the applicant in the applicants table
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO applicants (username, password, first_name, last_name, email, dob, phone, address, postcode, role, parent_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssssss", $data['username'], $hashedPassword, $data['first_name'], $data['last_name'], $data['email'], $data['dob'], $data['phone'], $data['address'], $data['postcode'], $data['role'] , $data['swimmer_id']);

        if ($stmt->execute()) {
            return $this->conn->insert_id;
        } else {
            return false;
        }
    }

    public function approveApplicant($applicant_id)
    {
        // Get applicant data from applicants table
        $sql = "SELECT * FROM applicants WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $applicant_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $applicant = $result->fetch_assoc();

            // Insert into users table
            $sql = "INSERT INTO users (username, password, first_name, last_name, email, dob, phone, address, postcode, role)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssssssss", $applicant['username'], $applicant['password'], $applicant['first_name'], $applicant['last_name'], $applicant['email'], $applicant['dob'], $applicant['phone'], $applicant['address'], $applicant['postcode'], $applicant['role']);

            if ($stmt->execute()) {
                $insert_id = $this->conn->insert_id;
            } else {
                $insert_id = null;
            }

            // Delete from applicants table
            $sql = "UPDATE applicants SET approved = TRUE WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $applicant_id);
            $stmt->execute();

            return $insert_id;

        } else {
            return false; // Applicant not found
        }
    }

    public function addParentForAppli($parentID, $id)
    {
        $errors = [];

        if (empty($errors)) {
            $sql = "UPDATE applicants SET parent_id = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $swimmer = "swimmer";
            $stmt->bind_param("ii", $parentID, $id);

            if ($stmt->execute()) {
                return true; // Success
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }
    }

    public function rejectApplicants($id)
    {
        $sql = "DELETE FROM applicants WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true; // Success
        } else {
            return false; // Error
        }
    }


    public function addParentSwimmer($parent_id, $swimmer_id) {
        // Prepare the SQL statement
        $sql = "INSERT INTO parent_swimmer (parent_id, swimmer_id) VALUES (?, ?)";
        
        // Prepare and execute the statement
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $parent_id, $swimmer_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserByRole($role)
    {
        $query = "SELECT * FROM users WHERE role = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $role);
        $stmt->execute();
        $result = $stmt->get_result();
        $details = array();
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        $stmt->close();
        return $details;
    }

    public function getApplicantsByRole($role)
    {
        $query = "SELECT * FROM applicants WHERE role = ? AND  approved = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $role);
        $stmt->execute();
        $result = $stmt->get_result();
        $details = array();
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        $stmt->close();
        return $details;
    }

    public function getUserCountByRole($role)
    {
        $query = "SELECT COUNT(*) as count FROM users WHERE role = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $role);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    }

    public function getSquadCount()
    {
        $query = "SELECT COUNT(*) as count FROM squad";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    }

    public function getSwimmerIdBySquad($data)
    {
        $query = "SELECT * FROM users WHERE role = 'swimmer' AND squad_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $data); // Assuming $data['id'] is an integer
        $stmt->execute();
        $result = $stmt->get_result();
        $details = array();
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        $stmt->close();
        return $details;
    }


    public function getUserById($userId)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        
        return $user; 
    }

    public function getUserIDByUsername($username)
    {
        $query = "SELECT id FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        
        // If a user with the given username exists, return the user ID
        if ($user) {
            return $user['id'];
        } else {
            return null; // Return null if no user found with the given username
        }
    }


    public function updateUser($data)
    {
        $errors = [];

        // Check if a new password is provided (different from the current hashed password)
        if (!empty($data['password']) && $data['password'] !== $data['current_password']) {
            // Hash the new password
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            // Keep the existing hashed password
            $hashedPassword = $data['current_password'];
        }

        if (empty($errors)) {
            $sql = "UPDATE users SET username=?, password=?, first_name=?, last_name=?, email=?, dob=?, phone=?, address=?, postcode=?, role=? WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssssssssi", $data['username'], $hashedPassword, $data['first_name'], $data['last_name'], $data['email'], $data['dob'], $data['phone'], $data['address'], $data['postcode'], $data['role'], $data['id']);

            if ($stmt->execute()) {
                return true; // Success
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true; // Success
        } else {
            return false; // Error
        }
    }
    

    public function AddUserToSquad($data)
    {
        $errors = [];

        if (empty($errors)) {
            $sql = "UPDATE users SET squad_id=? WHERE role=? AND id=?";
            $stmt = $this->conn->prepare($sql);
            $swimmer = "swimmer";
            $stmt->bind_param("isi", $data['squad_id'] , $swimmer, $data['id']);

            if ($stmt->execute()) {
                return true; // Success
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }
    }

    public function RemoveUserFromSquad($data)
    {
        $errors = [];

        if (empty($errors)) {
            $sql = "UPDATE users SET squad_id=NULL WHERE role=? AND id=?";
            $stmt = $this->conn->prepare($sql);
            $swimmer = "swimmer";
            $stmt->bind_param("ss", $swimmer, $data);

            if ($stmt->execute()) {
                return true; // Success
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }
    }



    public function addMeet($data)
    {
        $errors = [];

        if (empty($errors)) {
    
            $sql = "INSERT INTO meets (MeetName, MeetDate, Location)
                    VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $data['meet_name'], $data['meet_date'], $data['meet_location']);
    
            if ($stmt->execute()) {
                return true;
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function getAllMeets()
    {
        $query = "SELECT * FROM meets";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $details = array();
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        $stmt->close();
        return $details;
    }

    public function getMeetById($meetId)
    {
        $query = "SELECT * FROM meets WHERE MeetID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $meetId);
        $stmt->execute();
        $result = $stmt->get_result();
        $meet = $result->fetch_assoc();
        $stmt->close();
        
        return $meet;
    }

    public function updateMeet($data)
    {
        $errors = [];

        if (empty($errors)) {
            $sql = "UPDATE meets SET MeetName=?, MeetDate=?, Location=? WHERE MeetID=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssi", $data['meet_name'], $data['meet_date'], $data['meet_location'], $data['id']);

            if ($stmt->execute()) {
                return true; // Success
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function deleteMeet($meetId)
    {
        $sql = "DELETE FROM meets WHERE MeetId=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $meetId);

        if ($stmt->execute()) {
            return true; // Success
        } else {
            return false; // Error
        }
    }

    public function addRace($data)
    {
        $errors = [];

        if (empty($errors)) {
            $sql = "INSERT INTO races (RaceName, Distance, Stroke, Date, Location, MeetID)
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssssi", $data['race_name'], $data['distance'], $data['stroke'], $data['date'], $data['location'], $data['meet_id']);

            if ($stmt->execute()) {
                return true; // Success
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function getAllRaces()
    {
        $query = "SELECT * FROM races";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $races = array();
        while ($row = $result->fetch_assoc()) {
            $races[] = $row;
        }
        $stmt->close();
        return $races;
    }

    public function getRaceById($raceId)
    {
        $query = "SELECT * FROM races WHERE RaceID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $raceId);
        $stmt->execute();
        $result = $stmt->get_result();
        $race = $result->fetch_assoc();
        $stmt->close();
        
        return $race;
    }

    public function updateRace($data)
    {
        $errors = [];

        if (empty($errors)) {
            $sql = "UPDATE races SET RaceName=?, Distance=?, Stroke=?, Date=?, Location=?, MeetID=? WHERE RaceID=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssssii", $data['race_name'], $data['distance'], $data['stroke'], $data['date'], $data['location'], $data['meet_id'], $data['id']);

            if ($stmt->execute()) {
                return true; // Success
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function deleteRace($raceId)
    {
        $sqlDeleteResults = "DELETE FROM raceresults WHERE RaceID=?";
        $stmtDeleteResults = $this->conn->prepare($sqlDeleteResults);
        $stmtDeleteResults->bind_param("i", $raceId);
        $stmtDeleteResults->execute();
        
        $sql = "DELETE FROM races WHERE RaceID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $raceId);

        if ($stmt->execute()) {
            return true; // Success
        } else {
            return false; // Error
        }
    }

    public function addRaceResult($data)
    {
        $errors = [];

        if (empty($errors)) {
            $check_sql = "SELECT COUNT(*) as count FROM raceresults WHERE RaceID = ? AND PlaceAchieved = ?";
            $stmt = $this->conn->prepare($check_sql);
            $stmt->bind_param("ii", $data['race_id'], $data['place_achieved']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $count = $row['count'];

            if ($count > 0) {
                echo "Another swimmer already holds this place for this race.";
                return;
            }

            $sql = "INSERT INTO raceresults (RaceID, SwimmerID, TimeTaken, PlaceAchieved)
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iisi", $data['race_id'], $data['swimmer_id'], $data['time_taken'], $data['place_achieved']);

            if ($stmt->execute()) {
                return true; // Success
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function getAllRaceResults()
    {
        $query = "SELECT * FROM raceresults";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $raceResults = array();
        while ($row = $result->fetch_assoc()) {
            $raceResults[] = $row;
        }
        $stmt->close();
        return $raceResults;
    }

    public function getRaceResultById($raceResultId)
    {
        $query = "SELECT * FROM raceresults WHERE ResultID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $raceResultId);
        $stmt->execute();
        $result = $stmt->get_result();
        $raceResult = $result->fetch_assoc();
        $stmt->close();
        
        return $raceResult;
    }

    public function getRaceResultByRaceID($raceResultId)
    {
        $query = "SELECT * FROM raceresults WHERE RaceID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $raceResultId);
        $stmt->execute();
        $result = $stmt->get_result();

        $details = array();
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        $stmt->close();
        return $details;
    }

    public function getRaceResultBySwimmerID($swimmerId)
    {
        $query = "SELECT rr.*, r.* FROM raceresults rr
                JOIN races r ON rr.RaceID = r.RaceID
                WHERE rr.SwimmerID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $swimmerId);
        $stmt->execute();
        $result = $stmt->get_result();

        $details = array();
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        $stmt->close();
        return $details;
    }


    public function updateRaceResult($data)
    {
        $errors = [];

        if (empty($errors)) {
            $sql = "UPDATE raceresults SET RaceID=?, SwimmerID=?, TimeTaken=?, PlaceAchieved=? WHERE ResultID=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iisii", $data['race_id'], $data['swimmer_id'], $data['time_taken'], $data['place_achieved'], $data['id']);

            if ($stmt->execute()) {
                return true; //Success
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function deleteRaceResult($raceResultId)
    {
        $sql = "DELETE FROM raceresults WHERE ResultID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $raceResultId);

        if ($stmt->execute()) {
            return true; // Success
        } else {
            return false; // Error
        }
    }

    public function addSquad($data)
    {
        $errors = [];

        if (empty($data['squad_name'])) {
            $errors[] = "Squad name is required";
        }

        if (empty($data['training_days'])) {
            $errors[] = "Training day is required";
        }

        if (empty($errors)) {

            $sql = "INSERT INTO squad (squad_name, training_days, start_time, end_time, coach_id)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssi", $data['squad_name'], $data['training_days'], $data['start_time'], $data['end_time'], $data['coach_id']);

            if ($stmt->execute()) {
                return true;
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function getAllSquads()
    {
        $query = "SELECT * FROM squad";
        $result = $this->conn->query($query);
        $squads = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $squads[] = $row;
            }
        }
        return $squads;
    }

    public function getSquadById($squadId)
    {
        $query = "SELECT * FROM squad WHERE squad_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $squadId);
        $stmt->execute();
        $result = $stmt->get_result();
        $squad = $result->fetch_assoc();
        $stmt->close();
        
        return $squad;
    }

    public function updateSquad($data)
    {
        $errors = [];

        if (empty($data['squad_name'])) {
            $errors[] = "Squad name is required";
        }

        if (empty($data['training_days'])) {
            $errors[] = "Training day is required";
        }

        if (empty($errors)) {
            $sql = "UPDATE squad SET squad_name=?, training_days=?, start_time=?, end_time=?, coach_id=? WHERE squad_id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssii", $data['squad_name'], $data['training_days'], $data['start_time'], $data['end_time'], $data['coach_id'], $data['squad_id']);

            if ($stmt->execute()) {
                return true;
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function deleteSquad($squadId)
    {
        $sql = "DELETE FROM squad WHERE squad_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $squadId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addTrainingSession($data)
    {
        $errors = [];

        if (empty($data['date'])) {
            $errors[] = "Date is required";
        }

        if (empty($data['distance'])) {
            $errors[] = "Distance is required";
        }

        if (empty($data['stroke'])) {
            $errors[] = "Stroke is required";
        }

        if (empty($data['squad_id'])) {
            $errors[] = "Squad ID is required";
        }

        if (empty($errors)) {

            $sql = "INSERT INTO training_session (Date, Distance, Stroke, Squad_id)
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sdsi", $data['date'], $data['distance'], $data['stroke'], $data['squad_id']);

            if ($stmt->execute()) {
                return true;
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function getAllTrainingSessions()
    {
        $query = "SELECT ts.*, s.squad_name 
        FROM training_session ts 
        JOIN squad s ON ts.Squad_id = s.squad_id";
        $result = $this->conn->query($query);
        $sessions = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $sessions[] = $row;
            }
        }
        return $sessions;
    }

    public function getTrainingSessionById($sessionId)
    {
        $query = "SELECT * FROM training_session WHERE SessionID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $sessionId);
        $stmt->execute();
        $result = $stmt->get_result();
        $session = $result->fetch_assoc();
        $stmt->close();
        
        return $session;
    }

    public function updateTrainingSession($data)
    {
        $errors = [];

        if (empty($data['date'])) {
            $errors[] = "Date is required";
        }

        if (empty($data['distance'])) {
            $errors[] = "Distance is required";
        }

        if (empty($data['stroke'])) {
            $errors[] = "Stroke is required";
        }

        if (empty($data['squad_id'])) {
            $errors[] = "Squad ID is required";
        }

        if (empty($errors)) {
            $sql = "UPDATE training_session SET Date=?, Distance=?, Stroke=?, Squad_id=? WHERE SessionID=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sdsii", $data['date'], $data['distance'], $data['stroke'], $data['squad_id'], $data['id']);

            if ($stmt->execute()) {
                return true;
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function deleteTrainingSession($sessionId)
    {
        $sql = "DELETE FROM training_session WHERE SessionID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $sessionId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function addTrainingPerformance($data)
    {
        $errors = [];

        if (empty($data['session_id'])) {
            $errors[] = "Session ID is required";
        }

        if (empty($data['swimmer_id'])) {
            $errors[] = "Swimmer ID is required";
        }

        if (empty($errors)) {
            $sql = "INSERT INTO training_performance (SessionID, Swimmer_id, TimeTaken, Comment)
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iiss", $data['session_id'], $data['swimmer_id'], $data['time_taken'], $data['comment']);

            if ($stmt->execute()) {
                return true;
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function getAllTrainingPerformances()
    {
        $query = "SELECT tp.*, ts.Date AS SessionDate, u.username AS SwimmerName 
                FROM training_performance tp 
                JOIN training_session ts ON tp.SessionID = ts.SessionID 
                JOIN users u ON tp.Swimmer_id = u.id";
        $result = $this->conn->query($query);
        $performances = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $performances[] = $row;
            }
        }
        return $performances;
    }

    public function getTrainingPerformanceById($performanceId)
    {
        $query = "SELECT * FROM training_performance WHERE PerformanceID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $performanceId);
        $stmt->execute();
        $result = $stmt->get_result();
        $performance = $result->fetch_assoc();
        $stmt->close();
        
        return $performance;
    }

    public function updateTrainingPerformance($data)
    {
        $errors = [];

        if (empty($data['session_id'])) {
            $errors[] = "Session ID is required";
        }

        if (empty($data['swimmer_id'])) {
            $errors[] = "Swimmer ID is required";
        }

        if (empty($errors)) {
            $sql = "UPDATE training_performance SET SessionID=?, Swimmer_id=?, TimeTaken=?, Comment=? WHERE PerformanceID=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iissi", $data['session_id'], $data['swimmer_id'], $data['time_taken'], $data['comment'], $data['id']);

            if ($stmt->execute()) {
                return true;
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function deleteTrainingPerformance($performanceId)
    {
        $sql = "DELETE FROM training_performance WHERE PerformanceID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $performanceId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getSwimmerIdByForPerformance($sessionId, $squadId)
    {
        $query = "SELECT * FROM users 
                WHERE role = 'swimmer' 
                AND squad_id = ? 
                AND id NOT IN (
                    SELECT Swimmer_id 
                    FROM training_performance 
                    WHERE SessionID = ?
                )";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $squadId, $sessionId);
        $stmt->execute();
        $result = $stmt->get_result();
        $details = array();
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        $stmt->close();
        return $details;
    }

    public function getSwimmerIdBySquadAndSession($sessionId)
    {
        $query = "SELECT tp.*, u.username 
        FROM training_performance tp 
        INNER JOIN users u ON tp.Swimmer_id = u.id 
        WHERE tp.SessionID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $sessionId);
        $stmt->execute();
        $result = $stmt->get_result();
        $details = array();
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        $stmt->close();
        return $details;
    }

    public function getPerformanceBySwimmer($swimmer_id)
    {
        $query = "SELECT tp.*, ts.* 
        FROM training_performance tp 
        INNER JOIN training_session ts ON tp.SessionID = ts.SessionID 
        WHERE tp.Swimmer_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $swimmer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $details = array();
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        $stmt->close();
        return $details;
    }


    public function isAdultSwimmer($userId)
    {
        $query = "SELECT dob FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $dob = $result->fetch_assoc()['dob'];
        $stmt->close();
        
        // Assuming an adult is someone aged 18 or older
        $eighteenYearsAgo = date('Y-m-d', strtotime('-18 years'));
        return $dob <= $eighteenYearsAgo;
    }
}