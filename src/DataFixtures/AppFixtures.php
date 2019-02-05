<?php

namespace App\DataFixtures;

use App\Entity\Tp;
use Faker\Factory;
use App\Entity\Srm;
use App\Entity\User;
use App\Entity\Cirfa;
use App\Entity\Bordee;
use App\Entity\School;
use App\Entity\Student;
use App\Entity\Referent;
use App\Entity\Task;
use App\Entity\Specialisation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $user = new User;
        $user->setUsername('admin')
            ->setFirstName('Patrick')
            ->setLastName('Perrier')
            ->setEmail($faker->safeEmail)
            ->setNumber($faker->phoneNumber)
            ->setGrade($faker->word)
            ->setPassword($this->encoder->encodePassword($user, 'lapinmarin'))
            ->setRoles(['ROLE_ADMIN'])
            ;
        
        $manager->persist($user);

        $schools = [];
        $srms = [];
        $cirfas = [];
        $referents = [];
        $specialisations = [];
        $bordees = [];

        for($i = 17; $i < 20; $i++){
            for($j = 1; $j < 5; $j++){
                $bordee = new Bordee;
                $bordee->setName($i . '.' . $j);
                $manager->persist($bordee);
                $bordees[] = $bordee;
            }
        }

        for ($i = 0; $i < 70; $i++)
        {
            $school = new School;

            $school->setName($faker->company)
                    ->setNumber($faker->phoneNumber)
                    ->setEmail($faker->safeEmail)
                    ->setAcademy($faker->city)
                    ;
            
            $schools[] = $school;

            $manager->persist($school);
            
            $srm = new Srm;
            $srm->setName($faker->city)
                ->setEmail($faker->safeEmail);

            $srms[] = $srm;
            $manager->persist($srm);

            $cirfa = new Cirfa;
            $cirfa->setCity($faker->city)
                  ->setNumber($faker->phoneNumber)
                  ->setEmail($faker->safeEmail);

            $cirfas[] = $cirfa;
            $manager->persist($cirfa);
        }

        for ($i = 0; $i <= 5; $i++){
            $referent = new Referent;
            $referent->setFirstname($faker->firstNameMale)
                     ->setLastname($faker->lastName)
                     ->setGender('M.');

            $manager->persist($referent);
            $referents[] = $referent;
        }


        for ($i = 0; $i < 3; $i++){
            $specialisation = new Specialisation;
            $specialisation->setName(strtoupper($faker->word));

            $manager->persist($specialisation);
            $specialisations[] = $specialisation;

            $tasks = [];
            for($j = 1; $j <= 15; $j++){
                
                $task = new Task;
                $task->setReference('C' . $j)
                            ->setName($faker->catchPhrase)
                            ->setSpecialisation($specialisation)
                            ;
                
                $manager->persist($task);
                $tasks[] = $task;
            }

            for($j = 1; $j <= 6; $j++)
            {
                $tp = new Tp;
                $tp->setName($faker->word)
                    ->setSpecialisation($specialisation);
                $cps = array_rand($tasks, mt_rand(6, 12));
                foreach($cps as $cp){
                    $tp->addTask($tasks[$cp]);
                }
                $manager->persist($tp);
            }

        } 

        for($i = 0; $i < 500; $i++){
            $student = new Student;
            $student->setCity($faker->city)
                    ->setFirstName($faker->firstNameMale)
                    ->setLastName($faker->lastName)
                    ->setGender('M.')
                    ->setBirthplace($faker->city)
                    ->setBirthdate(new \Datetime())
                    ->setSpecialisation($specialisations[array_rand($specialisations)])
                    ->setSrm($srms[array_rand($srms)])
                    ->setCirfa($cirfas[array_rand($cirfas)])
                    ->setSchool($schools[array_rand($schools)])
                    ->setReferent($referents[array_rand($referents)])
                    ->setBordee($bordees[array_rand($bordees)])
                    ;

            $manager->persist($student);
            
        }

        $manager->flush();
    }
}
