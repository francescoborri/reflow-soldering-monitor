<?php

namespace App\DataFixtures;

use App\Entity\Branch;
use App\Entity\Office;
use App\Entity\Staff;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $branch = new Branch();
        $branch->setName('Headquarters');
        $branch->setAddress('Via Roma 1');
        $branch->setCity('Arezzo');
        $branch->setPostalCode('52100');

        $office = new Office();
        $office->setFloor(1);
        $office->setRoom(1);
        $office->setBranch($branch);

        $staff = new Staff();
        $staff->setFiscalCode('BRRFNC02L23A390H');
        $staff->setPassword($this->encoder->encodePassword($staff, '1234'));
        $staff->setName('Francesco');
        $staff->setSurname('Borri');
        $staff->setEmail('francesco.borri02@gmail.com');
        $staff->setPhone('3397772319');
        $staff->setBirthDate(new \DateTime('2002-07-23'));
        $staff->setAddress('Via Campanacci 35');
        $staff->setPostalCode('52100');
        $staff->setPosition('IT techinician');
        $staff->setSalary(2000);
        $staff->setOffice($office);

        $manager->persist($branch);
        $manager->persist($office);
        $manager->persist($staff);
        $manager->flush();
    }
}
