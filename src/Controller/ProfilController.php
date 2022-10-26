<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Profil;
use App\Form\ProfilType;
use App\Repository\UsersRepository;
use App\Repository\ProfilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
   /**
     * @Route("/profil", name="app_profil", methods={"GET", "POST"})
     */
    public function index(ProfilRepository $profilRepository,Request $request ,UsersRepository $usersRepository,EntityManagerInterface $entityManager): Response
    {

        $profil = new Profil();
        $idUser = $this->getUser();
     
       // $users = $usersRepository -> findById($idUser);
       
            
         $user = $usersRepository->findOneBy(['id'=>$idUser]);
         $nom = $user->getNom();
         $prenom = $user->getPrenom();
     


         $form = $this->createForm(ProfilType::class, $profil);
         $form->handleRequest($request);
 
         if ($form->isSubmitted() && $form->isValid()) {
           
           
            $profil->setNom($form->get('nom')->getData());
            $profil->setPrenom($form->get('prenom')->getData());
            $profil ->setImage($form->get('image')->getData());
            //  $profil ->setUser($idUser);

            $user->setNom($form->get('nom')->getData());
            $user->setPrenom($form->get('prenom')->getData());

            $images=$profil ->setImage($form->get('image')->getData());

              $img=  $form->get('image')->getData();
              
              
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()).'.'.$img->guessExtension();
                
                // On copie le fichier dans le dossier uploads
                $img->move(
                    $this->getParameter('videos_directory'),
                    $fichier
                );
            
          
            $profil ->setImage($fichier);
      

            $entityManager->persist($profil);
            $entityManager->flush();
            return $this->redirectToRoute('app_profil', ['profil' => $profil,], Response::HTTP_SEE_OTHER);  
        
        }

       
        
        return $this->renderForm('profil/index.html.twig', [
            'nom' => $nom,
            'prenom' => $prenom,
            'form' => $form,
            'profil' => $profil,
     
        ]);
    }
}
