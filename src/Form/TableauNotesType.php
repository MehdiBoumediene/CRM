<?php

namespace App\Form;
use App\Entity\Etudiants;
use App\Entity\TableauNotes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TableauNotesType extends AbstractType
{
    public function getParent()
    {
        return TextType::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            ->add('note1', IntegerType::class,[
                'label'=>false,
                'required'=>false,
     
            ])
            ->add('note2', IntegerType::class,[
                'label'=>false,
   
                'required'=>false
            ])
            ->add('note3', IntegerType::class,[
                'label'=>false,
   
                'required'=>false
            ])
            ->add('observation1', TextType::class,[
                'label'=>false,
                
                'required'=>false
            ])
            ->add('observation2', TextType::class,[
                'label'=>false,
                'required'=>false
            ])
            ->add('observation3', TextType::class,[
                'label'=>false,
                'required'=>false
            ])
          
            ->add('etudiant', EntityType::class, [
                'class' => Etudiants::class,
          
                'choice_label' => function($apprenant, $key, $index) {
                    /** @var Apprenants $apprenant */
                    return $apprenant->getNom() . ' ' . $apprenant->getPrenom();
                },
                'required'=>true,
                'expanded'=>false,
                'multiple' => true,
         
                'label'=>false,
                'data_class' => null,
                
         
            ])
            ->add('copie',FileType::class,[
                'label'=> false,
                'data_class' => null,
                'multiple' => true,
                'mapped'=> false,
                'required'=> false,
        
              

            ])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TableauNotes::class,
            'compound' => true,
        ]);
    }
}
