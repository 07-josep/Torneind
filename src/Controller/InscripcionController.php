<?php
namespace App\Controller;
use App\Entity\Inscripcion;
use App\Entity\Torneo;
use App\Form\InscripcionType;
use App\Repository\InscripcionRepository;
use App\Repository\TorneoRepository;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inscripcion")
 */
class InscripcionController extends AbstractController
{

    /**
     * @Route("/new/{id}", name="inscripcion_new", methods={"GET", "POST"})
     */
    public function new(Request $request, Torneo $torneo, EntityManagerInterface $entityManager, InscripcionRepository $inscripcionRepository): Response
    {
        $inscripcion = new Inscripcion();
        $form = $this->createForm(InscripcionType::class, $inscripcion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $inscripcion->setUsuario($this->getUser());
            $inscripcion->setTorneo($torneo);
            $entityManager->persist($inscripcion);
            $entityManager->flush();
            return $this->redirectToRoute('inscripcion_show', ['id'=>$inscripcion->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('inscripcion/new.html.twig', [
            'inscripcion' => $inscripcion,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/show/{id}", name="inscripcion_show", methods={"GET"})
     */
    public function show(Inscripcion $inscripcion): Response
    {
        return $this->render('inscripcion/show.html.twig',[
            'inscripcion' => $inscripcion,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="inscripcion_delete", methods={"POST"})
     */
    public function delete(Request $request, Inscripcion $inscripcion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscripcion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($inscripcion);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Has eliminado tu participación !'
            );
        }
        return $this->redirectToRoute('perfil', [], Response::HTTP_SEE_OTHER);
    }

}
