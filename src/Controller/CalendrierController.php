<?php

namespace App\Controller;

use App\Entity\Calendrier;
use App\Form\CalendrierType;
use App\Repository\CalendrierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/calendrier")
 */
class CalendrierController extends AbstractController
{
    /**
     * @Route("/", name="app_calendrier_index", methods={"GET"})
     */
    public function index(CalendrierRepository $calendrierRepository): Response
    {
        return $this->render('calendrier/index.html.twig', [
            'calendriers' => $calendrierRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_calendrier_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CalendrierRepository $calendrierRepository): Response
    {
        $calendrier = new Calendrier();
        $form = $this->createForm(CalendrierType::class, $calendrier);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $start = $form->get('start')->getData();
            $end = $form->get('end')->getData();
            $classe = $form->get('classe')->getData();
            $intervenant = $form->get('intervenant')->getData();
            
            $calend = $calendrierRepository->horaires($start,$end,$classe,$intervenant);
            

            
            if($calend){

                $this->addFlash('success', "un évenement existe deja avec cette date et heur Veuillez changer d'horaire");
                return $this->redirectToRoute('app_calendrier_new', [], Response::HTTP_SEE_OTHER);

            }else{

                $calendrierRepository->add($calendrier);
                return $this->redirectToRoute('app_gestion_calendrier', [], Response::HTTP_SEE_OTHER);
            }

           
        }

        return $this->renderForm('calendrier/new.html.twig', [
            'calendrier' => $calendrier,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_calendrier_show", methods={"GET"})
     */
    public function show(Calendrier $calendrier): Response
    {
        return $this->render('calendrier/show.html.twig', [
            'calendrier' => $calendrier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_calendrier_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Calendrier $calendrier, CalendrierRepository $calendrierRepository): Response
    {
        $form = $this->createForm(CalendrierType::class, $calendrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calendrierRepository->add($calendrier);
            return $this->redirectToRoute('app_gestion_calendrier', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('calendrier/edit.html.twig', [
            'calendrier' => $calendrier,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_calendrier_delete", methods={"POST"})
     */
    public function delete(Request $request, Calendrier $calendrier, CalendrierRepository $calendrierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calendrier->getId(), $request->request->get('_token'))) {
            $calendrierRepository->remove($calendrier);
        }

        return $this->redirectToRoute('app_calendrier_index', [], Response::HTTP_SEE_OTHER);
    }
}
