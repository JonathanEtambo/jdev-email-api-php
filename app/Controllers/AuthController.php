<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Core\Session;
use App\Core\CSRF;

class AuthController extends Controller {

    public function showLogin() {
        return $this->render('auth/login', ['title' => 'Connexion'], 'auth');
    }

    public function login() {
        CSRF::validate($_POST['csrf_token']);

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['status'] !== 'active') {
                return $this->render('auth/login', ['error' => 'Compte suspendu.'], 'auth');
            }

            Session::set('user_id', $user['id']);
            Session::set('user_role', $user['role']);
            Session::set('user_name', $user['name']);

            $this->redirect('/dashboard');
        }

        return $this->render('auth/login', ['error' => 'Identifiants invalides.'], 'auth');
    }

    public function showRegister() {
        return $this->render('auth/register', ['title' => 'Inscription'], 'auth');
    }

    public function register() {
        CSRF::validate($_POST['csrf_token']);

        $data = [
            'name' => htmlspecialchars($_POST['name']),
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            'password' => $_POST['password']
        ];

        $userModel = new User();
        if ($userModel->findByEmail($data['email'])) {
            return $this->render('auth/register', ['error' => 'Cet email est déjà utilisé.'], 'auth');
        }

        if ($userModel->create($data)) {
            $this->redirect('/login?registered=1');
        }

        return $this->render('auth/register', ['error' => 'Une erreur est survenue.'], 'auth');
    }

    public function logout() {
        Session::destroy();
        $this->redirect('/login');
    }
}