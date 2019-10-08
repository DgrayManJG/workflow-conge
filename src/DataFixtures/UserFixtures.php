<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\DataFixtures\LoadEncodePassword;

class UserFixtures extends Fixture
{
    
    private $encoder;

    /**
     * UserFactory constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $user = new User();
        $user->setFirstname("user");
        $user->setLastname("user");
        $user->setEmail("user@hotmail.fr");
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->encoder->encodePassword($user, 'user'));

        $manager->persist($user);

        $author = new User();
        $author->setFirstname("author");
        $author->setLastname("author");
        $author->setEmail("author@hotmail.fr");
        $author->setRoles(['ROLE_AUTHOR']);
        $author->setPassword($this->encoder->encodePassword($author, 'author'));

        $manager->persist($author);

        $editor = new User();
        $editor->setFirstname("editor");
        $editor->setLastname("editor");
        $editor->setEmail("editor@hotmail.fr");
        $editor->setRoles(['ROLE_EDITOR']);
        $editor->setPassword($this->encoder->encodePassword($editor, 'editor'));

        $manager->persist($editor);

        $corrector = new User();
        $corrector->setFirstname("corrector");
        $corrector->setLastname("corrector");
        $corrector->setEmail("corrector@hotmail.fr");
        $corrector->setRoles(['ROLE_CORRECTOR']);
        $corrector->setPassword($this->encoder->encodePassword($editor, 'corrector'));

        $manager->persist($corrector);

        $publisher = new User();
        $publisher->setFirstname("publisher");
        $publisher->setLastname("publisher");
        $publisher->setEmail("publisher@hotmail.fr");
        $publisher->setRoles(['ROLE_PUBLISHER']);
        $publisher->setPassword($this->encoder->encodePassword($editor, 'publisher'));

        $manager->persist($publisher);

        $admin = new User();
        $admin->setFirstname("admin");
        $admin->setLastname("admin");
        $admin->setEmail("admin@hotmail.fr");
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->encoder->encodePassword($editor, 'admin'));

        $manager->persist($admin);

        $manager->flush();
    }
}
