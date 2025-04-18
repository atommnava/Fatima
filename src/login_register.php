/*
 * @author Atom Alexder M. Nava
 * @brief First we call the session start function, this function is used to start a PHP session,
 * which allows us to store certain data that can be accessed across pages during the user session,
 * then we use require_once to import config.php file, which contains configuration for connecting to the MySQL database.
 * We check whether the register button has been clicked using the isset function, this function wants to check whether a variable
 * has been set or not. 
 */

<?php
// Handling the registration process
session_start();
require_once 'config.php';

/*
 * We need to create the condition 
 * to handle the REGISTRATION process
 */
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $checkEmail = $conn -> query("SELECT email FROM users WHERE email = '$email'");
    if ($checkEmail -> num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered!';
        $_SESSION['active_form'] = 'register';
    } else {
        $conn -> query("INSERT INTO users(name, email, password, role) VALUES('$name', '$email', '$password', '$role')");
    }
    header("Location: index.php");
    exit();
}

/*
 * We need to create another condition 
 * to handle the LOGIN process
 */
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $result = $conn -> query("SELECT * FROM users WHERE email = '$email'");
    if ($result -> num_rows > 0) {
        $user = $result -> fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            if ($user['role'] === 'admin') {
                header("Location: admin_page.php");
            } else {
                header("Location: user_page.php");
            }
            exit();
        }
    }
    $_SESSION['login_error'] = 'Incorrect email or password';
    $_SESSION['active_form'] = 'login';
    header("Location: index.php");
    exit();
}
?>