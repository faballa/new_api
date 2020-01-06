<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
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
        $role= new Role();
        $role-> setLibelle("SuperAdmin");

        $manager->persist($role);


        $user = new User("SuperAdmin");
        $user->setPassword($this->encoder->encodePassword($user, "SuperAdmin"));
        $user->setRoles((array("ROLE_SuperAdmin")));
        $user->setRole($role);
        $user->setEmail("wadjfatouballa@gmail.com");
       # $user->setUsername("bosslady");
        $user->setPrenom("faballa");
        $user-> setNom("wadj");

        $manager->persist($user);
        $manager->flush();
    }
}
