<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\Tag;
use App\Entity\User;
use App\Form\Type\TagsInputType;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Security\Core\Security;

class PostType extends AbstractType
{
    private $entityManager;
    private $context;

    public function __construct(EntityManagerInterface $entityManager, Security $context)
    {
        $this->entityManager = $entityManager;
        $this->context = $context;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'attr' => [
                    'autofocus' => true,
                    'class' => 'form-control',
                ],
            ])
            ->add('body', TextareaType::class, [
                'attr' => [
                    'rows' => 10,
                    'class' => 'form-control',
                ],
            ])
            //->add('tags', EntityType::class, [
            ->add('tags', null, [
                //'class' => Tag::class,
                'attr' => [
                    'class' => 'form-control select2',
                    'multiple' => 'multiple',
                ],
                'choice_label' => 'name',
                'multiple' => true,
                'query_builder' => function (TagRepository $er) {
                    return $er->createQueryBuilder('u')
                            ->orderBy('u.name', 'ASC');
                }
            ])

            ->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'))

        ;

    }

    public function onPreSubmit(FormEvent $event)
    {
        $userData = $event->getData();
        $formData = $event->getForm();

        $tagsPost = !empty($userData['tags']) ? array_values($userData['tags']) : [];
        $tags = [];
        $tagsNew = [];

        // search for tags in DB, if is new create it
        foreach ($tagsPost as $tagId) {
            $tag = $this->entityManager->getRepository(Tag::class)->findOneBy(['id' => $tagId]);
            if (null === $tag || count($tag) == 0) {
                $tag = new Tag();
                $tag->setName($tagId);
                // if user is 'anon.' (from API) then use 'test' user
                $user = $this->context->getToken()->getUser() == 'anon.'
                    ? $this->entityManager->getRepository(User::class)->findOneBy(['username' => 'test'])
                    : $this->context->getToken()->getUser();
                $tag->setUser($user);
                $this->entityManager->persist($tag);
                // force to flush if not id is null
                $this->entityManager->flush();
                $tagsNew[] = $tag;
            }
            $tags[] = $tag->getId();
        }

        if (!empty($tagsNew)) {
            unset($userData['tags']);
            $userData['tags'] = $tags;
            $event->setData($userData);
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class
        ]);
    }
}
