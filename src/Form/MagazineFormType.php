<?php

namespace App\Form;

use App\Entity\Magazine;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;



class MagazineFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'label' => 'Nom de la magazine',
            'required' => false
        ])
        ->add('price', NumberType::class, [
            'label' => 'Prix',
            'required' => false
        ] )           
        ->add('category', EntityType::class, [
            'class' => Category::class,
            'choice_label' => 'name' // which atribute from category object I want to show here
        ])
        ->add('enregister', SubmitType::class)    
    ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Magazine::class,
        ]);
    }
}
