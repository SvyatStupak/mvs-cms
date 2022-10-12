<?php

namespace modules\contact\controllers;

use src\Controller;
use modules\page\models\Page;

class ContactController extends Controller
{
    public function runBeforeAction()
    {
        if ($_SESSION['has_submitted_the_form'] ?? 0 == 1) {

            $pageObj = new Page($this->dbc);
            $pageObj->findBy('id', 3);

            $variebles['pageObj'] = $pageObj;

            $this->template->view('page/views/static-page', $variebles);
            return false;
        }
        return true;
    }

    public function defaultAction()
    {

        $pageObj = new Page($this->dbc);
        $pageObj->findBy('id', $this->entityId);

        $variebles['pageObj'] = $pageObj;

        $this->template->view('contact/views/contact-us', $variebles);
    }

    public function submitAction()
    {
        $_SESSION['has_submitted_the_form'] = 1;

        $pageObj = new Page($this->dbc);
        $pageObj->findBy('id', $this->entityId);


        $variebles['pageObj'] = $pageObj;

        $this->template->view('page/views/static-page', $variebles);
    }
}
