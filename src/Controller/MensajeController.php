<?php

namespace App\Controller;

use App\Entity\Mensaje;
use App\Entity\Usuario;
use App\Form\MensajeType;
use App\Repository\MensajeRepository;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mensaje")
 */
class MensajeController extends AbstractController
{
    /**
     * @Route("/", name="mensaje_index", methods={"GET"})
     */
    public function index(MensajeRepository $mensajeRepository): Response
    {
        return $this->render('mensaje/index.html.twig', [
            'mensajes' => $mensajeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="mensaje_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,  Usuario $usuarioReceptor): Response
    {


        $usuarioEmisor = $this->getUser();
        $mensaje = new Mensaje();
        $form = $this->createForm(MensajeType::class, $mensaje);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mensaje = $form->getData();
            $mensaje->setFecha();
            $mensaje->setEnviado($usuarioEmisor);
            $mensaje->setRecibidos($usuarioReceptor);
            $entityManager->persist($mensaje);
            $entityManager->flush();
            $this->addFlash(
                'success',
                '¡ Mensaje enviado correctamente !'
            );
            return $this->redirectToRoute('perfil', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('mensaje/new.html.twig', [
            'mensaje' => $mensaje,
            'form' => $form,
            'receptor' => $usuarioReceptor,
            'emisor' => $usuarioEmisor
        ]);
    }

    /**
     * @Route("/show/{id}", name="mensaje_show", methods={"GET"})
     */
    public function show(Mensaje $mensaje,Usuario $usuarioReceptor): Response
    {
        $mensaje->setRecibidos($usuarioReceptor);
        return $this->render('mensaje/show.html.twig', [
            'mensaje' => $mensaje,
            'receptor' => $usuarioReceptor,
        ]);
    }

    /**
     * @Route("/{id}", name="mensaje_delete", methods={"POST"})
     */
    public function delete(Request $request, Mensaje $mensaje, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mensaje->getId(), $request->request->get('_token'))) {
            $entityManager->remove($mensaje);
            $entityManager->flush();
            $this->addFlash(
                'success',
                '¡ Mensaje eliminado correctamente !'
            );
        }

        return $this->redirectToRoute('perfil', [], Response::HTTP_SEE_OTHER);
    }
}
