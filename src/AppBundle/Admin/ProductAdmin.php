<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Category;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductAdmin extends BaseAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Product', ['class'=>'col-md-4'])
                ->add('name', TextType::class)
                ->add('sku', TextType::class)
                ->add('price', NumberType::class)
                ->add('quantity', NumberType::class)
            ->end()
            ->with('Related categories', ['class' => 'col-md-4'])
                ->add('categories', EntityType::class, [
                    'required' => false,
                    'class' => Category::class,
                    'multiple' => true
                ])
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('price')
            ->add('quantity')
            ->add('categories')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('sku')
            ->addIdentifier('name')
            ->add('price')
            ->add('quantity')
            ->add('categories')
        ;
    }
}
