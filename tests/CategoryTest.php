<?php
namespace App\Tests;
use PHPUnit\Framework\TestCase;
use Symfony\Bridge\PhpUnit\SetUpTearDownTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\Validator\Constraints\TypeValidator;
use Symfony\Component\Validator\Constraints\Type;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ValidatorBuilder;
use App\Entity\Category;


use App\Form\Type\CategoryForm;
use Symfony\Component\Form\Test\TypeTestCase;

class CategoryTest extends WebTestCase
{


    public function testPruebacategoria(){
        $res = 1+1;
        $this->assertEquals(2, $res);
    }

    
    
    /**
     * Formulario get id = 0 || !=0
     */
    
    public function test_response_call_form_new_edit(){

        $client = static::createClient();
        $client->request('GET', 'http://127.0.0.1:8000/category/form/0');
        $this->assertEquals(200, $client->getResponse()->getStatusCode()); 
        
        $client->request('GET', 'http://127.0.0.1:8000/category/form/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());         
    }



    /**
     * Crear informacion  id = 0 || !=0
     */
    /*
    public function testFormvalidar(){

        $client = static::createClient();
        $client->request('POST', 'http://127.0.0.1:8000/category/form/0');
        $datos = ['name' => 'PRODUCTOARROZ01&','code'=>'1234','description'=>'descrioptionc01','active'=>true];
        $client->request('POST', 'http://127.0.0.1:8000/category/form/0', $datos);

        $client->insulate();
        $this->assertEquals(200, $client->getResponse()->getStatusCode()); 
        
    }
    */





}