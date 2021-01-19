<?php
namespace App\Tests\Entity;

use App\Entity\Category as InvitationCode;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;
class   CategorypruebaTest extends KernelTestCase
{

    use FixturesTrait;

    public function getEntity(): InvitationCode
    {
        return (new InvitationCode())
        ->setName('123453')    
        ->setCode('123453')
        ->setDescription('Description')
        ->setActive(true)
            ;
    }

    public function assertHasErrors(InvitationCode $code, int $number = 0)
    {

        $validator = Validation::createValidator();

        self::bootKernel();
        $errors = $validator->validate($code);
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error) {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }
        $this->assertCount($number, $errors, implode(', ', $messages));
    }

    public function testValidEntity()
    {
        $this->assertHasErrors($this->getEntity(), 0);
    }

    public function testInvalidCodeEntity()
    {
        $this->assertHasErrors($this->getEntity()->setCode('1345'), 0);

    }

    public function testInvalidBlankCodeEntity()
    {
        $this->assertHasErrors($this->getEntity()->setCode(''), 0);    
    }
/*
    public function testInvalidBlankDescriptionEntity()
    {
        
    }
*/
    /*
    public function testInvalidUsedCode ()
    {
        $this->loadFixtureFiles([dirname(__DIR__) . '/fixtures/invitation_codes.yaml']);
        $this->assertHasErrors($this->getEntity()->setCode('54321'), 1);
    }
    */
}