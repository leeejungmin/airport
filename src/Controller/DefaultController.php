<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use App\Entity\User;
use App\Form\UserregisterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_USER")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboardAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository(User::class)->findAll();

        return $this->render('default/dashboard.html.twig', [
            'users' => $users
        ]);
    }
    /**
     * @Route("/edituser/{id}", name="user_edit")
     * @ParamConverter("post", class="SensioBlogBundle:Post")
     */
    public function editUserAction(User $user, Request $request, ObjectManager $manager)
    {

          $form = $this->createForm(UserregisterType::class, $user);

          $form->handleRequest($request);



          if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('dashboard');
          }
        return $this->render('default/editUser.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }


}
