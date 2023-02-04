<?php

namespace App\Form;

use App\Entity\Exam;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ParamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nazwa'
            ])
            ->add('value', MoneyType::class, [
                'currency' => '',
                'label' => 'Kwota'
            ])
            ->add('exam', EntityType::class, [
                'class' => Exam::class,
                'label' => 'Badanie'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Dodaj'
            ]);
    }
}