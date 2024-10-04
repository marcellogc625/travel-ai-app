<?php

namespace App\Form;

use App\Entity\Roteiro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoteiroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_usuario')
            ->add('id_destino')
            ->add('data_criacao', null, [
                'widget' => 'single_text',
            ])
            ->add('descricao')
            ->add('dias')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Roteiro::class,
        ]);
    }
}
