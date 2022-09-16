<?php

class AboutUsPage extends Controller
{
    function defaultAction()
    {
        $variables['title'] = 'About page';
        $variables['content'] = 'About us connent page';

        $template = new Template('default');
        $template->view('static-page', $variables);

    }
}

