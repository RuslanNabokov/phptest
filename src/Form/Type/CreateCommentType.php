<?php


namespace App\Form\Type;


use App\Entity\Conference;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;


class CreateCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('conference', IntegerType::class, array([
                'class' => Conference::class,
                'choice_label' => 'city',
            ]))
            ->add('author', TextType::class)
            ->add('text', TextType::class)
            ->add('email', TextType::class)
            ->add('created_at', DateTimeType::class)
            ->add('submit', SubmitType::class)
        ;
    }
}