<?php
namespace App\Tests;
use PHPUnit\Framework\TestCase;
use Symfony\Bridge\PhpUnit\SetUpTearDownTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\Validator\Constraints\TypeValidator;
use Symfony\Component\Validator\Constraints\Type;

use Symfony\Component\Validator\Validation;
use App\Entity\Category;


use App\Form\CategoryForm;
use Symfony\Component\Form\Test\TypeTestCase;

class CategoryFormTest extends TypeTestCase
{



    public function testPruebaformcategoria(){
        $res = 1+1;
        $this->assertEquals(2, $res);
    }
    
    /*
    * Valid generate form
    */
    public function test_submit_form_category()
    {
        $formData = [
            'name' => 'categoria05',
            'code' => '008',
            'description' => 'cat001',
            'active' => true
        ];
        $model = new Category();
        $form = $this->factory->create(CategoryForm::class, $model);
        $expected = new Category();
        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
    }




}