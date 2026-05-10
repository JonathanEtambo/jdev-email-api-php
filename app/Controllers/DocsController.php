<?php
namespace App\Controllers;

use App\Core\Controller;

class DocsController extends Controller {
    public function index() {
        return $this->render('docs/index', [
            'title' => 'Documentation API - JDev Mail'
        ], 'main');
    }
}
