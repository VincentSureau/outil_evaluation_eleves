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
use App\Entity\SNCompetence;
use App\Entity\Specialisation;
use App\Entity\MELECCompetence;
use App\Entity\SNSubCompetence;
use App\Entity\MELECSubCompetence;
use App\Entity\SNTask;
use App\Entity\MELECTask;
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
        $specialisationNames = ["SN", "MEI", "MELEC"];
        $competencesData = [
            [
                'reference' => 'C4-3',
                'label' => 'Effectuer les tests, certifier le support physique',
                'subCompetences' => [
                    'Les résultats des tests sont conformes aux normes en vigueur',
                    'Les règles de sécurité, habilitation électrique, raccordement fluidique sont respectées',
                    'Un rapport est fourni, dans lequel sont indiqués, en adéquation avec les constraintes d\'environnement et les normes :' .
                        '* le schème du plan de câblage avec des modifications éventuelles (raccordement)' .
                        '* la fiche de recette de câblage' .
                        '* l\'analyse de l\'adéquation entre les mesurages effectués et l\'installation considérée' .
                        '* l\'interprétation des tests effectués',
                ]
            ],
            [
                'reference' => 'C4-4',
                'label' => 'Installer, configurer les éléments du système et vérifier la conformité du fonctionnement',
                'subCompetences' => [
                    'Le fonctionnement des appareils à installer est vérifié préalablement',
                    'L\'accès aux paramètres est vérifié préalablement',
                    'Les équipements (appareils et composants logiciels) sont installés en respectant :' .
                        '* les indications et procédures d\'installation' .
                        '* la planification de l\'interventation et l\'ordre de mise en place' .
                        '* les contraintes techniques et fonctionnelles sur tout ou partie d\'un système',
                    'Les éléments de l\'installation sont configurés (matériel et logiciel)',
                    'Les opérations de test sont mise en œuvre et les résultats interprétés',
                    'La conformité fonctionnelle est vérifiée',
                    'Le client est formé à l\'utilisation et à l\'entretien de l\'installation',
                    'Un compte rendu de test est établi et transmis'
                ]
            ],
            [
                'reference' => 'C5-2',
                'label' => 'Vérifier la conformité du support et des alimentations en énergie, le fonctionnement des matériels et logiciels en interaction',
                'subCompetences' => [
                    'Un rapport est fourni dans lequel sont indiqués, en adéquation avec les contraintes d\'environnement et les normes :' .
                        '* le schème des plans de câblage avec les modifications éventuelles (énergie et réseau)' .
                        '* la fiche de recette de câblage' .
                        '* l\'analyse de l\'adéquation entre les mesures effectuées et l\'installation considérée',
                    'Les tests effectués sont interprétés',
                    'L\'alimentation, la prise de terre électrique, la prise de terre informatique sont vérifiées et sont conformes',
                    'Les opérations de tests sur les matériels sont mise en œuvre',
                    'La bonne exécution des logiciels est vérifiée',
                    'Le fonctionnement de chaque équipement est vérifié'
                ]
            ],
            [
                'reference' => 'C5-4',
                'label' => 'Réaliser l\'intervention',
                'subCompetences' => [
                    'L\'intervention est menée en corrélation avec le diagnostic',
                    'Le composant (traversant ou CMS) ou la carte défectueuse est remplacé(e)',
                    'L\'installation est remise en état, les éléments défectueux sont remis en état, changés ou modifiés',
                    'Les éléments en fin de vie sont triés selon la réglementation en vigueur en vue du recyclage'
                ]
            ],
            [
                'reference' => 'C5-5',
                'label' => 'Vérifier la conformité du fonctionnement des matériels des logiciels idéntifiés puis de l\'installation',
                'subCompetences' => [
                    'Le système est mis en service',
                    'L\'installation est remise en service',
                    'Les procédures de tests spécifiques sont mise en place',
                    'Les résultats sont interprétés',
                    'Le fonctionnement du système est vérifié',
                    'La fiche d\'intervention est renseignée'
                ]
            ]
        ];

        $tasksData = [
            'MELEC' => [
                [
                    'reference' => 'T 1-1/TA 1-1',
                    'label' => 'prendre connaissance du dossier relatif aux opérations à réaliser, le constituer pour une opération simple / prendre connaissance du dossier relatif aux opérations à réaliser dans leur environnement'
                ],
                [
                    'reference' => 'T 1-2',
                    'label' => 'rechercher et expliquer les informations relatives aux opération et aux conditions d\'éxécution'
                ],
                [
                    'reference' => 'T 1-3=TA 1-2',
                    'label' => 'vérifier et compléter si besoin la liste des matériels, équipements et outillages nécessaires aux opérations'
                ],
                [
                    'reference' => 'T 1-4',
                    'label' => 'répartir les tâches en fonction des habilitations, des certifications  des équipiers et du planning des autres intervenants'
                ],
                [
                    'reference' => 'T 2-1=TA 2-1',
                    'label' => 'organiser le poste de travail'
                ],
                [
                    'reference' => 'T 2-2=TA 2-2',
                    'label' => 'implanter, poser, installer les matériels électriques'
                ],
                [
                    'reference' => 'T 2-3=TA 2-3',
                    'label' => 'câbler, raccorder les matériels électriques'
                ],
                [
                    'reference' => 'T 2-4',
                    'label' => 'gérer les activités de son équipe'
                ],
                [
                    'reference' => 'T 2-5',
                    'label' => 'coordonner son activité par rapport à celles des autres intervenants'
                ],
                [
                    'reference' => 'T 2-6=TA 2-6',
                    'label' => 'mener son activité de manière eco-responsable'
                ],
                [
                    'reference' => 'T 3-1/TA 3-1',
                    'label' => 'réaliser les vérifications, les réglages, les paramétrages, les essais nécessaires à la mise en service de l\'installation / réaliser les vérifications, les réglages, les essais nécessaire à la mise en service de l\'installation'
                ],
                [
                    'reference' => 'T 3-2/TA 3-2',
                    'label' => 'participer à la réception technique et aux levées de reserves de l\'installation / participer aux opérations nécessaires aux levées de réserves de l\'installation'
                ],
                [
                    'reference' => 'T 4-1',
                    'label' => 'réaliser une opération de maintenance préventive'
                ],
                [
                    'reference' => 'T 4-2/TA 4-1',
                    'label' => 'réaliser une opération de dépannage / réaliser une opération de maintenance simple'
                ],
                [
                    'reference' => 'T 5-1',
                    'label' => 'participer à la mise à jour du dossier technique de l\'installation'
                ],
                [
                    'reference' => 'T 5-2=TA 5-1',
                    'label' => 'échanger sur le déroulement des opérations, expliquer le fonctionnement de l\'installation à l\'interne et à l\'externe'
                ],
                [
                    'reference' => 'T 5-3',
                    'label' => 'conseiller le client, lui proposer une prestation complémentaire, une modification ou une amélioration'
                ]
            ],
            'SN' => [
                [
                    'reference' => 'A1-1',
                    'label' => 'Préparation des opérations'
                ],
                [
                    'reference' => 'A1-2',
                    'label' => 'Intégration, assemblage interconnexion des matériels'
                ],
                [
                    'reference' => 'A1-3',
                    'label' => 'Intégration logiciels'
                ],
                [
                    'reference' => 'A1-4',
                    'label' => 'Test et validation'
                ],
                [
                    'reference' => 'A2-1',
                    'label' => 'Participation à la préparation sur le site d\'installation'
                ],
                [
                    'reference' => 'A2-2',
                    'label' => 'Identification des éléments'
                ],
                [
                    'reference' => 'A2-3',
                    'label' => 'Façonnage des conduits, des supports de transmission et d\'energie'
                ],
                [
                    'reference' => 'A2-4',
                    'label' => 'Implantation, pose des appareillages et équipements d’interconnexion'
                ],
                [
                    'reference' => 'A2-5',
                    'label' => 'Réalisation des activités de câblage et de raccordement'
                ],
                [
                    'reference' => 'A2-6',
                    'label' => 'Test et validation des supports de transmission et d’énergie'
                ],
                [
                    'reference' => 'A2-7',
                    'label' => 'Mise en place, configuration, paramétrage, test, validation  et mise en service'
                ],
                [
                    'reference' => 'A3-1',
                    'label' => 'Maintenance préventive'
                ],
                [
                    'reference' => 'A3-2',
                    'label' => 'Maintenance corrective'
                ],
                [
                    'reference' => 'A4-1',
                    'label' => 'Participation à la gestion de son activité'
                ],
                [
                    'reference' => 'A4-2',
                    'label' => 'Actualisation de ses connaissances et mise à jour de la documentation'
                ],
                [
                    'reference' => 'A4-3',
                    'label' => 'Participation à la relation clientèle'
                ],
                [
                    'reference' => 'A4-4',
                    'label' => 'Respect des obligations légales et réglementaires'
                ]
            ]
        ];

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
            $specialisation->setName($specialisationNames[$i]);

            $manager->persist($specialisation);
            $specialisations[] = $specialisation;

            $subCompetences = [];

            foreach($competencesData as $competenceData){
                $competence;

                switch ($specialisation->getName()) {
                    case "SN":
                        $competence = new SNCompetence;
                        break;
                    case "MEI":
                        //$task = new MEICompetence;
                        break;
                    case "MELEC":
                        $competence = new MELECCompetence;
                        break;
                }
                foreach($competenceData['subCompetences'] as $subCompetenceLabel){
                    $subCompetence;

                    switch ($specialisation->getName()) {
                        case "SN":
                            $subCompetence = new SNSubCompetence;
                            break;
                        case "MEI":
                            //$subCompetence = new MEISubCompetence;
                            break;
                        case "MELEC":
                            $subCompetence = new MELECSubCompetence;
                            break;
                    }

                    $subCompetence->setLabel($subCompetenceLabel)->setCompetence($competence);
                    $manager->persist($subCompetence);
                    $subCompetences[] = $subCompetence;
                }

                $competence->setReference($competenceData['reference'])
                            ->setLabel($competenceData['label'])
                            ->setSpecialisation($specialisation)
                            ;
                $manager->persist($competence);
                $competences[] = $competence;
            }

            switch($specialisation->getName()){
                case 'MELEC':
                    foreach($tasksData['MELEC'] as $value) {
                        $task = new MELECTask;
        
                        $task->setSpecialisation($specialisation)->setLabel($value['label'])->setReference($value['reference']);
                        $manager->persist($task);
                        $tasks[] = $task;
                    }
                    break;
                case 'SN':
                foreach($tasksData['SN'] as $value) {
                    $task = new MELECTask;
    
                    $task->setSpecialisation($specialisation)->setLabel($value['label'])->setReference($value['reference']);
                    $manager->persist($task);
                    $tasks[] = $task;
                }
                    break;
            }

            /*for($k = 1; $k <= mt_rand(2,4); $k++){
                
                $competence;

                switch ($specialisation->getName()) {
                    case "SN":
                        $competence = new SNCompetence;
                        break;
                    case "MEI":
                        //$task = new MEICompetence;
                        break;
                    case "MELEC":
                        //$task = new MELECCompetence;
                        break;
                }

                for($j = 1; $j <= 15; $j++){

                    $task;
    
                    switch ($specialisation->getName()) {
                        case "SN":
                            $task = new SNTask;
                            break;
                        case "MEI":
                            //$task = new MEITask;
                            break;
                        case "MELEC":
                            //$task = new MELECTask;
                            break;
                    }
                    
                    $task->setLabel($faker->catchPhrase)
                                ->setCompetence($competence)
                                ;
                    
                    $manager->persist($task);
                    $tasks[] = $task;
                }

                $competence->setReference('C' . $k)
                            ->setLabel($faker->catchPhrase)
                            ->addSNTask($task)
                            ->setSpecialisation($specialisation)
                            ->setIsActive(true)
                            ;
                $manager->persist($competence);
                $competences[] = $competence;
            }*/

            for($j = 1; $j <= 6; $j++)
            {
                $tp = new Tp;
                $tp->setName($faker->word)
                    ->setSpecialisation($specialisation);
                /*$cps = array_rand($tasks, mt_rand(6, 12));
                foreach($cps as $cp){
                    $tp->addTask($tasks[$cp]);
                }*/
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
