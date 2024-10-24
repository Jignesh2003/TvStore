<?php

class Validation
{
    /**
     * Sanitize a string to prevent SQL injection.
     *
     * This function removes potentially harmful characters and patterns
     * from the input string to reduce the risk of SQL injection.
     *
     * @param string $string The input string to sanitize.
     * @return string The sanitized string.
     */
    public static function preventSQLInjection($string)
    {
        // Trim whitespace from the beginning and end of the string.
        $string = trim($string);

        // Remove harmful characters and patterns using a regex.
        // This regex allows only alphanumeric characters, spaces, and a few selected characters.
        $string = preg_replace('/[^a-zA-Z0-9\s\-_\.@!#$%^&*+=~]/', '', $string);

        // Further sanitize the string by escaping certain characters.
        $string = str_replace([';', '--', '/*', '*/', '>', '<'], '', $string);

        // Return the sanitized string.
        return $string;
    }

    /**
     * Check if the provided email address is valid.
     *
     * This function uses a regular expression to check if the email
     * matches the standard email format. The format allows for a 
     * maximum length of 254 characters and includes basic validation 
     * for allowed characters, domain name, and TLD (Top Level Domain).
     *
     * @return bool Return true if the email is valid, false otherwise
     */
    public static function isValidEmail($email)
    {
        return preg_match("/^(?=.{1,254}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}(?:\.[a-zA-Z]{2,})?$/", $email) === 1;
    }


    /**
     * Validate the provided password against multiple criteria.
     *
     * This function checks the password length, presence of at least one letter,
     * and presence of at least one digit.
     *
     * @return array Returns an array where the first element is a boolean indicating
     *               validity, and the second element is the error message (if any).
     */
    public static function validatePassword($password)
    {
        // Check if the password length is at least 8 characters
        if (strlen($password) < 8) {
            return [true, 'Password must be at least 8 characters long.'];
        }

        // Check if the password contains at least one letter
        if (!preg_match("/[a-zA-Z]/", $password)) {
            return [true, 'Password must contain at least one letter.'];
        }

        // Check if the password contains at least one digit
        if (!preg_match("/\d/", $password)) {
            return [true, 'Password must contain at least one digit.'];
        }

        // If all checks pass, the password is valid
        return [false];
    }
}
