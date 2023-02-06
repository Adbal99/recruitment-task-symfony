<?php

namespace App\DataFixtures;

use App\Entity\Exam;
use Doctrine\Persistence\ObjectManager;

class ExamFixtures extends \Doctrine\Bundle\FixturesBundle\Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $exam = new Exam();
            $exam->setName('Badanie' . $i);
            $exam->setCreateDt();
            $exam->setDescription("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in");

            $manager->persist($exam);
        }

        $manager->flush();
    }

}