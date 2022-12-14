<?php

namespace App\Form;

use App\Entity\Messages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Doctrine\ORM\EntityRepository;
use App\Entity\Users;
use Container3Cf44cE\getFosCkEditor_Form_TypeService;

class MessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('objet',TextType::class,[
                'attr'=> [
                    'class'=>'form-control'
                ],
                'label'=>false,
                ])

            ->add('message',TextareaType::class, [
                
                'required'=>false,
                ])
    
            ->add('recipient', EntityType::class, [
                'class' => Users::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.email', 'ASC');
                },
                'choice_label' => function($user, $key, $index) {
                    /** @var Users $user */
                    return  $user->getPrenom() . ' ' . $user->getNom();
                },
                'label'=>false,
                'multiple' => true,
                'required' => false
            ])
    

            ->add('users', EntityType::class, [
                'class' => Users::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.email', 'ASC');
                },
                'choice_label' => function($user, $key, $index) {
                    /** @var Users $user */
                    return  $user->getPrenom() . ' ' . $user->getNom();
                },
                'label'=>false,
                'multiple' => true,
                'required' => false
            ])

            ->add('files',FileType::class,[
                'label'=> false,
                'multiple' => true,
                'mapped'=> false,
                'required'=> false,
              
        
            
            ])


            ->add('brouillon',TextType::class,[
                'attr'=> [
                    'class'=>'form-control'
                ],
                'label'=>false,
                ])

          
        ;
    }


}
