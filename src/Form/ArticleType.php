<?php

namespace App\Form;

use App\Entity\Article;
use App\Form\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('quantity')
            ->add('unit')
            ->add('created_at')
            ->add('Category')
            /* ->add('category',EntityType::class, array(
                'class' => 'App:Category',
                'choice_label' => 'name',
                'label' => 'Categorie :')) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
