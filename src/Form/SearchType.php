<?php

namespace App\Form;

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
class SearchType extends AbstractType
{
    private $em;

    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
        ->add('search', TextType::class, [
            'attr' => array(
                'placeholder' => 'Ecrire un mot ou n°'
            ),
            'label' => false 
        ])
      
      

        ;

   

   
        
    }


}