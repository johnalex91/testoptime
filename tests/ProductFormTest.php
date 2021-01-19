<?php
namespace App\Tests;
use PHPUnit\Framework\TestCase;
use Symfony\Bridge\PhpUnit\SetUpTearDownTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\Validator\Constraints\TypeValidator;
use Symfony\Component\Validator\Constraints\Type;

use Symfony\Component\Validator\Validation;
use App\Entity\Product;


use App\Form\ProductForm;
use Symfony\Component\Form\Test\TypeTestCase;

class ProductFormTest extends TypeTestCase
{

    public function testPruebaformproduct(){
        $res = 1+1;
        $this->assertEquals(2, $res);
    }
/*
    public function testSubmitvaliddata()
    {
        $formData = [
            'name' => 'categoria05',
            'code' => '008',
            'description' => 'cat001',
            'mark' => 'test1',
            'price' => 2500,
            'category'=>1
        ];
        $model = new Product();
        $form = $this->factory->create(ProductForm::class, $model);
        $expected = new Product();
        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
    }
*/
/*
    public function testCustomProductFormView()
    {
        $formData = new Product();
        // ... prepare the data as you need

        // The initial data may be used to compute custom view variables
        $view = $this->factory->create(ProductForm::class, $formData)
            ->createView();

        $this->assertArrayHasKey('name', $view->vars);
        var_dump($view->vars['name']);
    }
*/
}