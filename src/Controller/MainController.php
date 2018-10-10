<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Vol;



use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ PasswordType;
// use App\Form\ UserregisterType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\VolRegisterType;


class MainController extends AbstractController
{
    /**
     * @Route("/vollist", name="vollist")
     */
    public function vollist()
    {



        $repo = $this->getDoctrine()->getRepository(Vol::class);

        $vollist = $repo->findAll();

        return $this->render('main/vollist.html.twig', [

          'vollist' => $vollist,


        ]);
    }
    /**
     * @Route("/vollistadmin", name="vollistadmin")
     */
    public function vollistad()
    {


        $user = $this->getUser()->getid();

        $repo = $this->getDoctrine()->getRepository(Vol::class);

        $vollist = $repo->findAll();

        return $this->render('main/vollistadmin.html.twig', [

          'vols' => $vollist,

          'user' => $user,
        ]);
    }
    /**
     * @Route("/vollistpas", name="vollistpas")
     */
    public function vollistpas()
    {

        $user = $this->getUser()->getid();;

        $repo = $this->getDoctrine()->getRepository(Vol::class);

        $vollist = $repo->findAll();

        return $this->render('main/vollistpas.html.twig', [

          'vollist' => $vollist,

          'user' => $user,
        ]);
    }
    /**
     * @Route("/vollistpilote", name="vollistpilote")
     */
    public function vollistpilote()
    {

        $user = $this->getUser()->getid();

        $repo = $this->getDoctrine()->getRepository(Vol::class);

        $vollist = $repo->findAll();

        return $this->render('main/vollistpilote.html.twig', [

          'vollist' => $vollist,

          'user' => $user,
        ]);
    }
    /**
     * @Route("/show", name="show")
     */
    public function show()
    {

        $user = $this->getUser()->getid();

        $repo = $this->getDoctrine()->getRepository(Vol::class);

        $vollist = $repo->findAll();

        return $this->render('main/show.html.twig', [

          'vols' => $vollist,

          'user' => $user,
        ]);
    }
    /**
     * @Route("/del/{id}", name="del")
     */
    public function del($id)
    {

        $article = new Vol();
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository($article)->find($id);





        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('show');

    }
    /**
     * @Route("/gerevol", name="gerevol")
     */
    public function gere( Request $request, ObjectManager $manager)
    {
        // $user = $this->getUser();
        $vol = new Vol();

        $form = $this->createForm(VolRegisterType::class, $vol);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){


          $manager->persist($vol);
          $manager->flush();

          return $this->redirectToRoute('vollistpas');
        }
        return $this->render('main/gerevol.html.twig', [


          'form' => $form->createView(),
          // 'user' => $user,
        ]);
    }
    /**
     * @Route("/control/{id}", name="control")
     */
    public function control(Vol $vol, Request $request, ObjectManager $manager)
    {
        // $user = $this->getUser();


        $form = $this->createForm(VolRegisterType::class, $vol);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){


          $manager->persist($vol);
          $manager->flush();

          return $this->redirectToRoute('vollistadmin');
        }
        return $this->render('main/control.html.twig', [


          'form' => $form->createView(),
          // 'user' => $user,
        ]);
    }
    /**
     * @Route("/voledit/{id}", name="voledit")
     */
    public function voledit( Vol $vol, Request $request, ObjectManager $manager)
    {
        // $user = $this->getUser();


        $form = $this->createForm(VolRegisterType::class, $vol);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){


          $manager->persist($vol);
          $manager->flush();

          return $this->redirectToRoute('vollistadmin');
        }
        return $this->render('main/control.html.twig', [


          'form' => $form->createView(),
          // 'user' => $user,
        ]);
    }
}
