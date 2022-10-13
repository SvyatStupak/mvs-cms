<?php

namespace modules\page\controllers;

use \src\Controller;
use modules\page\models\Page;

class PageController extends Controller
{
    function defaultAction()
    {
        $pageObj = new Page($this->dbc);
        $pageObj->findBy('id', $this->entityId);

        $variables['pageObj'] = $pageObj;

        $this->template->view('page/views/static-page', $variables);

    }
}

