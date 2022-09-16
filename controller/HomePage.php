<?php

class HomePage extends Controller
{
    function defaultAction()
    {
        $variables['title'] = 'Home page title';
        $variables['content'] = 'Welcome to our Home page';

        $template = new Template('default');
        $template->view('static-page', $variables);
    }
}

