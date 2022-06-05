<?php

namespace App\Controller;
use App\Repository\UsuarioRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="intro")
     */
    public function intro(): Response
    {
        return $this->render('intro.html.twig');
    }


    /**
     * @Route("/home", name="home")
     */
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/urlError", name="urlError")
     */
    public function urlError(): Response
    {
        return $this->render('errors/errorUrl.html.twig');
    }

    /**
     * @Route("/comunidad", name="comunidad")
     */
    public function comunidad(): Response
    {
        return $this->render('Others/comunidad.html.twig');
    }

    /**
     * @Route("/vinculation-account", name="vinculation-account")
     */
    public function vinculationAccount(): Response
    {
        return $this->render('Vinculation/account.html.twig');
    }

    /**
     * @Route("/chat-torneind", name="chat-torneind")
     */
    public function chatTorneind(): Response
    {
        return $this->render('contact/chat.html.twig', [
            'time' => 'time',
            'messageOutput' => 'messageOutput',
            'response' => 'response',

        ]);

    }

    /**
     * @Route("/vinculation-stream", name="vinculation-stream")
     */
    public function vinculationStream(): Response
    {
        return $this->render('Vinculation/stream.html.twig');
    }

    /**
     * @Route("/tienda", name="tienda")
     */
    public function tienda(): Response
    {
        return $this->render('tienda/tienda.html.twig');
    }

    /**
     * @Route("/cosmeticos", name="cosmeticos")
     */
    public function cosmeticos(): Response
    {
        return $this->render('cosmeticos/cosmeticos.html.twig');
    }

    /**
     * @Route("/cosmetico", name="cosmetico")
     */
    public function cosmetico(): Response
    {
        return $this->render('cosmeticos/cosmetico.html.twig');
    }

    /**
     * @Route("/sitemap", name="sitemap")
     */
    public function sitemap(): Response
    {
        return $this->render('Others/sitemap.html.twig');
    }



    /**
     * @Route("/nuestroMapa", name="nuestroMapa")
     */
    public function nuestroMapa(): Response
    {
        return $this->render('Others/nuestroMapa.html.twig');
    }


    /**
     * @Route("/usuarios", name="usuarios")
     */
    public function userAllList(UsuarioRepository $usuarioRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $page = $request->get("page", 1);
        $text = $request->get('nombre');
        $messageText = "Filtro por texto activo : $text.";
        if ($text != null){
            $this->addFlash(
                'info',
                $messageText
            );
            $textFinal = $usuarioRepository->findTextPaginated($text);
            $pagination = $paginator->paginate($textFinal, $page, 10);
            return $this->render('usuario/list-all-users.html.twig', [
                'pagination' => $pagination,
            ]);
        }
        else
        $pagination = $usuarioRepository->userListPaginated($request, $paginator);
        return $this->render('usuario/list-all-users.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/enviarMensaje", name="enviarMensaje")
     */
    public function userMessageList(UsuarioRepository $usuarioRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $page = $request->get("page", 1);
        $text = $request->get('nombre');
        $messageText = "Filtro por texto activo : $text.";
        if ($text != null){
            $this->addFlash(
                'info',
                $messageText
            );
            $textFinal = $usuarioRepository->findTextPaginated($text);
            $pagination = $paginator->paginate($textFinal, $page, 10);

            return $this->render('usuario/list-all-users.html.twig', [
                'pagination' => $pagination,

            ]);

        }
        else
            $this->addFlash(
            'dark',
            '¡ Elije o busca un jugador al que envíar el mensaje !');
            $pagination = $usuarioRepository->userListPaginated($request, $paginator);
        return $this->render('usuario/list-all-users.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/salud", name="salud")
     */
    public function salud(): Response
    {
        return $this->render('Others/salud.html.twig');
    }

    /**
     * @Route("/privacidad", name="privacidad")
     */
    public function privacidad(): Response
    {
        return $this->render('Others/privacidad.html.twig');
    }

    /**
     * @Route("/compartir", name="compartir")
     */
    public function compartir(): Response
    {
        return $this->render('Others/compartir.html.twig');
    }




    /**
     * @Route("/pay/shop/buy-object/object-shop-ref.ttfr-46252-llmpq", name="/pay/shop/buy-object/object-shop-ref.ttfr-46252-llmpq")
     */
    public function pay(): Response
    {
        return $this->render('Tienda/pay.html.twig');
    }

    /**
     * @Route("/pay/shop/buy-object/object-shop-ref.ttfr-46252-llmpq_success.refid_5521452", name="/pay/shop/buy-object/object-shop-ref.ttfr-46252-llmpq_success.refid_5521452")
     */
    public function shopsucces(): Response
    {
        $this->addFlash(
            'success',
            '¡ Gracias por tu compra 😃​🤑​ !');
        return $this->render('Tienda/compra_ok.html.twig');
    }

}