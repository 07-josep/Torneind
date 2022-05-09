<?php

namespace App\Form;

use App\Entity\Modalidad;
use App\Entity\Plataforma;
use App\Entity\Torneo;
use App\Entity\Usuario;
use Doctrine\DBAL\Types\DateType;
use Doctrine\ORM\Query\Expr\Select;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints\Length;

class Torneo1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'required' => true,
            ])
            ->add('descripcion', TextareaType::class, [
                'required' => true,
            ])
            ->add('modalidad', EntityType::class,
                ['class' => Modalidad::class,
                    'choice_label' => 'modalidad',
                    'placeholder' => 'Seleciona la modalidad',
                    'required' => true,
                ])
            ->add('plataforma', EntityType::class,
                ['class' => Plataforma::class,
                    'choice_label' => 'plataforma',
                    'placeholder' => 'Seleciona la plataforma',
                    'required' => true,
                ])
            ->add('fecha', DateTimeType::class, [
                'required' => true,
            ])
            ->add('imagenFile', VichImageType::class, [
                'required' => false,
                'download_label' => 'Descargar la foto.',
                'imagine_pattern' => 'my_thumb',
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Torneo::class,
        ]);
    }
}
