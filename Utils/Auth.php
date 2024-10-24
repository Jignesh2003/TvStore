<?php

require_once(__DIR__ . '/Validation.php');

class Authentication
{
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $confirm_password;

    /**
     * Initializes the user authentication data.
     *
     * This function assigns the provided user information to the object's properties.
     * The values are sanitized to prevent SQL injection.
     *
     * @param string $firstName The user's first name.
     * @param string $lastName The user's last name.
     * @param string $email The user's email address.
     * @param string $password The user's password.
     * @param string $password The user's confirm password.
     *
     */
    public function __construct($firstName = null, $lastName = null, $email = null, $password = null, $confirm_password = null)
    {
        // Si los valores son proporcionados, los sanitizamos
        if ($firstName !== null) {
            $this->firstName = Validation::preventSQLInjection($firstName);
        }

        if ($lastName !== null) {
            $this->lastName = Validation::preventSQLInjection($lastName);
        }

        if ($email !== null) {
            $this->email = Validation::preventSQLInjection($email);
        }

        if ($password !== null) {
            $this->password = Validation::preventSQLInjection($password);
        }

        if ($confirm_password !== null) {
            $this->confirm_password = Validation::preventSQLInjection($confirm_password);
        }
    }

    /**
     * Gets the user's email.
     *
     * @return string The sanitized email address.
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Establishes a connection to the database.
     *
     * This function attempts to connect to the database using the provided credentials.
     * If the connection fails, it returns an error message. Otherwise, it returns
     * the connection object.
     *
     * @return mysqli|string Returns the connection object on success, or an error message on failure.
     */
    function dataBase()
    {
        // Database connection credentials
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "televisiondb";

        // Create a new MySQLi connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check if the connection was successful
        if ($conn->connect_error) {
            throw new Exception("Failed to connect to database: " . $conn->connect_error);
        }

        // Return the connection object
        return $conn;
    }

    /**
     * Registers a new user in the database.
     *
     * This function checks if the provided password and confirmed password match,
     * validates the email format, checks for existing email addresses in the database,
     * and validates the password against security criteria. If all checks pass,
     * the user is registered in the database and a session is initialized.
     *
     * @return string|false Returns an error message if any validation fails, 
     *                     or false if the registration is successful.
     */
    function register()
    {
        // Check if the confirmed password is not the same as the original password
        if ($this->confirm_password != $this->password) return 'The passwords do not match.';

        // Validate the email format
        $validateEmail = Validation::isValidEmail($this->email);
        if (!$validateEmail) return 'The provided email address is not valid.';

        // Check if the email already exists in the database
        $validateEmail = $this->existEmail();
        if ($validateEmail) return 'The email address is already registered.';

        // Validate the password against security criteria
        $validatePassword = Validation::validatePassword($this->password);
        if ($validatePassword[0]) return $validatePassword[1];

        // Hash the password for secure storage
        $this->password = $this->hashPassword($this->password);

        // Establish a connection to the database
        $conn = $this->dataBase();

        // Prepare the SQL statement to insert a new user into the database
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");

        // Bind parameters to the prepared statement
        $stmt->bind_param('ssss', $this->firstName, $this->lastName, $this->email, $this->password);

        // Execute the statement
        $stmt->execute();

        // Close the statement to free up resources
        $stmt->close();

        // Close the database connection
        $conn->close();

        // Initialize the session for the newly registered user
        $this->initializeSession();

        // Return false to indicate successful registration
        return false;
    }

