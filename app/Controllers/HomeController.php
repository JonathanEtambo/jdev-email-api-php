<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Plan;

class HomeController extends Controller {
    public function index() {
        $planModel = new Plan();
        return $this->render('home/index', [
            'title' => 'JDev Mail API - Solution d\'envoi d\'emails',
            'plans' => $planModel->getActivePlans(),
            'founder' => [
                'name' => 'JONATHAN DZOKO ETAMBO',
                'role' => 'Ingénieur Informaticien & Full-Stack Developer',
                'bio' => 'Passionné par l\'IoT, la cybersécurité et les solutions numériques haute performance.'
            ]
        ], 'main');
    }

    public function pricing() {
        $planModel = new Plan();
        return $this->render('home/pricing', [
            'title' => 'Tarifs - JDev Mail API',
            'plans' => $planModel->getActivePlans()
        ], 'main');
    }
}
