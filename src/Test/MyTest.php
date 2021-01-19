<?php
namespace App\Tests;
use PHPUnit\Framework\TestCase;
use Symfony\Bridge\PhpUnit\SetUpTearDownTrait;

class MyTest extends TestCase
{

    public function testPrueba(){
        $res = 1+1;
        $this->assertEquals(2, $res);
    }

}