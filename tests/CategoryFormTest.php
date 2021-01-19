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


    public function testSubmitvaliddata()
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

    public function testCustomFormView()
    {
        $formData = new Category();
        // ... prepare the data as you need

        // The initial data may be used to compute custom view variables
        $view = $this->factory->create(CategoryForm::class, $formData)
            ->createView();

        $this->assertArrayHasKey('name', $view->vars);
        var_dump($view->vars['name']);
    }

}