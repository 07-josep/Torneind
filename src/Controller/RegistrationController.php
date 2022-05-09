<?php
// src/Controller/RegistrationController.php
namespace App\Controller;

use App\Form\UserType;
use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="registration")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('urlError');
        }
        // 1) build the form
        $user = new Usuario();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setContrasenya(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('contrasenya')->getData()
                )
            );
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $user->setRole("ROLE_USER");
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('login');
        }
        return $this->render(
            'security/register.html.twig',
            array('form' => $form->createView())
        );
    }
}