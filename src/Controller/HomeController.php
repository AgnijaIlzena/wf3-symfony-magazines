<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MagazineRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Magazine;
use App\Form\MagazineFormType;
use DateTimeImmutable;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(MagazineRepository $magazineRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'magazines' => $magazineRepository->findAll(),
        ]);
    }

    #[Route('/magazine/{id}', name: 'app_magazine', requirements: ['id' => '\d+'])]
    public function showOne(int $id, MagazineRepository $magazineRepository): Response
    {
       
        return $this->render('home/magazine.html.twig', [
            'magazine' => $magazineRepository->find($id)
           
        ]);
    }

    #[Route('/magazine/new', name: 'app_magazine_new')]
    public function newMagazine(Request $request, MagazineRepository $magazineRepository): Response
    {
        $magazine = new Magazine();
        $form = $this->createForm(MagazineFormType::class, $magazine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $magazine->setCreatedAt(new DateTimeImmutable());  // we do not insert date in form but via here
            // dump($author);
            $magazineRepository->add($magazine, true);  // this ads into bd (comes from repository where is persist and flash in add method)
           // $this->addFlash('success', 'Votre categorie à bien été enregistré !');
            return $this->redirectToRoute('app_home', [
                $this->addFlash('success', 'Votre magazine à bien été enregistré !')
            ], Response::HTTP_SEE_OTHER);
         }


        return $this->render('home/newMagazine.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
