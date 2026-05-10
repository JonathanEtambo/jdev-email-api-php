<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\CSRF;
use App\Models\Site;
use App\Services\ApiKeyService;

class SiteController extends Controller {
    private Site $siteModel;
    private ApiKeyService $apiKeyService;

    public function __construct() {
        if (!Session::has('user_id')) {
            $this->redirect('/login');
        }
        $this->siteModel = new Site();
        $this->apiKeyService = new ApiKeyService();
    }

    public function index() {
        $userId = (int) Session::get('user_id');
        return $this->render('sites/index', [
            'title' => 'Mes Sites',
            'sites' => $this->siteModel->getByUserId($userId),
            'success' => Session::flash('success'),
            'error' => Session::flash('error')
        ], 'dashboard');
    }

    public function create() {
        return $this->render('sites/create', ['title' => 'Ajouter un site'], 'dashboard');
    }

    public function store() {
        CSRF::validate($_POST['csrf_token'] ?? '');
        $userId = (int) Session::get('user_id');

        $name = trim((string) ($_POST['name'] ?? ''));
        $domain = trim((string) ($_POST['domain'] ?? ''));
        $rateLimit = (int) ($_POST['rate_limit_per_minute'] ?? RATE_LIMIT_DEFAULT);

        if ($name === '' || $domain === '') {
            Session::flash('error', 'Nom et domaine sont obligatoires.');
            return $this->redirect('/sites/create');
        }

        if (!filter_var('https://' . $domain, FILTER_VALIDATE_URL)) {
            Session::flash('error', 'Domaine invalide. Exemple attendu: monsite.com');
            return $this->redirect('/sites/create');
        }

        $siteData = [
            'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
            'domain' => strtolower($domain),
            'site_id' => $this->apiKeyService->generateSiteId(),
            'public_key' => $this->apiKeyService->generatePublicKey(),
            'secret_key' => $this->apiKeyService->generateSecretKey(),
            'rate_limit_per_minute' => max(10, min(1000, $rateLimit)),
            'is_active' => 1
        ];

        $this->siteModel->createForUser($userId, $siteData);
        Session::flash('success', 'Site créé avec succès.');
        return $this->redirect('/sites');
    }

    public function edit($id) {
        $userId = (int) Session::get('user_id');
        $site = $this->siteModel->findByUserAndId($userId, (int) $id);

        if (!$site) {
            Session::flash('error', 'Site introuvable.');
            return $this->redirect('/sites');
        }

        return $this->render('sites/edit', [
            'title' => 'Modifier le site',
            'site' => $site,
            'success' => Session::flash('success'),
            'error' => Session::flash('error')
        ], 'dashboard');
    }

    public function update($id) {
        CSRF::validate($_POST['csrf_token'] ?? '');
        $userId = (int) Session::get('user_id');

        $site = $this->siteModel->findByUserAndId($userId, (int) $id);
        if (!$site) {
            Session::flash('error', 'Site introuvable.');
            return $this->redirect('/sites');
        }

        $name = trim((string) ($_POST['name'] ?? ''));
        $domain = trim((string) ($_POST['domain'] ?? ''));
        $rateLimit = (int) ($_POST['rate_limit_per_minute'] ?? RATE_LIMIT_DEFAULT);
        $isActive = isset($_POST['is_active']) ? 1 : 0;

        if ($name === '' || $domain === '') {
            Session::flash('error', 'Nom et domaine sont obligatoires.');
            return $this->redirect('/sites/edit/' . (int) $id);
        }

        $this->siteModel->updateForUser($userId, (int) $id, [
            'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
            'domain' => strtolower($domain),
            'rate_limit_per_minute' => max(10, min(1000, $rateLimit)),
            'is_active' => $isActive
        ]);

        if (isset($_POST['regenerate_keys'])) {
            $this->siteModel->regenerateKeys(
                $userId,
                (int) $id,
                $this->apiKeyService->generatePublicKey(),
                $this->apiKeyService->generateSecretKey()
            );
            Session::flash('success', 'Site mis à jour et clés API régénérées.');
        } else {
            Session::flash('success', 'Site mis à jour.');
        }

        return $this->redirect('/sites');
    }

    public function delete($id) {
        CSRF::validate($_POST['csrf_token'] ?? '');
        $userId = (int) Session::get('user_id');
        $this->siteModel->deleteForUser($userId, (int) $id);
        Session::flash('success', 'Site supprimé.');
        return $this->redirect('/sites');
    }
}
