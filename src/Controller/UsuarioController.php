<?php

namespace App\Controller;

use App\Entity\Mensaje;
use App\Entity\Torneo;
use App\Entity\Usuario;
use App\Form\UserType;
use App\Form\UsuarioType;
use App\Form\UsuarioTypeEdit;
use App\Repository\InscripcionRepository;
use App\Repository\TorneoRepository;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/usuario")
 */
class UsuarioController extends AbstractController
{
    /**
     * @Route("/index", name="usuario_index", methods={"GET"})
     */
    public function index(UsuarioRepository $usuarioRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $tipo = $request->query->get("role");
        $messageRole = "Filtro $tipo activado. ";

        if (empty($tipo)) {
            $pagination = $usuarioRepository->getAllPaginated($request, $paginator);
        } else {
            $this->addFlash(
                'info',
                $messageRole
            );
            $pagination = $usuarioRepository->getAllPaginatedByRole($request, $paginator, $tipo);
        }
        return $this->render('usuario/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/admin/new", name="usuario_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($usuario);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Usuario creado correctamente!'
            );

            return $this->redirectToRoute('usuario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('usuario/new.html.twig', [
            'usuario' => $usuario,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/usuario/{id}", name="usuario_show", methods={"GET"})
     */
    public function show(TorneoRepository $torneoRepository, PaginatorInterface $paginator, Request $request, $id, UsuarioRepository $usuarioRepository): Response
    {
        $usuario = $usuarioRepository->find($id);
        $torneos = $torneoRepository->findBy(['usuario'=>$usuario]);
        $pagination = $torneoRepository->getAllPaginatedTusTorneos($request, $paginator);


        if ($id == $this->getUser()){
            return $this->redirectToRoute('perfil', [], Response::HTTP_SEE_OTHER);
        } else

        return $this->render('usuario/show.html.twig',[
            'pagination' => $pagination,
            'usuario' => $usuario,
            'torneos' => $torneos,
        ]);
    }


    /**
     * @Route("/admin/{id}/edit", name="usuario_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Usuario $usuario, EntityManagerInterface $entityManager,  UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $form = $this->createForm(UsuarioTypeEdit::class, $usuario);
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
                '¡ Usuario editado correctamente !'
            );
            return $this->redirectToRoute('usuario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('usuario/edit.html.twig', [
            'usuario' => $usuario,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/{id}/delete", name="usuario_delete", methods={"POST"})
     */
    public function delete(Request $request, Usuario $usuario, EntityManagerInterface $entityManager, InscripcionRepository $inscripcionRepository): Response
    {

        $var1 = $inscripcionRepository->findBy(['usuario' => $usuario->getId()]);
        if ($var1){
            $this->addFlash(
                'danger',
                'No se puede eliminar un usuario que tenga inscripciones activas.'
            );
            return $this->redirectToRoute('usuario_index', [], Response::HTTP_SEE_OTHER);
        }
        else{
            if ($this->isCsrfTokenValid('delete'.$usuario->getId(), $request->request->get('_token'))) {
                $entityManager->remove($usuario);
                $entityManager->flush();
                $this->addFlash(
                    'success',
                    '¡ Usuario eliminado correctamente !'
                );
            }
            return $this->redirectToRoute('usuario_index', [], Response::HTTP_SEE_OTHER);
        }
    }
}
