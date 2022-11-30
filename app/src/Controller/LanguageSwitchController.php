<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class LanguageSwitchController extends AbstractController
{
    #[Route(path: '/switchLanguage/{targetLanguage}', name: 'app.languageSwitch.switchLanguage')]
    public function switchLanguage(
        string $targetLanguage,
        SessionInterface $session,
        Request $request
    ): Response
    {
        $userChosenLanguage = $session->get('userChosenLanguage');

        if (!$userChosenLanguage || $userChosenLanguage !== $targetLanguage) {
            $session->set('userChosenLanguage', $targetLanguage);
        }

        return $this->redirect($request->server->get('HTTP_REFERER', '/'));
    }
}