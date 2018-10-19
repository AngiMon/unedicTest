<?php
/**
 * Created by PhpStorm.
 * User: angelina.monate
 * Date: 19/10/2018
 * Time: 16:09
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Department;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LoadDB extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $departments =
                    array(
                        ['name' => 'Programmation', 'capacity' => 10],
                        ['name' => 'Mathématiques', 'capacity' => 15],
                        ['name' => 'Graphisme', 'capacity' => 20],
                        ['name' => 'Réseau', 'capacity' => 12],
                        ['name' => 'Support', 'capacity' => 26],
                    );

        foreach ($departments as $x)
        {
            $department = new Department();
            $department->setName($x['name']);
            $department->setCapacity($x['capacity']);
            $manager->persist($department);
        }

        $manager->flush();
    }
}