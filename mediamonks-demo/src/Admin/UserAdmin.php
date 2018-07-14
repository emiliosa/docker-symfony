<?php

namespace App\Admin;

use App\Form\Type\TagsInputType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('username', TextType::class)
            ->add('email', TextType::class)
            ->add('password', TextType::class)
            ->add('googleId', TextType::class)
            ->add('active', BooleanType::class)
            ->add('roles', EntityType::class, [
                'choices' => [
                    'ROLE_ADMIN',
                    'ROLE_USER'
                ],
                'multiple' => true,
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        /*$datagridMapper
            ->add('title')
            ->add('user');*/
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('firstName')
            ->addIdentifier('lastName')
            ->addIdentifier('username')
            ->addIdentifier('email')
            ->addIdentifier('active')
            ->addIdentifier('roles')
            ->addIdentifier('createdAt')
            ->addIdentifier('updatedAt')
            ->addIdentifier('deletedAt');
    }

    public function toString($object)
    {
        return $object->getContent();
    }
}
