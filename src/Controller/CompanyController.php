<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    /**
     * @Route("/", name="company_index")
     */
    public function index(): Response
    {
        return $this->render('company/index.html.twig');
    }

     /**
     * @Route("/create", name="company_create")
     */
    public function create(): Response
    {
        return $this->render('company/index.html.twig');
    }
}
