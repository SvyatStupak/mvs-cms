<?php

class HomePage extends Controller
{
    function defaultAction()
    {
        // $variables['title'] = 'Home page title';
        // $variables['content'] = 'Welcome to our Home page';

        $dbh = DataBaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);
        $pageObj->findById(1);

        $variables['pageObj'] = $pageObj;

        $template = new Template('default');
        $template->view('static-page', $variables);
    }
}

