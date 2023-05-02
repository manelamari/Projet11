<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\GreaterThan;

class SearchVoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           /* ->add('category',EntityType::class,[
                'class'=>Category::class,
                'label'=>false,
                'required'=>false,
                'multiple'=>true,
                'attr'=>[
                    'class'=>'js-categories-multiple']
            ])*/
            ->add('datedebut',DateType::class,[
               'widget'=>'single_text',

               'constraints' => [
                   new Date(),
                   ]

            ])
            ->add('datefin',DateType::class,[
                'widget'=>'single_text',
                'constraints' => [
                    new Date(),
                    new GreaterThan([
                        'propertyPath' => 'parent.all[dateDebut].data'
                    ])
                ]
            ])


            //->add('modele')
            //->add('carburant')
           // ->add('boiteVitesse')
          //  ->add('nombreDePlace')
          //  ->add('disponibility')
            //->add('prix')
           // ->add('image')
           // ->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
