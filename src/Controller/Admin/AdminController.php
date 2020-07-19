<?php


namespace App\Controller\Admin;

use App\Entity\Conference;
use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Repository\ConferenceRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\Type\CreateCommentType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class AdminController  extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(Environment $twig, ConferenceRepository $conferenceRepository)
    {
        $commentRepository = $this->getDoctrine()->getRepository(Comment::class);
        return new Response($twig->render('admin/index.html.twig', [
            'conferences' => $conferenceRepository->findAll(),
            'comment' => $conferenceRepository->findAll()
        ]));
    }
    /**
     * @Route("admin/new_conference", name="new_conference")
     */
    public function conf(Request $request)
    {
        $conf = new Conference();
        $form = $this->createFormBuilder($conf)

            ->add('city', TextType::class)
            ->add('year', TextType::class, array('label' => 'Create Task'))
            ->add('is_international', CheckboxType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))

            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $conf = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($conf);
            $em->flush();
        }
        return $this->render('admin/new_conf.html.twig', array(
            'form' => $form->createView(),
        ));

    }
    /**
     * @Route("admin/new_comment", name="new_comment")
     */
    public function comment(Request $request)
    {
        $comment = new Comment();
        $form = $this->createFormBuilder( $comment)
        ->add('conference', EntityType::class, array(
            'label' => 'Конференции',
            'class' => Conference::class

        ))
        ->add('author', TextType::class)
        ->add('text', TextType::class)
        ->add('email', TextType::class)
        ->add('created_at', DateType::class)
        ->add('submit', SubmitType::class)->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $conf = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($conf);
            $em->flush();
        }

        return $this->render('admin/new_conf.html.twig', array(
            'form' => $form->createView(),
        ));

    }



}