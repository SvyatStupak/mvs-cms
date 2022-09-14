<?php

class ContactController extends Controller
{
    function defaultAction()
    {
        include 'view/contact-us.php';
    }

    function submitAction()
    {
        include 'view/contact-us-thank-you.php';
    }

    
}




