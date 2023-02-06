<?php

namespace App\DataFixtures;

use App\Entity\Exam;
use App\Entity\Param;
use Doctrine\Persistence\ObjectManager;

class ParamFixtures extends \Doctrine\Bundle\FixturesBundle\Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $examRepo = $manager->getRepository(Exam::class);
        $exams = $examRepo->findAll();
        for ($i = 1; $i <= 40; $i++) {
            $param = new Param();

            $param->setName('Parametr' . $i);
            $param->setExam($exams[random_int(0, 19)]);
            $param->setValue(round($i * 9.99, 2));

            $manager->persist($param);
        }

        $manager->flush();
    }

}