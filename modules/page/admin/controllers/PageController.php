<?php

namespace modules\page\admin\controllers;

use src\Controller;
use modules\page\models\Page;




class PageController extends Controller
{
    public function runBeforeAction()
    {
        if ($_SESSION['is_admin'] ?? false == true) {
            return true;
        }

        $action = $_GET['action'] ?? $_POST['action'] ?? 'default';
        if ($action != 'login') {
            header("Location: /admin/index.php?module=dashboard&action=login");
        } else {
            return true;
        }
    }

    public function defaultAction()
    {
        $variables = [];

        $pageHandler = new Page($this->dbc);
        $pages = $pageHandler->findAll();

        $variables['pages'] = $pages;
        $this->template->view('page/admin/views/page-list', $variables);
    }

    public function editPageAction()
    {
        $pageId = $_GET['id'];
        $variables = [];

        $page = new Page($this->dbc);
        $page->findBy('id', $pageId);

        if ($_POST['action'] ?? false) {
            $page->setValue($_POST);

            $page->save();

            // $this->log->warning('Admin has chanded the page id: ' . $pageId);
        }



        $variables['page'] = $page;
        $this->template->view('page/admin/views/page-edit', $variables);
    }
}
