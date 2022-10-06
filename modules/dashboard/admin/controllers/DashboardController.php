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
        header("Location: /admin/index.php?module=page");
    }

    public function loginAction()
    {
        if ($_POST['postAction'] ?? 0 == 1) 
        {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $validation = new Validation();

            if (!$validation
                ->addRule(new ValidateMinimum(3))
                ->addRule(new ValidateMaximum(20))
                // ->addRule(new ValidateSpecialCharacter())
                // ->addRule(new ValidateNoEmptySpaces())
                ->validate($password)
            )
            {
                $_SESSION['validationRules']['errors'] = $validation->getAllErrors();
            }

            if (!$validation
                ->addRule(new ValidateMinimum(3))
                ->addRule(new ValidateMaximum(20))
                // ->addRule(new ValidateEmail())
                ->validate($username)
            )
            {
                $_SESSION['validationRules']['errors'] = $validation->getAllErrors();
            }

            $auth = new Auth();
            
            if (empty($_SESSION['validationRules']['errors'])) 
            {
                if ($auth->checkLogin($username, $password)) {
                    $_SESSION['is_admin'] = 1;
                    header("Location: /admin/");
                    exit();
                } 

                $_SESSION['validationRules']['errors'] = ['Username or password is incorect'];
                
            }
        }

        include VIEW_PATH . 'admin/login.php';
        unset($_SESSION['validationRules']['errors']);
    }
    
}
