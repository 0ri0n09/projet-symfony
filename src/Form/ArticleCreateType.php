<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArticleCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('contenu', TextareaType::class, [
                'attr' => array('style' => 'height: 300px')
            ])
            ->add('image', ChoiceType::class, [
                'choices'  => [
                    'aperitif-1' => 'imgs/aperitif-1.jpg',
                    'aperitif-2' => 'imgs/aperitif-2.jpg',
                    'bruschetta-b' => 'imgs/bruschetta-b.jpg',
                    'bruschetta' => 'imgs/bruschetta.jpg',
                    'burger' => 'imgs/burger.jpg',
                    'cake' => 'imgs/cake.jpg',
                    'cookies' => 'imgs/cookies.jpg',
                    'cupcakes' => 'imgs/cupcakes.jpg',
                    'gnocchis' => 'imgs/gnocchis.jpg',
                    'pasta' => 'imgs/pasta.jpg',
                    'pizza' => 'imgs/pizza.jpg',
                    'rice' => 'imgs/rice.jpg',
                    'salad' => 'imgs/salad.jpg',
                    'sushis' => 'imgs/sushis.jpg',
                ],
            ])
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'entree' => 'entree',
                    'plat' => 'plat',
                    'dessert' => 'dessert',
                    'aperitif' => 'aperitif',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
