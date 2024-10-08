<?php

namespace App\Form;

use App\Entity\Atividade;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AtividadeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class, [
                'label' => 'Nome',
            ])
            ->add('descricao', TextType::class, [
                'label' => 'Descrição',
            ])
            ->add('destino', TextType::class, [
                'label' => 'Destino',
            ])
            ->add('categoria', TextType::class, [
                'label' => 'Categoria',
            ])
            ->add('custo_estimado', NumberType::class, [
                'label' => 'Custo Estimado',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Salvar',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Atividade::class,
        ]);
    }
}
