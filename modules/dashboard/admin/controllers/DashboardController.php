<?php

class DashboardController extends Controller
{
    public function runBeforeAction()
    {
        if ($_SESSION['is_admin'] ?? false == true) 
        {
            return true;
        }

        $action = $_GET['action'] ?? $_POST['action'] ?? 'default';
        if($action != 'login')
        {
            header("Location: /admin/index.php?module=dashboard&action=login");
        } else {
            return true;
        }
        
    }

    public function defaultAction()
    {
        echo 'Welcome to admin dashboard';
    }

    public function loginAction()
    {
        if ($_POST['postAction'] ?? 0 == 1) 
        {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $validation = new Validation();
            
            // if (!$validation->validatePassword($password)) 
            // {
            //     $_SESSION['validationRules']['error'] = "Password must be beetwen 3 and 20 characters 
            //                                             and must be contain one special character";
                
            // }

            // if (!$validation->validateUsername($username)) 
            // {
            //     $_SESSION['validationRules']['error'] = "Username is not valid email";
                
            // }

            if (!$validation
                ->addRule(new ValidateMinimum(3))
                ->addRule(new ValidateMaximum(20))
                ->addRule(new ValidateSpecialCharacter())
                ->validate($password)
            )
            {
                $_SESSION['validationRules']['error'] = "Password must be beetwen 3 and 20 characters 
                                                         and must be contain one special character";
            }

            if (!$validation
                ->addRule(new ValidateMinimum(3))
                ->addRule(new ValidateMaximum(20))
                ->addRule(new ValidateEmail())
                ->validate($username)
            )
            {
                $_SESSION['validationRules']['error'] = "Username is not valid email";
            }

            $auth = new Auth();
            
            if (($_SESSION['validationRules']['error'] ?? '') == '') 
            {
                if ($auth->checkLogin($username, $password)) {
                    $_SESSION['is_admin'] = 1;
                    header("Location: /admin/");
                    exit();
                } 

                $_SESSION['validationRules']['error'] = 'Username or password is incorect';
                
            }
        }

        include VIEW_PATH . 'admin/login.php';
        unset($_SESSION['validationRules']['error']);
    }
    
}
