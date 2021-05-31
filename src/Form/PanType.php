<?php

namespace App\Form;

use App\Entity\Pan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichImageType::class, [
            'label' => 'Choisissez votre image (JPG ou PNG uniquement)',
            'required' => false,
            'allow_delete' => true,
            'delete_label' => 'Supprimer l\'image',
            'download_uri' => false,
            'imagine_pattern' => 'squared_thumbnail_medium',
            // 'image_uri' => true,
            // 'download_label' => '...',
            // 'asset_helper' => true,
            ])
            ->add('title')
            ->add('description')
            // ->add('createdAt')
            // ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pan::class,
        ]);
    }
}
