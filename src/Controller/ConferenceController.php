<?php

namespace App\Controller;
use Twig\Extra\Intl\IntlExtension;
use App\Entity\Conference;
use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Repository\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
class ConferenceController extends AbstractController
{

    private  $twig;
    function  __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
    /**
     * @Route("/", name="homepage")
     */ 
    public function index(Environment $twig, ConferenceRepository $conferenceRepository)
    {

        return new Response($twig->render('conference/index.html.twig', [
             'conferences' => $conferenceRepository->findAll(),
             ]));
    }

    /**
     * @Route("/conference/{id}", name="conference")

     */
//show(Environment $twig,
    public function show(Request $request , $id){
        $conference = $this->getDoctrine()->getRepository(Conference::class)->find($id);
        $this->twig->addExtension(new IntlExtension());
        $comments = $this->getDoctrine()->getRepository(Comment::class)->findBy(['conference' => $conference ]);
        return new Response($this->twig->render('conference/show.html.twig', [
            'conference' => $conference,
             'comments' => $comments
         ]));
}
}
