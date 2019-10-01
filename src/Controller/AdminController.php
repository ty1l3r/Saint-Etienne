<?php

namespace App\Controller;

use App\Repository\DatasRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/actualites", name="admin_actualites_index")
     */
    public function index(DatasRepository $repo)
    {
        return $this->render('admin/index.html.twig', [
            'ads' => $repo->findAll()
        ]);
    }

    /**
     * @Route("/admin/actualites/liste-complete", name="admin_actualites_liste")
     */
    public function annoncesList(DatasRepository $repo)
    {
        return $this->render('admin/listeComplete.html.twig', [
            'ads' => $repo->findAll()
        ]);
    }
}
