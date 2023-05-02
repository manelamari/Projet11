<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Category;

use App\Entity\User;
use App\Form\SearchForm;
use App\Repository\BookingRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\Repository\VoitureRepository;
use Knp\Component\Pager\PaginatorInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categorys = $categoryRepository->findAll();
        return $this->render('home/index.html.twig', [

            'categorys' => $categorys,
        ]);
    }

    /**
     *
     * @Route("/category/{id}", name="app_cat")
     * @param $id
     * @param Category $category
     * @param CategoryRepository $categoryRepository
     */
    public function show($id, Category $category, CategoryRepository $categoryRepository, VoitureRepository $voitureRepository): Response
    {
        $category = $categoryRepository->find($id);
        $voitures = $voitureRepository->findvoitbycat($category);
        return $this->render('home/show.html.twig', [
                'voitures' => $voitures,
                'category' => $category]
        );

    }

    /**
     * @Route("/voitures", name="app_voitures")
     *
     */
    public function showallvoiture(Request $request, VoitureRepository $repository, PaginatorInterface $paginator)
    {


        $voitures = $repository->findALL();
        $voitures = $paginator->paginate(
            $voitures, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            6/*limit per page*/);
        return $this->render('home/showallvoitures.twig', [
            'voitures' => $voitures,

        ]);
    }


    /**
     *
     * @Route ("/voitures/search",name="voituressss",methods={"GET","POST"})
     */
    public function index2(VoitureRepository $repository, Request $request): Response
    {
        $session = null;
        $voitures = null;
        $data = new SearchData();
        $searchForm = $this->createForm(SearchForm::class, $data);
        $searchForm->handleRequest($request);
        $voitures2 = null;


        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $criteria = $searchForm->getData();

            // dd($criteria);

            $D = $data->getDebut();
            $F = $data->getFin();
            $session = $request->getSession();
            $session->set('dateDebut', $D);
            $session->set('dateFin', $F);
            //$session->set('vid',1);
            $voitures = $repository->findSearch($D, $F);
            // dd($voitures);
            if (null == $voitures) {
                $voitures2 = $repository->findAll();
            } else {
                $voitures2 = $repository->findvoituresdispo($voitures);
            }
            //dd($voitures2);


        }

        return $this->render('home/index2.html.twig', [
            // 'voitures'=>$voitures,
            'voitures2' => $voitures2,

            'form' => $searchForm->createView()

        ]);

    }


   /* /**
     *
     * @Route ("/voitures/search",name="voituressss",methods={"GET","POST"})
     */
  //  public function index2(VoitureRepository $repository,Request $request):Response
  //  {
//$session=null;
       // $voitures=null;
      //  $data = new SearchData();
      //  $searchForm=$this->createForm(SearchForm::class,$data);
     //   $searchForm->handleRequest($request);
     //   $voitures2=null;


        //if($searchForm->isSubmitted() && $searchForm->isValid()) {
        //    $criteria = $searchForm->getData();

           // dd($criteria);

         //  $D=$data->getDebut();
           //$F=$data->getFin();
         //  $session=$request->getSession();
         //  $session->set('dateDebut',$D);
          //  $session->set('dateFin',$F);
            //$session->set('vid',1);
           // $cars = $repository->findSearch($D, $F);
            //dd($cars);
          //  $voitures2 = $repository->fff($cars);

          //dd($voitures2);

          // $voitures2 = $repository->searchvoinonreserver();
//dd($voitures2 );
   //     }

      //  return $this->render('home/index2.html.twig',[
      //    'voitures'=>$voitures,
       //    'voitures2'=>$voitures2,

     ////       'form'=>$searchForm->createView()

   //    ]);

   // }



}
