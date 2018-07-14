<?php

namespace App\Form\Api;

use App\Entity\Post;
use App\Form\PostType AS BasePostType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends BasePostType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
            'csrf_protection' => false,
        ]);
    }
}
