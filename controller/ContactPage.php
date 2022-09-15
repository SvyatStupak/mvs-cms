<?php

class ContactController extends Controller
{
    function runBeforeAction() {
        echo 'runBeforeAction <br>';
        if($_SESSION['has_submitted_the_form'] ?? 0 == 1) 
        {
            include 'view/contact/contact-us-already-contacted.php';
            return false;
        }
        return true;
    }

    function defaultAction()
    {
        echo 'defaultAction <br>';
        include 'view/contact/contact-us.php';
    }

    function submitAction()
    {
        echo 'submitAction <br>';
        $_SESSION['has_submitted_the_form'] = 1;

        include 'view/contact/contact-us-thank-you.php';
    }

    
}




