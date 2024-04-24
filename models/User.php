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
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                return $user['role'];
            }
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
            // Insertion successful
            return true;
        } else {
            // Insertion failed
            return false;
        }
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

    public function getAllNonValSwimmerPerformance()
    {
        $query = "SELECT * FROM swim_performance WHERE validated = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $performances = [];
        while ($row = $result->fetch_assoc()) {
            $performances[] = $row;
        }
        $stmt->close();
        return $performances;
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

    public function getRelevantSwimmers($dob, $userId)
    {
        $query = "SELECT * FROM users WHERE dob = ? AND id != ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $dob, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $swimmers = [];
        while ($row = $result->fetch_assoc()) {
            $swimmers[] = $row;
        }
        $stmt->close();
        return $swimmers;
    }

    public function editPersonalDetails($userId, $data)
    {
        $query = "UPDATE users SET phone = ?, address = ?, postcode = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $data['phone'], $data['address'], $data['postcode'], $userId);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function editSwimmerPerformance($swimmerId, $performanceId, $data)
    {
        $query = "UPDATE swim_performance SET event_name = ?, event_date = ?, time = ? WHERE id = ? AND swimmer_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssii", $data['event_name'], $data['event_date'], $data['time'], $performanceId, $swimmerId);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function validateRaceData($performanceId)
    {
        $query = "UPDATE swim_performance SET validated = 1 WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $performanceId);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function isAdultSwimmer($userId)
    {
        $query = "SELECT date_of_birth FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $dob = $result->fetch_assoc()['date_of_birth'];
        $stmt->close();
        
        // Assuming an adult is someone aged 18 or older
        $eighteenYearsAgo = date('Y-m-d', strtotime('-18 years'));
        return $dob <= $eighteenYearsAgo;
    }

    public function getUserRole($userId)
    {
        $query = "SELECT role FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $role = $result->fetch_assoc()['role'];
        $stmt->close();
        return $role;
    }
}