<?php
namespace App\Form;
use App\Entity\Inscripcion;
use App\Entity\Modalidad;
use App\Entity\Plataforma;
use App\Entity\Torneo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class Torneo2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ganador', EntityType::class,
                ['class' => Torneo::class,
                    'choice_label' => 'inscripcions',
                    'placeholder' => 'Seleciona el ganador',
                    'required' => true,
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Torneo::class,
        ]);
    }
}