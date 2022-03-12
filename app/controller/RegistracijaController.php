<?php
  class RegistracijaController extends Controller
  {
      public function index()
      {
          $this->regView('Popunite podatke','');
      }

      public function registriraj()

      {
          
        // Init vars
        $name = $email = $password = $confirm_password = '';
        $name_err = $email_err = $password_err = $confirm_password_err = '';

        // Process form when post submit
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Sanitize POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Put post vars in regular vars
        $name =  trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

        // Validate email
        if(empty($email)){
        $email_err = 'Please enter email';
        } else {
        // Prepare a select statement
        $sql = 'SELECT id FROM users WHERE email = :email';

      if($stmt = $pdo->prepare($sql)){
        // Bind variables
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        // Attempt to execute
        if($stmt->execute()){
          // Check if email exists
          if($stmt->rowCount() === 1){
            $email_err = 'Email is already taken';
          }
        } else {
          die('Something went wrong');
        }
      }

      unset($stmt);
    }

            // Validate name
            if(empty($name)){
            $name_err = 'Please enter name';
            }

            // Validate password
            if(empty($password)){
            $password_err = 'Please enter password';
            } elseif(strlen($password) < 6){
            $password_err = 'Password must be at least 6 characters ';
            }

            // Validate Confirm password
            if(empty($confirm_password)){
            $confirm_password_err = 'Please confirm password';
            } else {
            if($password !== $confirm_password){
                $confirm_password_err = 'Passwords do not match';
            }
            }

            // Make sure errors are empty
            if(empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
            // Hash password
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare insert query
            $sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';

            if($stmt = $pdo->prepare($sql)){
                // Bind params
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);

                // Attempt to execute
                if($stmt->execute()){
                // Redirect to login
                header('location: login.php');
                } else {
                die('Something went wrong');
                }
            }
            unset($stmt);
            }

            // Close connection
            unset($pdo);
        }
    }
    




      private function regView($poruka,$email)
    {
        $this->view->render('registracija',[
            'poruka'=>$poruka,
            'email'=>$email
        ]);
    }
}