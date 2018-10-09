<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use App\Entity\User;


use App\Form\UserregisterType;



class SecurityController extends Controller
{
    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(User $user, Request $request, ObjectManager $manager )
    {
      // $user = new User();
      $form = $this->createForm(UserregisterType::class, $user);

      $form->handleRequest($request);



      if($form->isSubmitted() && $form->isValid()){

        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('main');
      }
        return $this->render('security/edit.html.twig', [

              'form' => $form->createView(),

        ]);
    }
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function inscription(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
      $user = new User();
      $form = $this->createForm(UserregisterType::class, $user);

      $form->handleRequest($request);



      if($form->isSubmitted() && $form->isValid()){
        $hash = $encoder->encodePassword($user, $user->getPassword());

        $user->setPassword($hash);
        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('security_login');
      }
        return $this->render('security/register.html.twig', [

              'form' => $form->createView(),

        ]);
    }
    /**
     * @Route("/inscriptionPas", name="registrationPas")
     */
    public function inscriptionPas(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
      $user = new User();
      $form = $this->createForm(PasregisterType::class, $user);

      $form->handleRequest($request);



      if($form->isSubmitted() && $form->isValid()){
        $hash = $encoder->encodePassword($user, $user->getPassword());

        $user->setPassword($hash);
        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('security_login');
      }
        return $this->render('security/registrationPas.html.twig', [

              'form' => $form->createView(),

        ]);
    }
  //
  //   /**
  // * @Route("/PiloteTreat", name="PiloteTreat")
  // */
  // public function Pilotetreat(Pilote $pilote){
  //
  //
  //     $entityManager = $this->getDoctrine()->getManager();
  //     $repo = $entityManager->getRepository(Pilote::class);
  //
  //     $article = $repo->find($id);
  //
  //     $author = $_POST["author"];
  //     $content = $_POST["content"];
  //
  //     $comment->setAuthor($author)
  //             ->setContent($content)
  //             ->setArticle($article);
  //
  //    $entityManager->persist($comment);
  //    $entityManager->flush();
  //
  //    return $this->redirectToRoute('article');
  //
  //  }
    // /**
    //  * @Route("/inscription", name="security_registration")
    //  */
    // public function choix(){
    //     return $this->render('security/choix.html.twig', [
    //
    //
    //     ]);
    //
    // }
    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils){
        return $this->render('security/login.html.twig', [

          'error'  => $authenticationUtils->getLastAuthenticationError(),
        ]);

    }

    /**
     * @Route("/deconnextion", name="security_logout")
     */
    public function logout(){
        return $this->render('security/login.html.twig');
    }


    /**
   * @Route("/", name="main")
   */
  public function main()
  {
      $user = $this->getUser();


      return $this->render('base.html.twig', [
          'controller_name' => 'Welcome',
          'user' => $user
      ]);
  }

  //   /**
  // * @Route("/PasTreat", name="PasTreat")
  // */
  // public function Pastreat(Passenger $pas){
  //
  //
  //     $entityManager1 = $this->getDoctrine()->getManager();
  //     $repo1 = $entityManager1->getRepository(User::class);
  //     $entityManager2 = $this->getDoctrine()->getManager();
  //     $repo2 = $entityManager2->getRepository(Passenger::class);
  //     $Pas = new Passenger();
  //
  //     $username = $_POST["username"];
  //     $email = $_POST["email"];
  //     $password = $_POST["password"];
  //     $roles = $_POST["roles"];
  //
  //     $repo1  ->setUsername($username)
  //             ->setEmail($email)
  //             ->setPassword($password)
  //             ->setRoles($roles);
  //
  //
  //    $entityManager->persist($repo1);
  //    $entityManager->flush();
  //
  //    $pas = $repo1->find($username);
  //    $pas->setPassenger($pas);
  //
  //
  //    return $this->redirectToRoute('article');
  //
  //  }
}
