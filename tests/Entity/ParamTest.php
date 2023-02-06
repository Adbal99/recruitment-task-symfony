<?php

namespace App\Tests\Entity;

use App\Entity\Exam;
use App\Entity\Param;
use PHPUnit\Framework\TestCase;

class ParamTest extends TestCase
{
    public function testParam(): void
    {
        $param = new Param();
        $param->setName('AST');
        $param->setValue(12.33);
        $param->setExam(new Exam());

        $this->assertEquals('AST', $param->getName());
        $this->assertEquals(12.33, $param->getValue());
        $this->assertInstanceOf(Exam::class, $param->getExam());
    }
}
