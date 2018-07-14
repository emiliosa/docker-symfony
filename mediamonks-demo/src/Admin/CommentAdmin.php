<?php

namespace App\Admin;

use App\Form\Type\TagsInputType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Route\RouteCollection;

class CommentAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('content', TextType::class);
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
            ->addIdentifier('post.title')
            ->addIdentifier('content')
            ->addIdentifier('user.username', null, ['label' => 'Username'])
            ->addIdentifier('createdAt')
            ->addIdentifier('updatedAt')
            ->addIdentifier('deletedAt');
    }

    protected function configureRoutes(RouteCollection $collection): void
    {
        /* Removing the edit route will disable editing entities. It will also
         * use the 'show' view as default link on the identifier columns in the list view.
         */
        $collection->remove('edit');
        
        /* Removing the create route will disable creating new entities. It will also
         * remove the 'Add new' button in the list view.
         */
        $collection->remove('create');
    }

    public function toString($object)
    {
        return $object->getContent();
    }
}
