<?php

namespace App\Controller;

use App\Entity\Indice;
use App\Entity\Parcours;
use App\Entity\Points;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function index()
    {

        $repository = $this->getDoctrine()->getRepository(Parcours::class);
        $user = null;
        $parcoursRejoints = null;
        $parcours = $repository->findAll();
        if($this->getUser() != null){
            $user = $this->getDoctrine()->getRepository(User::class)->find($this->getUser()->getId());
            $parcoursRejoints = $user->getParcoursRejoint();
        }

        return $this->render('map/index.html.twig', [
            'controller_name' => 'MapController',
            'parcours' => $parcours,
            'parcoursRejoints' => $parcoursRejoints,
        ]);
    }

    /**
     * @Route("/map/create",name="map_create")
     */
/*    public function createMap(Request $request, ObjectManager $manager){


        $parcour = $this->getDoctrine()->getRepository(Parcours::class)->find($_GET["id"]);


        $form = $this->createForm(ChangeProfileType::class, $parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist($parcour);
            $manager->flush();
            return $this->redirectToRoute('profile');
        }

        $form->get('Nom')->setData($parcour->getNom());
        $form->get('Prenom')->setData($parcour->getPrenom());


        return $this->render('user/changeProfile.html.twig',[
            'form' => $form->createView()
        ]);
    }*/

    /**
     * @Route("/map/create",name="map_create")
     */
    public function showCreateMap(Request $request, ObjectManager $manager){

        return $this->render(('map/showCreateMap.html.twig'));
    }

    /**
     * @Route("/map/create/valid",name="valid.map_create")
     */
    public function validCreateMap(Request $request, ObjectManager $manager){

        $entityManager = $this->getDoctrine()->getManager();

        $mapData = json_decode($_POST['mapvalue'],true);
        dump($mapData);
        $user = $this->getUser();
        $parcours = new Parcours();
        $parcours->setNomParcours($mapData["nomParcours"]);
        $parcours->setTypeParcours($mapData["typeParcours"]);
        $parcours->setLongueurParcours(floatval($mapData["longueurParcours"]));
        $parcours->setLat(floatval($mapData["lat"]));
        $parcours->setLng(floatval($mapData["lng"]));
        $parcours->setZoom(intval($mapData["zoom"]));
        $parcours->setDescription($mapData['description']);
        $parcours->addUser($user);
        $parcours->setJson($_POST['mapvalue']);
        $entityManager->persist($parcours);


        foreach ($mapData["points"] as $point) {
            $newpoint = new Points();
            dump($point);
            $newpoint->setTitre($point['titre']);
            $newpoint->setLat($point['lat']);
            $newpoint->setLng($point['lng']);
            $newpoint->setParcours($parcours);
            dump($newpoint);
            $entityManager->persist($newpoint);
            foreach ($point['indices'] as $indice) {
                $newIndice = new Indice();
                $newIndice->setNom($indice['nom']);
                $newIndice->setPoint($newpoint);
                $newIndice->setObligatoire($indice['obligatoire']);
                if($indice['obligatoire'] == true){
                    $newIndice->setCout(0);
                }else{
                    $newIndice->setCout(100);
                }
                $entityManager->persist($newIndice);
            }
        }
        dump($parcours);
        $entityManager->flush();

        return $this->render(('map/showCreateMap.html.twig'));
    }

    /**
     * @Route("/map/participe",name="map_participe")
     */
    public function participe(Request $request, ObjectManager $manager){

        $entityManager = $this->getDoctrine()->getManager();
        $parcours = $this->getDoctrine()->getRepository(Parcours::class)->find($_POST['id']);
        $user = $this->getUser();
        $user->addParcoursRejoint($parcours);
        $entityManager->flush();
        return $this->redirectToRoute('map');
    }

    /**
     * @Route("/map/lastParcours",name="map_lastParcours")
     */
    public function lastParcour(Request $request, ObjectManager $manager){

        $idUser = $_GET['idUser'];
        $user = $this->getDoctrine()->getRepository(User::class)->find($idUser);
        $tab = $user->getParcoursRejoint()->toArray();
        dump($tab);
        $parcours = end($tab);
        dump($parcours);
        $json = json_decode($parcours->getJson(),true);
        $json['idParcours'] = $parcours->getId();
        foreach ($json['points'] as $index => $point ) {
            $point['idPoint'] = $parcours->getPoints()[$index]->getId();  
            $json['points'][$index]['idPoint'] = $point['idPoint'];
        }
        $jsonString = json_encode($json);
        
        $response = new Response($jsonString);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


}
