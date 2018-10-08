<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Vol;
use App\Entity\Vollist;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ PasswordType;
// use App\Form\ UserregisterType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends AbstractController
{
    /**
     * @Route("/vollist", name="vollists")
     */
    public function index()
    {

        $user = $this->getUser();

        $repo = $this->getDoctrine()->getRepository(Vol::class);

        $vollist = $repo->findAll();

        return $this->render('main/vollist.html.twig', [

          'vollist' => $vollist,

          'user' => $user,
        ]);
    }
}
