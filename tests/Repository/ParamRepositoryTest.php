<?php

namespace App\Tests\Repository;

use App\Entity\Param;
use App\Repository\ExamRepository;
use App\Repository\ParamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ParamRepositoryTest extends KernelTestCase
{
    private EntityManagerInterface $entityManager;

    private ParamRepository $paramRepository;
    private ExamRepository $examRepository;

    protected function setUp(): void
    {
        //(1) boot the Symfony kernel
        $kernel = static::bootKernel();
        $this->assertSame('test', $kernel->getEnvironment());
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        //(2) use static::getContainer() to access the service container
        $container = static::getContainer();

        //(3) get repos from container.
        $this->postRepository = $container->get(ParamRepository::class);
        $this->examRepository = $container->get(ExamRepository::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
    }

    public function testCreatePost(): void
    {
        $exam = $this->examRepository->findOneBy(['id' => 1]);
        $param = new Param();

        $param->setName('AST');
        $param->setValue(12.33);
        $param->setExam($exam);

        $this->entityManager->persist($param);
        $this->entityManager->flush();

        $this->assertNotNull($param->getId());

        $entityById = $this->postRepository->findOneBy(["id" => $param->getId()]);
        $this->assertEquals("AST", $entityById->getName());
        $this->assertEquals(12.33, $entityById->getValue());
        $this->assertEquals($exam, $entityById->getExam());
    }
}
