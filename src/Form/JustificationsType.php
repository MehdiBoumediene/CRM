<?php

namespace App\Form;

use App\Entity\Justifications;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JustificationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('message')
            ->add('files',FileType::class,[
                'label'=> false,
                'multiple' => true,
                'mapped'=> false,
                'required'=> false,
              
        
            
            ])
            ->add('tableau')
     
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Justifications::class,
        ]);
    }
}
