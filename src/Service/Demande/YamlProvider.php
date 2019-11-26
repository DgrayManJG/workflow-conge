<?php

namespace App\Service\Demande;


use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class YamlProvider
{

    private $kernel;

    /**
     * YamlProvider constructor.
     * @param $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Récupère les Demandes depuis le cache
     * et retourne un Tableau d'Demandes.
     * @return iterable
     */
    public function getDemandes(): iterable
    {
        $Demande = unserialize( file_get_contents(
            $this->kernel->getCacheDir() . '/yaml-demande.php'
        ) );

        return $Demande['data'];
    }
}