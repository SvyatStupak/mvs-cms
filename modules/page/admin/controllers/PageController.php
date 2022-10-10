<?php

class PageController extends Controller
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
        $dbh = DataBaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageHandler = new Page($dbc);
        $pages = $pageHandler->findAll();

        $variables['pages'] = $pages;
        $this->template->view('page/admin/views/page-list', $variables);
    }
}

