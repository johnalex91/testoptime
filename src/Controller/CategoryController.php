<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Form\CategoryForm;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index(Request $request,PaginatorInterface $paginator): Response
    {
    $em = $this->getDoctrine()->getManager();
    $defaultData = array('search' => '');
    $form = $this->createFormBuilder($defaultData)
        ->add('name', TextType::class, ['label'=>'Buscar',
        'required' => false,
        'attr' => array('placeholder'=>'','class'=>'form-control')
        ])    
        ->add('order', ChoiceType::class, array('label'=>'Ordenar','required' => false,
        'choices'  => array(
            'id' => 'id',
            'code' => 'code',
            'name' => 'name',
            'description' => 'description',
            'active' => 'active',
            ),'attr'=>array('class'=>' form-control')
        ))   
        ->add('tipoorden', ChoiceType::class, array('label'=>'Tipo Orden','required' => false,
        'choices'  => array(
            'Ascedente' => 'ASC',
            'desendente' => 'DESC'
            ),'attr'=>array('class'=>' form-control')
        ))                
        ->add('buscar', SubmitType::class,['label'=>'Guardar','attr'=>array('class'=>'btn btn-success')])
        ->getForm();

        $form->handleRequest($request);
        $clase = $em->getRepository(Category::class);
        $query = $clase->createQueryBuilder('p');

        if($request->getMethod() == 'POST'){
            if ($form->isSubmitted() && $form->isValid()) {
                $name = $request->get("form")["name"] ;
                $order = $request->get("form")["order"] ;
                $tipoorden = $request->get("form")["tipoorden"];
                if($tipoorden==''){ $tipoorden = 'ASC';}
                if($name!=''){
                   $query->where("p.name LIKE '%".$name."%' OR p.code LIKE '%".$name."%' ");
                }
                if($order!='id'){
                    $query->orderBy('p.id', $tipoorden);
                 }
                if($order!='name'){
                    $query->orderBy('p.name', $tipoorden);
                 } 
                 if($order!='code'){
                    $query->orderBy('p.code', $tipoorden);
                 } 
                 if($order!='description'){
                    $query->orderBy('p.description', $tipoorden);
                 }                                                  
                 if($order!='active'){
                    $query->orderBy('p.active', $tipoorden);
                 } 
            }
        }
        $query->getQuery();
        $data = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController','data'=>$data,'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/category/form/{id}", name="category_form")
     */
    public function form(Request $request, $id): Response
    {
        // just setup a fresh $task object (remove the example data)
        $em = $this->getDoctrine()->getManager();
        if($id==0){
            $obj = new Category();
            $form = $this->createForm(CategoryForm::class,$obj );
        }else{
            $obj = $em->getRepository(Category::class)->find($id);
            $form = $this->createForm(CategoryForm::class,$obj );
        }
        $form->handleRequest($request);
        $msg="";
        if($request->getMethod() == 'POST'){
            if ($form->isSubmitted() && $form->isValid()) {
                // $form->getData() holds the submitted values
                // but, the original `$task` variable has also been updated
                //$task = $form->getData();
                if($id==0){
                    $em->persist($obj);
                    $em->flush();
                }else{
                    $obj = $em->getRepository(Category::class)->find($id);
                    $em->persist($obj);
                    $em->flush();
                }
                $msg="PROCESO CORRECTO";    
                $this->addFlash('msg',$msg);                
                return $this->redirectToRoute('category');
            }    
        }
        $this->addFlash('msg',$msg);
        return $this->render('category/form.html.twig', [
            'controller_name' => 'CategorynewController'
            ,'form'=>$form->createView(),'id'=>$id,
        ]);
    

}   

    /**
     * @Route("/category/delete/{id}", name="category_delete")
     */
    public function delete($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository(Category::class)->find($id);    
        if($data){
            try{
                $em->remove($data);
                $em->flush();
                return $this->json(['success'=>'OK']);
            }catch (Exception $e){
                return $this->json(['success'=>'ERROR']);
            }
        }
        return $this->json(['success'=>'ERROR']);
    }       


}
