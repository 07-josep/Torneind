<?php

namespace App\Controller;

use App\Entity\Modalidad;
use App\Entity\Opinion;
use App\Entity\Torneo;
use App\Form\Torneo1Type;
use App\Repository\InscripcionRepository;
use App\Repository\ModalidadRepository;
use App\Repository\OpinionRepository;
use App\Repository\TorneoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Test\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/torneo")
 */
class TorneoController extends AbstractController
{
    /**
     * @Route("/index", name="torneo_index", methods={"GET"})
     */
    public function index(OpinionRepository $opinionRepository,TorneoRepository $torneoRepository, ModalidadRepository $modalidadRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $data = $request->query->get("data");
        $data2 = $request->query->get("data2");
        $page = $request->get("page", 1);
        $text = $request->get('nombre');
        $tipo = $request->query->getAlnum("categoria");
        $dates = $torneoRepository->findBetweenDatesPaginated($data, $data2);
        $messageText = "Filtro por texto activo : $text.";
        $messageDates = "Filtrando desde $data hasta $data2. ";
        $messageCategoria = "Filtro por categoria $tipo activado. ";

        if ($text != null) {
            $textFinal = $torneoRepository->findTextPaginated($text);
            $pagination = $paginator->paginate($textFinal, $page, 10);
            $this->addFlash(
                'info',
                $messageText
            );
            return $this->render('torneo/index.html.twig', [
                'pagination' => $pagination,
            ]);
        }

        if ($data != null && $data2 != null) {
            $pagination = $paginator->paginate($dates, $page, 10);
            $this->addFlash(
                'info',
                $messageDates
            );
            return $this->render('torneo/index.html.twig', [
                'pagination' => $pagination,
            ]);
        } else
        $categoria = $modalidadRepository->findOneBy(['modalidad' => $tipo]);

        if (empty($categoria)) {
            $pagination = $torneoRepository->getAllPaginated($request, $paginator);
        } else {
            $this->addFlash(
                'info',
                $messageCategoria
            );
            $pagination = $torneoRepository->getAllPaginatedByCategoria($request, $paginator, $categoria);
        }

        return $this->render('torneo/index.html.twig', [
            'pagination' => $pagination,
            'opinions' => $opinionRepository->findAll(),
        ]);
    }






    /**
     * @Route("/new", name="torneo_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $torneo = new Torneo();
        $form = $this->createForm(Torneo1Type::class, $torneo);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $torneo->setUsuario($this->getUser());
            $entityManager->persist($torneo);
            $entityManager->flush();
            return $this->redirectToRoute('torneo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('torneo/new.html.twig', [
            'torneo' => $torneo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="torneo_show", methods={"GET"})
     */
    public function show(Torneo $torneo): Response
    {
        return $this->render('torneo/show.html.twig', [
            'torneo' => $torneo,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="torneo_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Torneo $torneo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Torneo1Type::class, $torneo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash(
                'success',
                '¡ Torneo editado correctamente !'
            );
            return $this->redirectToRoute('torneo_index', [], Response::HTTP_SEE_OTHER);

        }

        return $this->renderForm('torneo/edit.html.twig', [
            'torneo' => $torneo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="torneo_delete", methods={"POST"})
     */
    public function delete(Request $request, Torneo $torneo, EntityManagerInterface $entityManager, InscripcionRepository $inscripcionRepository): Response
    {
        $var1 = $inscripcionRepository->findBy(['torneo' => $torneo->getId()]);
        if ($var1){
            $this->addFlash(
                'danger',
                'No se puede eliminar un torneo que tenga inscripciones activas.'
            );
            return $this->redirectToRoute('torneo_index', [], Response::HTTP_SEE_OTHER);
        }
        else{
            if ($this->isCsrfTokenValid('delete' . $torneo->getId(), $request->request->get('_token'))) {
                $entityManager->remove($torneo);
                $entityManager->flush();
            }
            $this->addFlash(
                'success',
                '¡ Torneo eliminado correctamente !'
            );

            return $this->redirectToRoute('torneo_index', [], Response::HTTP_SEE_OTHER);
        }
    }
}
