<?php

namespace App\Form;

use App\Entity\LinePurchase;
use App\Entity\Purchase;
use App\Entity\Article;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinePurchaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('purchase', EntityType::class, [
                'class' => Purchase::class,
                'multiple' => false
            ])
            ->add('article', EntityType::class, [
                'class' => Article::class,
                'multiple' => false
            ])
            ->add('quantity')
            ->add('unit_price')
            ->add('tax')
            // ->add('article')
            // ->add('purchase')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LinePurchase::class,
        ]);
    }
}
