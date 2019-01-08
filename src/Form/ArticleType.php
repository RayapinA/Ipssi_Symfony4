<?php

namespace App\Form;

use App\Entity\FirstArticle;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('imageUrl')
            ->add('content')
            ->add('createdAt',DateTimeType::class)
            ->add('published')
            ->add('user',EntityType::class,[
                'class' => User::class,
                'choice_label' => 'firstname',
            ])
            ->add('submit',SubmitType::class) // Add a submit button 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FirstArticle::class,
        ]);
    }
}
