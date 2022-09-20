<?php

class ContactController extends Controller
{
    function runBeforeAction()
    {
        if ($_SESSION['has_submitted_the_form'] ?? 0 == 1) {

            $dbh = DataBaseConnection::getInstance();
            $dbc = $dbh->getConnection();

            $pageObj = new Page($dbc);
            $pageObj->findBy('id', $this->entityId);

            $variebles['pageObj'] = $pageObj;

            $template = new Template('default');
            $template->view('static-page', $variebles);
            return false;
        }
        return true;
    }

    function defaultAction()
    {

        $dbh = DataBaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);
        $pageObj->findBy('id', $this->entityId);

        $variebles['pageObj'] = $pageObj;

        $template = new Template('default');
        $template->view('contact/contact-us', $variebles);
    }

    function submitAction()
    {
        $_SESSION['has_submitted_the_form'] = 1;

        $dbh = DataBaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);
        $pageObj->findBy('id', $this->entityId);


        $variebles['pageObj'] = $pageObj;


        $template = new Template('default');
        $template->view('static-page', $variebles);
    }
}
