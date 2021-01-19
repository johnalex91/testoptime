<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Form\ProductForm;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
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
                'mark' => 'mark',
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
            $clase = $em->getRepository(Product::class);
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
                }
            }

            $query->join('p.category','c')
            ->where('c.active = :status')
            ->setParameter('status', 1);

            $query->getQuery();
            $data = $paginator->paginate(
                $query,
                $request->query->getInt('page', 1),
                5
            );
            return $this->render('product/index.html.twig', [
                'controller_name' => 'ProductController','data'=>$data,'form'=>$form->createView()
            ]);
    }

    /**
     * @Route("/product/form/{id}", name="product_form")
     */
    public function form(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        if($id==0){
            $obj = new Product();
            $form = $this->createForm(ProductForm::class,$obj );
        }else{
            $obj = $em->getRepository(Product::class)->find($id);
            $form = $this->createForm(ProductForm::class,$obj );
        }
        $form->handleRequest($request);
        $msg="";
        if($request->getMethod() == 'POST'){
            if ($form->isSubmitted() && $form->isValid()) {
                if($id==0){
                    $em->persist($obj);
                    $em->flush();
                }else{
                    $obj = $em->getRepository(Product::class)->find($id);
                    $em->persist($obj);
                    $em->flush();
                }
                $msg="PROCESO CORRECTO";    
                $this->addFlash('msg',$msg);                
                return $this->redirectToRoute('product');
            }    
        }
        $this->addFlash('msg',$msg);
        return $this->render('product/form.html.twig', [
            'controller_name' => 'ProductnewController'
            ,'form'=>$form->createView(),'id'=>$id,
        ]);
    

}   

    /**
     * @Route("/product/delete/{id}", name="product_delete")
     */
    public function delete($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository(Product::class)->find($id);    
        //$session="";
        if($data){
            $em->remove($data);
            $em->flush();
            //$session="PROCESO CORRECTO";   
            return $this->json(['success'=>'OK']);
        }
        //$this->addFlash('msg',$session);
        return $this->json(['success'=>'ERROR']);
    }           
}
