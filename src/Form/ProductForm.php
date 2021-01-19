<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
  
use App\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
class ProductForm extends AbstractType
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
            ->add('mark', TextType::class, ['label'=>'Marca',
                'required' => true,
                'attr' => array('placeholder'=>'','class'=>'form-control')
            ])     
            ->add('price', NumberType::class, ['label'=>'Precio',
                'required' => true,
                'attr' => array('placeholder'=>'','class'=>'form-control')
            ])
            ->add('category', EntityType::class, array('label'=>'Categoria',
            'attr'=>array('class'=>'form-control'),
            'class' => Category::class,'choice_label' => 'name',
            'query_builder' => function (\App\Repository\CategoryRepository $repository)
            {
                return $repository->createQueryBuilder('c')->where('c.active=1');
            }              
            ))

            ->add('save', SubmitType::class,['label'=>'Guardar','attr'=>array('class'=>'btn btn-success')])
        ;
    }
}