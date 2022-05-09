<?php

namespace App\Controller;

use App\Entity\Mensaje;
use App\Entity\Usuario;
use App\Form\UsuarioNormalEdit;
use App\Form\UsuarioType;
use App\Form\UsuarioTypeEdit;
use App\Repository\InscripcionRepository;
use App\Repository\MensajeRepository;
use App\Repository\TorneoRepository;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('urlError');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/denegado", name="denegado")
     */
    public function denegado(): Response
    {
        return $this->render('errors/acces-error.html.twig', []);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/perfil", name="perfil" , methods={"GET"})
     */

    public function perfil(MensajeRepository $mensajeRepository, TorneoRepository $torneoRepository, InscripcionRepository $inscripcionRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $usuario = $this->getUser();
        $mensajesEnviados = $mensajeRepository->findBy(['enviado'=>$this->getUser()]);
        $mensajesRecibidos = $mensajeRepository->findBy(['recibidos'=>$this->getUser()]);
        $torneos = $torneoRepository->findBy(['usuario'=>$usuario]);
        $pagination = $torneoRepository->getAllPaginatedTusTorneos($request, $paginator);
        $inscripcionesUsuario = $inscripcionRepository->findBy(['usuario'=>$usuario]);
        $inscripciones = $paginator->paginate($inscripcionesUsuario, $request->query->getInt('page',1),4);
        return $this->render('security/profile.html.twig',[
            'pagination' => $pagination,
            'usuario' => $usuario,
            'torneos' => $torneos,
            'inscripciones' => $inscripciones,
            'mensajes' => $mensajesEnviados,
            'mensajes2' => $mensajesRecibidos,
        ]);
    }

    /**
     * @Route("/user/{id}/edit", name="usuario_normal_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Usuario $usuario, EntityManagerInterface $entityManager,  UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $usuario = $this->getUser();
        if($usuario === $this->getUser()){
            $form = $this->createForm(UsuarioNormalEdit::class, $usuario);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $user = $form->getData();

                $user->setContrasenya(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('contrasenya')->getData()
                    )
                );
                $entityManager->flush();
                $this->addFlash(
                    'success',
                    'Usuario editado correctamente!'
                );
                return $this->redirectToRoute('perfil', [], Response::HTTP_SEE_OTHER);
            }
            return $this->renderForm('usuario/edit.html.twig', [
                'usuario' => $usuario,
                'form' => $form,
            ]);
        }

         return $this->redirectToRoute('errors/acces-error.html.twig', [], Response::HTTP_SEE_OTHER);
    }
}
