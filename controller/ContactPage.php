<?php

class ContactController extends Controller
{
    function runBeforeAction()
    {
        if ($_SESSION['has_submitted_the_form'] ?? 0 == 1) {
            $variebles['title'] = 'You already contacted';
            $variebles['content'] = 'See you soon';

            $template = new Template('default');
            $template->view('static-page', $variebles);
            return false;
        }
        return true;
    }

    function defaultAction()
    {
        $variebles['title'] = 'Contact Us Page';
        $variebles['content'] = 'We wait you opinion';

        $template = new Template('default');
        $template->view('contact/contact-us', $variebles);
    }

    function submitAction()
    {
        $_SESSION['has_submitted_the_form'] = 1;

        $variebles['title'] = 'Thank you for contact';
        $variebles['content'] = 'See you soon';

        $template = new Template('default');
        $template->view('static-page', $variebles);

    }
}
