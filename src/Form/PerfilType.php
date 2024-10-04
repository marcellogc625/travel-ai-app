<?php

namespace App\Form;

use App\Entity\Perfil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PerfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_usuario')
            ->add('interesse_aventura')
            ->add('interesse_cultura')
            ->add('interesse_gastronomia')
            ->add('orcamento_diario')
            ->add('duracao_viagem')
            ->add('outros_interesses')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Perfil::class,
        ]);
    }
}
