<?php
namespace App\Form;
use App\Entity\Modalidad;
use App\Entity\Plataforma;
use App\Entity\Usuario;
use Doctrine\DBAL\Types\DateType;
use Doctrine\ORM\Query\Expr\Select;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints\Length;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UsuarioTypeEdit extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('correo', EmailType::class)
            ->add('nombre', TextType::class)
            ->add('contrasenya', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Repite la contraseña'),
            ))
            ->add('imagenFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_label' => 'Descargar la foto.',
                'imagine_pattern' => 'my_thumb',
            ])
            ->add('role', ChoiceType::class, [
                'choices' => [
                    'ELEGIR ROL' => [
                        'ADMINISTRADOR' => 'ROLE_ADMIN',
                        'USUARIO' => 'ROLE_USER',
                    ],
            ]    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
