<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AylinController extends AbstractController
{
    #[Route('/aylin', name: 'app_aylin', )]
    public function index(): Response
    {
        $arr=['asdasd', 'asdasd', 'asdas'];
        return $this->render('index.html.twig', [
            'title'=>"Avengers", 'arr'=>$arr
        ]);
    }

    #[Route('/aylin/{name}', name: 'app_aylin_name', defaults: ['name' => null], methods:  ['GET', 'HEAD'])]
    public function aylin($name): Response
    {
        return $this->json([
            'message' => $name,
            'path' => 'src/Controller/AylinController.php',
        ]);
    }
}
