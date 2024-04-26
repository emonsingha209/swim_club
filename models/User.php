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
                $_SESSION['name'] = $user['first_name'];
                $_SESSION['role'] = $user['role'];
                return $user['role'];
            }
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

    public function getAllCoach()
    {
        $query = "SELECT * FROM users WHERE role = ?";
        $stmt = $this->conn->prepare($query);
        $role = "coach"; // Define the role value
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

    public function getCoachById($coachId)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $coachId);
        $stmt->execute();
        $result = $stmt->get_result();
        $coach = $result->fetch_assoc();
        $stmt->close();
        
        return $coach; // Return coach information
    }

    public function updateCoach($data)
    {
        $errors = [];

        if (empty($errors)) {
            $sql = "UPDATE users SET username=?, password=?, first_name=?, last_name=?, email=?, dob=?, phone=?, address=?, postcode=?, role=? WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssssssssi", $data['username'], $data['password'], $data['first_name'], $data['last_name'], $data['email'], $data['dob'], $data['phone'], $data['address'], $data['postcode'], $data['role'], $data['id']);

            if ($stmt->execute()) {
                return true; // Success
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function deleteCoach($coachId)
    {
        $sql = "DELETE FROM users WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $coachId);

        if ($stmt->execute()) {
            return true; // Success
        } else {
            return false; // Error
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

   

    public function updatePersonalDetails($userId, $data)
    {
        $errors = [];

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

        if (!$this->validateLength($data['first_name'], 1, 50)) {
            $errors[] = "First name must be between 1 and 50 characters";
        }

        if (!$this->validateLength($data['last_name'], 1, 50)) {
            $errors[] = "Last name must be between 1 and 50 characters";
        }

        if (empty($errors)) {
            $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, dob = ?, phone = ?, address = ?, postcode = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssssssi", $data['first_name'], $data['last_name'], $data['email'], $data['dob'], $data['phone'], $data['address'], $data['postcode'], $userId);

            if ($stmt->execute()) {
                return true;
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    public function getSwimmerDetails($swimmerId)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $swimmerId);
        $stmt->execute();
        $result = $stmt->get_result();
        $details = $result->fetch_assoc();
        $stmt->close();
        return $details;
    }

    

    public function addSwimPerformance($userId, $data)
    {
        $errors = [];

        if (!$this->validateRequired($data['event_name'])) {
            $errors[] = "Event name is required";
        }

        if (!$this->validateRequired($data['event_date'])) {
            $errors[] = "Event date is required";
        } elseif (!$this->validateDate($data['event_date'])) {
            $errors[] = "Invalid date format";
        }

        if (!$this->validateRequired($data['time'])) {
            $errors[] = "Time is required";
        }

        if (empty($errors)) {
            $sql = "INSERT INTO swim_performances (user_id, event_name, event_date, time)
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("isss", $userId, $data['event_name'], $data['event_date'], $data['time']);

            if ($stmt->execute()) {
                return true;
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        return $errors;
    }

    

    public function getSwimmerPerformance($swimmerId)
    {
        $query = "SELECT * FROM swim_performance WHERE swimmer_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $swimmerId);
        $stmt->execute();
        $result = $stmt->get_result();
        $performances = [];
        while ($row = $result->fetch_assoc()) {
            $performances[] = $row;
        }
        $stmt->close();
        return $performances;
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