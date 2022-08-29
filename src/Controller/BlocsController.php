<?php

namespace App\Controller;

use App\Entity\Blocs;
use App\Entity\Classes;
use App\Form\BlocsType;
use App\Form\SearchType;
use App\Form\FiltreBlocType;
use App\Repository\BlocsRepository;
use App\Repository\ModulesRepository;
use App\Repository\ClassesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/blocs")
 */
class BlocsController extends AbstractController
{
    /**
     * @Route("/", name="app_blocs_index", methods={"GET", "POST"})
     */
    public function index(Request $request, BlocsRepository $blocsRepository): Response
    {
  

        $form2 = $this->createForm(FiltreBlocType::class);
        $form2->handleRequest($request);

    

        if ($form2->isSubmitted() && $form2->isValid()) {
            $value = $form2->get('search')->getData();
        $filtre = $form2->get('classe')->getData();
        
            if($filtre == null){
                $filtre = empty($filtre);
            }
            if($value == null){
                $value = empty($value);
            }
       
        $blocs =  $blocsRepository->searchMot($value,$filtre);
            return $this->renderForm('blocs/index.html.twig', [
                'blocs' => $blocs,
         
                'form2' => $form2,
            ]);
        }
        $blocs =  $blocsRepository->findAll();
        return $this->renderForm('blocs/index.html.twig', [
            'blocs' => $blocs,
            'form2' => $form2,
        ]);
    }

    /**
     * @Route("/new", name="app_blocs_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BlocsRepository $blocsRepository): Response
    {
        $bloc = new Blocs();
        $form = $this->createForm(BlocsType::class, $bloc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTimeImmutable('now');
         
            $bloc->setCreatedBy($this->getUser()->getEmail());
            $bloc->setUser($this->getUser());
            $bloc->setCreatedAt($date);
            $blocsRepository->add($bloc);
            return $this->redirectToRoute('app_blocs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('blocs/new.html.twig', [
            'bloc' => $bloc,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_blocs_show", methods={"GET"})
     */
    public function show(Blocs $bloc,ModulesRepository $modulesRepository,BlocsRepository $blocsRepository): Response
    {
        return $this->render('blocs/show.html.twig', [
            'bloc' => $bloc,
            'modules' => $modulesRepository->findBy(array('bloc'=>$bloc)),
        
    
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_blocs_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Blocs $bloc, BlocsRepository $blocsRepository): Response
    {
        $form = $this->createForm(BlocsType::class, $bloc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blocsRepository->add($bloc);
            return $this->redirectToRoute('app_blocs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('blocs/edit.html.twig', [
            'bloc' => $bloc,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_blocs_delete", methods={"POST"})
     */
    public function delete(Request $request, Blocs $bloc, BlocsRepository $blocsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bloc->getId(), $request->request->get('_token'))) {
            $blocsRepository->remove($bloc);
        }

        return $this->redirectToRoute('app_blocs_index', [], Response::HTTP_SEE_OTHER);
    }
}
