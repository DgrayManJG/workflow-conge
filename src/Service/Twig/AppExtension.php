<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 27/06/2018
 * Time: 12:33
 */

namespace App\Service\Twig;


use App\Entity\Demande;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Extension\AbstractExtension;

class AppExtension extends AbstractExtension
{

    private $em;
    private $session;
    private $user;
    public const NB_SUMMARY_CHAR = 170;

    /**
     * AppExtension constructor.
     * @param EntityManagerInterface $manager
     * @param TokenStorageInterface $tokenStorage
     * @param SessionInterface $session
     * @internal param $em
     */
    public function __construct(EntityManagerInterface $manager,
                                TokenStorageInterface $tokenStorage,
                                SessionInterface $session)
    {

        # Récupération de Doctrine
        $this->em = $manager;

        # Récupération de la session
        $this->session = $session;

        # Récupération de l'Auteur, si un Token existe...
        if ($tokenStorage->getToken()) {
            $this->user = $tokenStorage->getToken()->getUser();
        }

    }

    public function getFilters()
    {
        return [
            new \Twig_Filter('summary', function ($text) {

                # Supprimer les balises HTML
                $string = strip_tags($text);

                # Si ma chaine est supérieur à 170...
                # Je poursuis, sinon c'est inutile
                if (strlen($string) > self::NB_SUMMARY_CHAR) {

                    # Je coupe ma chaine à 170
                    $stringCut = substr($string, 0, self::NB_SUMMARY_CHAR);

                    # Je m'assure de ne pas couper de mot
                    $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';

                }

                # On retourne l'accroche
                return $string;

            }, array('is_safe' => array('html')))
        ];
    }


    public function getFunctions()
    {
        return [
            new \Twig_Function('getCategories', function () {
                return $this->em->getRepository(Category::class)
                    ->findCategoriesHavingDemandes();
            }),
            new \Twig_Function('isUserInvited', function () {
                return $this->session->get('inviteUserModal');
            }),
            new \Twig_Function('pendingDemandes', function () {
                return $this->em->getRepository(Demande::class)
                    ->countAuthorDemandesByStatus($this->user->getId(), 'review');
            }),
            new \Twig_Function('publishedDemandes', function () {
                return $this->em->getRepository(Demande::class)
                    ->countAuthorDemandesByStatus($this->user->getId(), 'published');
            }),
            new \Twig_Function('approvalDemandes', function () {
                return $this->em->getRepository(Demande::class)
                    ->countDemandesByStatus('editor');
            }),
            new \Twig_Function('correctorDemandes', function () {
                return $this->em->getRepository(Demande::class)
                    ->countDemandesByStatus('corrector');
            }),
            new \Twig_Function('publisherDemandes', function () {
                return $this->em->getRepository(Demande::class)
                    ->countDemandesByStatus('publisher');
            })
        ];
    }

}