<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller\Admin
 *
 * @Route("/dashboard", name="ADMIN_")
 **/
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="DASHBOARD")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }
}
