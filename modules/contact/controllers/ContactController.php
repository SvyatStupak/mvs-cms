<?php

class ContactController extends Controller
{
    public function runBeforeAction()
    {
        if ($_SESSION['has_submitted_the_form'] ?? 0 == 1) {

            $dbh = DataBaseConnection::getInstance();
            $dbc = $dbh->getConnection();

            $pageObj = new Page($dbc);
            $pageObj->findBy('id', 3);

            $variebles['pageObj'] = $pageObj;

            $this->template->view('page/views/static-page', $variebles);
            return false;
        }
        return true;
    }

    public function defaultAction()
    {

        $dbh = DataBaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);
        $pageObj->findBy('id', $this->entityId);

        $variebles['pageObj'] = $pageObj;

        $this->template->view('contact/views/contact-us', $variebles);
    }

    public function submitAction()
    {
        $_SESSION['has_submitted_the_form'] = 1;

        $dbh = DataBaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);
        $pageObj->findBy('id', $this->entityId);


        $variebles['pageObj'] = $pageObj;

        $this->template->view('page/views/static-page', $variebles);
    }
}