    /**
     * Handles user login by validating the email and password.
     *
     * This function checks if the email exists in the database.
     * If the email exists, it verifies the password. 
     * If the credentials are correct, it initializes the user session.
     * 
     * @return string|null Returns a success message if the login is successful,
     *                    an error message if the email does not exist, 
     *                    or if the password does not match.
     */
    function login()
    {
        // Check if the email exists in the database
        $validateEmail = $this->existEmail();

        // If the email exists, verify the password
        if ($validateEmail) {
            // Establish a connection to the database
            $conn = $this->dataBase();

            // Prepare the SQL statement to check if the email exists in the users table
            $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");

            // Bind the email parameter to the prepared statement
            $stmt->bind_param('s', $this->email);

            // Execute the prepared statement
            $stmt->execute();

            // Get the result of the executed query
            $result = $stmt->get_result();

            // Fetch the password from the result
            $row = $result->fetch_assoc(); // Fetch the associative array
            $storedPassword = $row['password']; // Get the stored password

            // Verify if the provided password matches the stored password
            if ($this->verifyPassword($this->password, $storedPassword)) {
                // Initialize the session for the user if the password is correct
                $this->initializeSession();

                return false;
            } else {
                // Return an error message if the password does not match
                return "The password entered does not match our records. Please try again.";
            }
        } else {
            // Return an error message if the email does not exist
            return "The email address entered does not exist. Please check it or register for a new account.";
        }
    }

    /**
     * Retrieves the user based on either the rememberMe token or session email.
     *
     * If the rememberMe cookie is set, it fetches the user by token. Otherwise,
     * it retrieves the user based on the email stored in the session (if logged in).
     *
     * @return array|false Returns an associative array of user data if found, or null otherwise.
     */
    public function getUser()
    {
        // Check if the "rememberMe" cookie is set and valid
        if (isset($_COOKIE['rememberMe']) && !empty($_COOKIE['rememberMe'])) {
            // Retrieve the user based on the rememberMe token
            return $this->getUserByToken();

            // If "rememberMe" is not set, check if the user is logged in with a session
        } else if (isset($_SESSION['isLogin']) && $_SESSION['isLogin']) {
            // Get the email from the session
            $email = $_SESSION['email'];

            // Establish a connection to the database
            $conn = $this->dataBase();

            // Prepare the SQL statement to select the user based on the session email
            $stmt = $conn->prepare("SELECT id, firstname, lastname, email FROM users WHERE email = ?");

            // Bind the email parameter to the statement
            $stmt->bind_param("s", $email);

            // Execute the statement
            $stmt->execute();

            // Get the result of the query
            $result = $stmt->get_result();

            // Close database
            $conn->close();

            // Fetch and return the associative array of the user data
            return $result->fetch_assoc();
        }

        // Return null if no valid session or rememberMe cookie is found
        return false;
    }


    /**
     * Checks if the provided email already exists in the database.
     *
     * This function prepares and executes a query to determine if the specified
     * email address is already registered in the users table. It returns true
     * if the email exists, and false otherwise.
     *
     * @return bool Returns true if the email exists, false if it does not.
     */
    private function existEmail()
    {
        // Establish a connection to the database
        $conn = $this->dataBase();

        // Prepare the SQL statement to check if the email exists in the users table
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?"); // Selecting only the email for efficiency

        // Bind the email parameter to the prepared statement
        $stmt->bind_param('s', $this->email);

        // Execute the prepared statement
        $stmt->execute();

        // Get the result of the executed query
        $result = $stmt->get_result();

        // Close the prepared statement to free up resources
        $stmt->close();

        // Close the database connection
        $conn->close();

        // Check if any rows were returned from the query
        // If rows exist, it means the email is already registered
        if ($result->num_rows > 0) {
            return true; // Email exists in the database
        }

        // If no rows were returned, the email is not registered
        return false; // Email does not exist in the database
    }


    /**
     * Hashes the given password using a secure hashing algorithm.
     *
     * This function takes a plain text password as input and returns a hashed version
     * of the password. The PASSWORD_DEFAULT algorithm is used, which automatically
     * selects a strong algorithm and generates a secure hash.
     *
     * @param string $password The plain text password to be hashed.
     * @return string The hashed password.
     */
    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verifies the provided password against the stored hash.
     *
     * This function checks if the input password matches the hashed password stored
     * in the database. It uses the password_verify function, which securely compares
     * the plain text password with the hashed value.
     *
     * @param string $inputPassword The plain text password entered by the user.
     * @param string $storedHash The hashed password retrieved from the database.
     * @return bool Returns true if the password matches the hash, false otherwise.
     */
    private function verifyPassword($inputPassword, $storedHash)
    {
        return password_verify($inputPassword, $storedHash);
    }

