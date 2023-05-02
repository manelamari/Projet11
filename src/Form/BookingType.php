<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\GreaterThan;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
         //   ->add('dateDebut',DateType::class,[
             //  'widget'=>'single_text',
             //   'format'=>'yyyy-MM-dd',


           // ])
          //  ->add('dateFin',DateType::class,[
              //  'widget'=>'single_text',
              //  'format'=>'yyyy-MM-dd',
              //  'constraints' => [

               //     new GreaterThan([
                       // 'propertyPath' => 'parent.all[dateDebut].data'
                   // ])
                //   ]
            //])
             // ->add('prixtotale')
         // ->add('voiture')
         //  ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
