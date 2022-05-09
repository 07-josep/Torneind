<?php

namespace App\DataFixtures;

use App\Entity\Modalidad;
use App\Entity\Torneo;
use App\Entity\Usuario;
use App\Entity\Plataforma;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;
    private Generator $faker;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $modalidadesBase =["Solitario","Duos","Trios","Escuadrones","MTL"];
        $modalidades = [];
        // Generes
        for ($i=0; $i<5; $i++ ) {
            $modalidad = new Modalidad();
            $modalidad->setModalidad($modalidadesBase[$i]);
            $manager->persist($modalidad);
            $modalidades[] = $modalidad;
        }
        $manager->flush();

        $plataformaBase =["PS4/PS5","XBOX","PC","Nintendo Switch","Android","todas"];
        $plataformas = [];
        // Generes
        for ($i=0; $i<6; $i++ ) {
            $plataforma = new Plataforma();
            $plataforma->setPlataforma($plataformaBase[$i]);
            $manager->persist($plataforma);
            $plataformas[] = $plataforma;
        }
        $manager->flush();

        // Usuari amb rol d'administrador
        $user = new Usuario();
        $user->setNombre('admin');
        $user->setCorreo('admin@gmail.com');
        $password = $this->hasher->hashPassword($user, 'admin');
        $user->setContrasenya($password);
        $user->setFoto($this->faker->file('assets', 'public/fotos-web/fixtures', false));
        $user->setRole("ROLE_ADMIN");
        $manager->persist($user);

        $users[] = $user;

        // Usuari amb rol normal
        $user = new Usuario();
        $user->setNombre('user');
        $user->setCorreo('user@gmail.com');
        $password = $this->hasher->hashPassword($user, 'user');
        $user->setContrasenya($password);
        $user->setFoto($this->faker->file('assets', 'public/fotos-web/fixtures', false));
        $user->setRole("ROLE_USER");
        $manager->persist($user);
//        $users[] = $user;

        // Torneos
        for ($i=0; $i<10; $i++ ) {
            $torneo = new Torneo();
            $torneo->setUsuario($users[\array_rand($users)]);
            $torneo->setNombre(ucwords($this->faker->words(3, true)));
            $torneo->setDescripcion($this->faker->text(200));
            $torneo->setModalidad($modalidades[\array_rand($modalidades)]);
            $torneo->setPlataforma($plataformas[\array_rand($plataformas)]);
            $torneo->setFecha($this->faker->dateTimeBetween('-1 week', '+2 week'));
            $torneo->setImagen($this->faker->file('assets', 'public/fotos-web/fixtures', false));
            $manager->persist($torneo);
        }
        $manager->flush();
    }
}
