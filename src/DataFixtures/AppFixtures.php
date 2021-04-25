<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Company;
use App\Entity\LegalForm;
use App\Entity\Version;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    $faker = Factory::create('fr_FR');

       $legalForms = $this->getLegalForms();

       foreach($legalForms as $legal) {
           $legalForm = new LegalForm();
           $legalForm->setLabel($legal);
           $manager->persist($legalForm);

           // create companies
           for ($i = 0; $i < 5; $i++) {
               $company = new Company();
               $company->setSiren($faker->siret)
                        ->setLegalForm($legalForm);
                $manager->persist($company);

                // create versions
                for ($j = 0; $j < mt_rand(1, 3); $j++) {
                    $version = new Version();
                    $version->setName($faker->company)
                            ->setRegistrationCity($faker->city)
                            ->setRegistrationDate($faker->dateTimeBetween('-6 months'))
                            ->setCapital(mt_rand(300000, 800000))
                            ->setCompany($company);
                    $manager->persist($version);

                    // create addresses
                    $address = new Address();
                    $address->setChannelNumber(mt_rand(1, 20))
                            ->setChannelName($faker->streetName)
                            ->setCity($faker->city)
                            ->setPostalCode($faker->randomNumber(5))
                            ->setVersion($version);
                    $manager->persist($address);
                    
                }
           }
       }
        $manager->flush();
    }



    private function getLegalForms()
    {
        return [
            'Entrepreneur individuel',
            'Groupement de droit privé non doté de la personnalité morale',
            'Indivision',
            'Indivision entre personnes physiques',
            'Indivision avec personne morale',
            'Société créée de fait',
            'Société créée de fait entre personnes physiques',
            'Société créée de fait avec personne morale',
            'Société en participation',
            'Fiducie',
        ];
    }
}
