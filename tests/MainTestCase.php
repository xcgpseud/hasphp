<?php

namespace Tests;

use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class MainTestCase extends TestCase
{
    /**
     * @param int $age
     * @return Person
     */
    protected function getFakePersonWithAge(int $age): Person
    {
        $faker = Factory::create();
        return new Person($faker->firstName, $faker->lastName, $age);
    }

    /**
     * @return Person
     */
    protected function getFakePerson(): Person
    {
        $faker = Factory::create();
        return new Person($faker->firstName, $faker->lastName, $faker->numberBetween(0, 150));
    }

    /**
     * @param array $ages
     * @return Person[]
     */
    protected function getFakePeopleWithAges(array $ages): array
    {
        $out = [];
        foreach ($ages as $age) {
            $out[] = $this->getFakePersonWithAge($age);
        }
        return $out;
    }

    /**
     * @param int $count
     * @return array
     */
    protected function getFakePeople(int $count): array
    {
        $out = [];
        for ($i = 0; $i < $count; $i++) {
            $out[] = $this->getFakePerson();
        }
        return $out;
    }

    /**
     * @param Person $person
     * @param int $age
     * @return Person
     */
    protected function getNewFakePersonWithAge(Person $person, int $age): Person
    {
        return new Person($person->fName, $person->lName, $age);
    }
}