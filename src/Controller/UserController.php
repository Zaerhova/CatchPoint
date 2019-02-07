<?php

namespace App\Controller;

use App\Entity\Parcours;
use App\Entity\Score;
use App\Entity\User;
use App\Entity\Points;
use App\Entity\PointTrouve;
use App\Form\ChangeProfileType;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login()
    {

        return $this->render('user/login.html.twig');
    }

    /**
     * @Route("/logout",name="logout")
     */
    public function logout(){

    }

    /**
     * @Route("/profile",name="profile")
     */
    public function profile(){
        $user = $this->getUser();
        $scores = $this->getDoctrine()->getRepository(Score::class)->findBy(['user' => $user->getId()]);
        dump($scores);
        return $this->render('user/profile.html.twig', ['scores' => $scores]);
    }

    /**
     * @Route("/changeProfile",name="changeProfile")
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function changeProfile(Request $request, ObjectManager $manager){

        $user = $this->getDoctrine()->getRepository(User::class)->find($_GET["id"]);


        $form = $this->createForm(ChangeProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('profile');
        }

        $form->get('Nom')->setData($user->getNom());
        $form->get('Prenom')->setData($user->getPrenom());



        return $this->render('user/changeProfile.html.twig',[
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/saveScore", name="saveScore")
     */
    public function getScores(Request $request, ObjectManager $manager){
        $entityManager = $this->getDoctrine()->getManager();
        $idUser = $_POST['idUser'];
        $user = $this->getDoctrine()->getRepository(User::class)->find($idUser);
        $idParcours = $_POST['idParcours'];
        $parcours = $this->getDoctrine()->getRepository(Parcours::class)->find($idParcours);
        
        $points = $_POST['score'];
        $nbPoints = $_POST['pointsValides'];
        $temps = $_POST['temps'];

        echo var_dump($_POST['pointsTrouves']);
        $pointsTrouves = explode('/',$_POST['pointsTrouves']);
        echo var_dump($pointsTrouves);
        $score = new Score();
        $score->setUser($user);
        $score->setParcours($parcours);
        $score->setPoints($points);
        $score->setTemps($temps);
        $score->setnbPoint($nbPoints);
        $entityManager->persist($score);
        foreach ($pointsTrouves as $index => $point) {
            $pointTrouve = new PointTrouve();
            $json = json_decode($point,true);
            $pointGet = $this->getDoctrine()->getRepository(Points::class)->find($json['idPoint']);
            $pointTrouve->setPoint($pointGet);
            $pointTrouve->setScore($score);
            $pointTrouve->setTrouve($json['trouve']);
            $entityManager->persist($pointTrouve);
        }
        $entityManager->flush();

        return  new Response("ok");
    }

    /**
     *
     * @Route("/registration", name="registration")
     * @param Request $request
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){

        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('login');
        }

        return $this->render('user/registration.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/connexionAndroid/{username}&{passwordAnroid}",name="androidConnexion")
     */
    public function getUserAndroid(Request $request, ObjectManager $manager, EncoderFactoryInterface $encoderFactory, UserPasswordEncoderInterface $encoder, $username,$passwordAnroid){

        $encodedPassword = $encoder->encodePassword(new User(), $passwordAnroid);
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username' => $username,'password' => $encodedPassword]);
        $tableau_pour_json = ['idUser'=> htmlspecialchars($user->getId())];
        $contenu_json = json_encode($tableau_pour_json);

        return new Response($contenu_json);

    }
}
