<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArticleCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('contenu')
            ->add('image', ChoiceType::class, [
                'choices'  => [
                    'aperitif-1' => 'aperitif-1',
                    'aperitif-2' => 'aperitif-2',
                    'bruschetta-b' => 'bruschetta-b',
                    'bruschetta' => 'bruschetta',
                    'burger' => 'burger',
                    'cake' => 'cake',
                    'cookies' => 'cookies',
                    'cupcakes' => 'cupcakes',
                    'gnocchis' => 'gnocchis',
                    'pasta' => 'pasta',
                    'pizza' => 'pizza',
                    'rice' => 'rice',
                    'salad' => 'salad',
                    'sushis' => 'sushis',
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
