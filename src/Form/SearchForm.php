<?php

namespace App\Form;

use App\Data\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\GreaterThan;




class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('debut',DateType::class,[

              'widget'=>'single_text',
               'input'=>'datetime',
               // 'constraints'=>
               // new greaterThan(['now',
                   // 'message' => 'il faut que la date début ....',])

                //'format' => 'dd-MM-yyyy',
               // 'data_class'=>null,
              //  'empty_data' => '',




            ])
        ->add('fin',DateType::class,[
            'widget'=>'single_text',
            //'html5'=>false,
            'input'=>'datetime',
           // 'constraints'=>
            //    new greaterThan([
             //       'propertyPath' => 'parent.all[debut].data',
             //       'message' => 'il faut que la date fin soit supperieure de ladatr debut ....',])
            //'input_format'=>'dd-MM-yyyy',





    ])
        ->add('rechercher',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
      {
          $resolver->setDefaults([
              'data_class'=>SearchData::class,
              'method'=>'GET',
              'csrf_protection'=>false
          ]);
      }

      public function getBlockPrefix()
      {
          return '';
      }
}