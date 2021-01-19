<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class CategoryForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, ['label'=>'Código',
                'required' => true,
                'attr' => array('placeholder'=>'','class'=>'form-control')
            ])
            ->add('name', TextType::class, ['label'=>'Nombre',
                'required' => true,
                'attr' => array('placeholder'=>'','class'=>'form-control')
            ])
            ->add('description', TextType::class, ['label'=>'Descripción',
                'required' => true,
                'attr' => array('placeholder'=>'','class'=>'form-control')
            ])  
            ->add('description', TextType::class, ['label'=>'Descripción',
                'required' => true,
                'attr' => array('placeholder'=>'','class'=>'form-control')
            ])     
            ->add('active', ChoiceType::class, array('label'=>'Activo',
                'choices'  => array(
                    'SI' => true,
                    'NO' => false,
                ),'attr'=>array('class'=>' form-control')
            ))

            ->add('save', SubmitType::class,['label'=>'Guardar','attr'=>array('class'=>'btn btn-success')])
        ;
    }
}