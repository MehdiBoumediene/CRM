<?php

namespace App\Form\filtres;
use App\Entity\Classes;
use App\Entity\Etudiants;
use App\Entity\Intervenants;
use App\Entity\Modules;
use App\Entity\Blocs;
use App\Entity\Notes;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\DataTransformer\ClassesToNumbersTransformer;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class FiltreAbsencesType extends AbstractType
{
    private $em;

    private $tokenStorage;
    public function __construct(TokenStorageInterface   $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
    
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if(in_array('ROLE_INTERVENANT', $this->tokenStorage->getToken()->getUser()->getRoles())){
            $builder
            ->add('search', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Mot clé ou n° de…'
                ),
                'label' => false ,
                'required' => false
            ])
    
    
          
            ->add('classe', EntityType::class, [
                'class' => Classes::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')

                    ->innerJoin('u.modules', 'm')

                    ->andWhere('m.classes = :user')

                    ->setParameter('user',$this->tokenStorage->getToken()->getUser()->getClasse())
                        ->orderBy('u.nom', 'ASC');
                },
                'expanded' => false,
                'multiple' => false,
                'choice_label' => 'nom',
                'empty_data'=>'',
                'required' => true,
                'label'=>false,
                'placeholder'=>'',
         
            ])
    
    
            ;
        }else{
            $builder
            ->add('search', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Mot clé ou n° de…'
                ),
                'label' => false ,
                'required' => false
            ])
    
    
            ->add('classe', EntityType::class, [
                'class' => Classes::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'label'=>false,
                'empty_data'=>'',
                'multiple' => false,
                'required' => false
            ])
    
    
    
            ;
        }
      

   

   
        
    }


}