    /**
     * Initializes a user session and manages "remember me" functionality.
     *
     * This function starts a new session and sets session parameters for security.
     * If the "remember me" option is enabled, it generates a secure token, stores it 
     * in a cookie, and saves it to the database. If not, it clears the "remember me" cookie.
     * It also sets the session variables needed to maintain user login status.
     *
     * @param bool $rememberMe Whether or not the user selected the "remember me" option.
     */
    private function initializeSession($rememberMe = false)
    {
        // Check if a session is already started
        if (session_status() === PHP_SESSION_NONE) {
            // Set a custom name for the session
            session_name("login");

            // Start the session with custom cookie parameters
            session_start([
                'cookie_lifetime' => 0,  // The session cookie lasts until the browser is closed
                'cookie_secure' => false, // Should be true if using HTTPS
                'cookie_httponly' => true, // Prevents JavaScript from accessing the session cookie
                'cookie_samesite' => 'Strict' // Restricts cookie to same-site requests
            ]);

            // Regenerate the session ID to prevent session fixation attacks
            session_regenerate_id(true);
        }

        // Handle "remember me" functionality
        if ($rememberMe) {
            $rememberMeDuration = 604800; // 604800 seconds = 1 week

            // Generate a secure random token for "remember me"
            $token = bin2hex(random_bytes(16));

            // Set the "rememberMe" cookie with the token, valid for 1 week
            setcookie("rememberMe", $token, time() + $rememberMeDuration, "/", "", false, true);

            // Save the token in the database associated with the user's email
            $this->saveRememberMeToken($this->email, $token);
        } else {
            // If "remember me" is not selected, clear the cookie
            setcookie("rememberMe", "", time() - 3600, "/", "", false, true);
        }

        // Assign session variables with the user's email and login status
        $_SESSION["email"] = $this->email;
        $_SESSION["isLogin"] = true;
    }

    /**
     * Saves the remember me token in the database.
     *
     * This function updates the remember_token field for a specific user
     * identified by their email address. It uses prepared statements to
     * prevent SQL injection attacks.
     *
     * @param string $email The email address of the user.
     * @param string $token The remember me token to be saved.
     * @return bool Returns true on success, false on failure.
     */
    private function saveRememberMeToken($email, $token)
    {
        // Establish a connection to the database
        $conn = $this->dataBase();

        // Prepare the SQL statement to update the remember token for the given email
        $stmt = $conn->prepare("UPDATE users SET remember_token = ? WHERE email = ?");

        // Bind the token and email parameters to the statement
        $stmt->bind_param("ss", $token, $email);

        // Execute the statement
        $result = $stmt->execute();

        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();

        // Return the result of the execution
        return $result;
    }

    /**
     * Retrieves the user based on the remember me token.
     *
     * This function checks the rememberMe cookie for the stored token
     * and retrieves the user information from the database where the
     * remember_token matches the provided token. It uses prepared
     * statements for secure database access.
     *
     * @return array|null Returns an associative array of user data if found,
     *                    or null if no user matches the token.
     */
    private function getUserByToken()
    {
        // Get the token from the rememberMe cookie
        $token = $_COOKIE['rememberMe'];

        // Establish a connection to the database
        $conn = $this->dataBase();

        // Prepare the SQL statement to select the user where the remember token matches
        $stmt = $conn->prepare("SELECT * FROM users WHERE remember_token = ?");

        // Bind the token parameter to the statement
        $stmt->bind_param("s", $token);

        // Execute the statement
        $stmt->execute();

        // Get the result of the query
        $result = $stmt->get_result();

        // Close database
        $conn->close();

        // Fetch the associative array of the user data from the result
        return $result->fetch_assoc();
    }
}
