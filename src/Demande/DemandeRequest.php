<?php

namespace App\Demande;


use App\Entity\Demande;
use App\Entity\User;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

class DemandeRequest
{

    private $id;

    /**
     * @Assert\NotBlank(message="asserts.Demande.title.notblank")
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Votre titre est trop long. Pas plus de {{ limit }} caractères."
     * )
     */
    private $title;
    private $slug;

    /**
     * @Assert\NotBlank(message="asserts.Demande.content.notblank")
     */
    private $content;

    /**
     * @Assert\File(
     *     maxSize = "2048k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     */
    private $featuredImage;
    private $imageUrl;
    private $createdDate;
    private $dateCongeDebut;
    private $dateCongeFin;

    /**
     * @Assert\NotBlank(message="asserts.Demande.content.notblank")
     */
    private $days;
    private $observation;

    private $ifEvenementFamilial;
    private $joursEvenementFamilial;
    private $natureEvenementFamilial;
    private $dateEvenementFamilial;
    private $ifCongePaye;
    private $joursCongePaye;
    private $ifRtt;
    private $moisAcquisitionRtt;
    private $ifCongeSansSolde;
    private $joursCongeSansSolde;
    private $ifAutre;
    private $joursAutre;
    private $janvier;
    private $fevrier;
    private $mars;
    private $avril;
    private $mai;
    private $juin;
    private $juillet;
    private $aout;
    private $septembre;
    private $octobre;
    private $novembre;
    private $decembre;

    private $user;
    private $status;

    /**
     * DemandeRequest constructor.
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->createdDate = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getFeaturedImage()
    {
        return $this->featuredImage;
    }

    /**
     * @param mixed $featuredImage
     */
    public function setFeaturedImage($featuredImage)
    {
        $this->featuredImage = $featuredImage;
    }



    /**
     * @return mixed
     */
    public function getDateCongeDebut()
    {
        return $this->dateCongeDebut;
    }

    /**
     * @param mixed $dateCongeDebut
     */
    public function setDateCongeDebut($dateCongeDebut)
    {
        $this->dateCongeDebut = $dateCongeDebut;
    }

    /**
     * @return mixed
     */
    public function getDateCongeFin()
    {
        return $this->dateCongeFin;
    }

    /**
     * @param mixed $dateCongeFin
     */
    public function setDateCongeFin($dateCongeFin)
    {
        $this->dateCongeFin = $dateCongeFin;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param mixed $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    /**
     * @return mixed
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @param mixed $days
     */
    public function setDays($days)
    {
        $this->days = $days;
    }

    /**
     * @return mixed
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * @param mixed $observation
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;
    }

    /**
     * Get the value of ifEvenementFamilial
     *
     * @return  int
     */ 
    public function getIfEvenementFamilial()
    {
        return $this->ifEvenementFamilial;
    }

    /**
     * Set the value of ifEvenementFamilial
     *
     * @param  int  $ifEvenementFamilial
     *
     * @return  self
     */ 
    public function setIfEvenementFamilial(int $ifEvenementFamilial)
    {
        $this->ifEvenementFamilial = $ifEvenementFamilial;

        return $this;
    }

    /**
     * Get the value of joursEvenementFamilial
     *
     * @return  int
     */ 
    public function getJoursEvenementFamilial()
    {
        return $this->joursEvenementFamilial;
    }

    /**
     * Set the value of joursEvenementFamilial
     *
     * @param  int  $joursEvenementFamilial
     *
     * @return  self
     */ 
    public function setJoursEvenementFamilial(int $joursEvenementFamilial)
    {
        $this->joursEvenementFamilial = $joursEvenementFamilial;

        return $this;
    }

    /**
     * Get the value of natureEvenementFamilial
     *
     * @return  string
     */ 
    public function getNatureEvenementFamilial()
    {
        return $this->natureEvenementFamilial;
    }

    /**
     * Set the value of natureEvenementFamilial
     *
     * @param  string  $natureEvenementFamilial
     *
     * @return  self
     */ 
    public function setNatureEvenementFamilial(string $natureEvenementFamilial)
    {
        $this->natureEvenementFamilial = $natureEvenementFamilial;

        return $this;
    }

    /**
     * Get the value of dateEvenementFamilial
     *
     * @return  \DateTime
     */ 
    public function getDateEvenementFamilial()
    {
        return $this->dateEvenementFamilial;
    }

    /**
     * Set the value of dateEvenementFamilial
     *
     * @param  \DateTime  $dateEvenementFamilial
     *
     * @return  self
     */ 
    public function setDateEvenementFamilial(\DateTime $dateEvenementFamilial)
    {
        $this->dateEvenementFamilial = $dateEvenementFamilial;

        return $this;
    }

    /**
     * Get the value of ifCongePaye
     *
     * @return  int
     */ 
    public function getIfCongePaye()
    {
        return $this->ifCongePaye;
    }

    /**
     * Set the value of ifCongePaye
     *
     * @param  int  $ifCongePaye
     *
     * @return  self
     */ 
    public function setIfCongePaye(int $ifCongePaye)
    {
        $this->ifCongePaye = $ifCongePaye;

        return $this;
    }

    /**
     * Get the value of joursCongePaye
     *
     * @return  int
     */ 
    public function getJoursCongePaye()
    {
        return $this->joursCongePaye;
    }

    /**
     * Set the value of joursCongePaye
     *
     * @param  int  $joursCongePaye
     *
     * @return  self
     */ 
    public function setJoursCongePaye(int $joursCongePaye)
    {
        $this->joursCongePaye = $joursCongePaye;

        return $this;
    }

    /**
     * Get the value of ifRtt
     *
     * @return  int
     */ 
    public function getIfRtt()
    {
        return $this->ifRtt;
    }

    /**
     * Set the value of ifRtt
     *
     * @param  int  $ifRtt
     *
     * @return  self
     */ 
    public function setIfRtt(int $ifRtt)
    {
        $this->ifRtt = $ifRtt;

        return $this;
    }

    /**
     * Get the value of moisAcquisitionRtt
     *
     * @return  string
     */ 
    public function getMoisAcquisitionRtt()
    {
        return $this->moisAcquisitionRtt;
    }

    /**
     * Set the value of moisAcquisitionRtt
     *
     * @param  string  $moisAcquisitionRtt
     *
     * @return  self
     */ 
    public function setMoisAcquisitionRtt(string $moisAcquisitionRtt)
    {
        $this->moisAcquisitionRtt = $moisAcquisitionRtt;

        return $this;
    }

    /**
     * Get the value of ifCongeSansSolde
     *
     * @return  int
     */ 
    public function getIfCongeSansSolde()
    {
        return $this->ifCongeSansSolde;
    }

    /**
     * Set the value of ifCongeSansSolde
     *
     * @param  int  $ifCongeSansSolde
     *
     * @return  self
     */ 
    public function setIfCongeSansSolde(int $ifCongeSansSolde)
    {
        $this->ifCongeSansSolde = $ifCongeSansSolde;

        return $this;
    }

    /**
     * Get the value of joursCongeSansSolde
     *
     * @return  int
     */ 
    public function getJoursCongeSansSolde()
    {
        return $this->joursCongeSansSolde;
    }

    /**
     * Set the value of joursCongeSansSolde
     *
     * @param  int  $joursCongeSansSolde
     *
     * @return  self
     */ 
    public function setJoursCongeSansSolde(int $joursCongeSansSolde)
    {
        $this->joursCongeSansSolde = $joursCongeSansSolde;

        return $this;
    }

    /**
     * Get the value of ifAutre
     *
     * @return  int
     */ 
    public function getIfAutre()
    {
        return $this->ifAutre;
    }

    /**
     * Set the value of ifAutre
     *
     * @param  int  $ifAutre
     *
     * @return  self
     */ 
    public function setIfAutre(int $ifAutre)
    {
        $this->ifAutre = $ifAutre;

        return $this;
    }

    /**
     * Get the value of joursAutre
     *
     * @return  int
     */ 
    public function getJoursAutre()
    {
        return $this->joursAutre;
    }

    /**
     * Set the value of joursAutre
     *
     * @param  int  $joursAutre
     *
     * @return  self
     */ 
    public function setJoursAutre(int $joursAutre)
    {
        $this->joursAutre = $joursAutre;

        return $this;
    }


    /**
     * Get the value of janvier
     *
     * @return  int
     */ 
    public function getJanvier()
    {
        return $this->janvier;
    }

    /**
     * Set the value of janvier
     *
     * @param  int  $janvier
     *
     * @return  self
     */ 
    public function setJanvier(int $janvier)
    {
        $this->janvier = $janvier;

        return $this;
    }

    /**
     * Get the value of fevrier
     *
     * @return  int
     */ 
    public function getFevrier()
    {
        return $this->fevrier;
    }

    /**
     * Set the value of fevrier
     *
     * @param  int  $fevrier
     *
     * @return  self
     */ 
    public function setFevrier(int $fevrier)
    {
        $this->fevrier = $fevrier;

        return $this;
    }

    /**
     * Get the value of mars
     *
     * @return  int
     */ 
    public function getMars()
    {
        return $this->mars;
    }

    /**
     * Set the value of mars
     *
     * @param  int  $mars
     *
     * @return  self
     */ 
    public function setMars(int $mars)
    {
        $this->mars = $mars;

        return $this;
    }

    /**
     * Get the value of avril
     *
     * @return  int
     */ 
    public function getAvril()
    {
        return $this->avril;
    }

    /**
     * Set the value of avril
     *
     * @param  int  $avril
     *
     * @return  self
     */ 
    public function setAvril(int $avril)
    {
        $this->avril = $avril;

        return $this;
    }

    /**
     * Get the value of mai
     *
     * @return  int
     */ 
    public function getMai()
    {
        return $this->mai;
    }

    /**
     * Set the value of mai
     *
     * @param  int  $mai
     *
     * @return  self
     */ 
    public function setMai(int $mai)
    {
        $this->mai = $mai;

        return $this;
    }

    /**
     * Get the value of juin
     *
     * @return  int
     */ 
    public function getJuin()
    {
        return $this->juin;
    }

    /**
     * Set the value of juin
     *
     * @param  int  $juin
     *
     * @return  self
     */ 
    public function setJuin(int $juin)
    {
        $this->juin = $juin;

        return $this;
    }

    /**
     * Get the value of juillet
     *
     * @return  int
     */ 
    public function getJuillet()
    {
        return $this->juillet;
    }

    /**
     * Set the value of juillet
     *
     * @param  int  $juillet
     *
     * @return  self
     */ 
    public function setJuillet(int $juillet)
    {
        $this->juillet = $juillet;

        return $this;
    }

    /**
     * Get the value of aout
     *
     * @return  int
     */ 
    public function getAout()
    {
        return $this->aout;
    }

    /**
     * Set the value of aout
     *
     * @param  int  $aout
     *
     * @return  self
     */ 
    public function setAout(int $aout)
    {
        $this->aout = $aout;

        return $this;
    }

    /**
     * Get the value of septembre
     *
     * @return  int
     */ 
    public function getSeptembre()
    {
        return $this->septembre;
    }

    /**
     * Set the value of septembre
     *
     * @param  int  $septembre
     *
     * @return  self
     */ 
    public function setSeptembre(int $septembre)
    {
        $this->septembre = $septembre;

        return $this;
    }

    /**
     * Get the value of octobre
     *
     * @return  int
     */ 
    public function getOctobre()
    {
        return $this->octobre;
    }

    /**
     * Set the value of octobre
     *
     * @param  int  $octobre
     *
     * @return  self
     */ 
    public function setOctobre(int $octobre)
    {
        $this->octobre = $octobre;

        return $this;
    }

    /**
     * Get the value of novembre
     *
     * @return  int
     */ 
    public function getNovembre()
    {
        return $this->novembre;
    }

    /**
     * Set the value of novembre
     *
     * @param  int  $novembre
     *
     * @return  self
     */ 
    public function setNovembre(int $novembre)
    {
        $this->novembre = $novembre;

        return $this;
    }

    /**
     * Get the value of decembre
     *
     * @return  int
     */ 
    public function getDecembre()
    {
        return $this->decembre;
    }

    /**
     * Set the value of decembre
     *
     * @param  int  $decembre
     *
     * @return  self
     */ 
    public function setDecembre(int $decembre)
    {
        $this->decembre = $decembre;

        return $this;
    }

    /**
     * Créer un DemandeRequest depuis un Demande de Entity
     * @param Demande $Demande
     * @param Packages $packages
     * @param string $assetsDirectory
     * @return DemandeRequest
     * @internal param Package|Packages $package
     * @internal param $assetsDirectory
     * @internal param Package $package
     */
    public static function createFromDemande(Demande $Demande, Packages $packages, string $assetsDirectory): self
    {
        $ar = new self($Demande->getUser());
        $ar->id = $Demande->getId();
        $ar->title = $Demande->getTitle();
        $ar->slug = $Demande->getSlug();
        $ar->content = $Demande->getContent();
        $ar->featuredImage = new File($assetsDirectory . '/' . $Demande->getFeaturedImage());
        $ar->imageUrl = $packages->getUrl('images/product/'. $Demande->getFeaturedImage());
        $ar->dateCongeDebut = $Demande->getDateCongeDebut()();
        $ar->dateCongeFin = $Demande->getDateCongeFin();
        $ar->createdDate = $Demande->getCreatedDate();
        $ar->days = $Demande->getDays();
        $ar->observations = $Demande->getObservation();
        $ar->ifEvenementFamilial = $Demande->getIfEvenementFamilial();
        $ar->joursEvenementFamilial = $Demande->getJoursEvenementFamilial();
        $ar->natureEvenementFamilial = $Demande->getNatureEvenementFamilial();
        $ar->dateEvenementFamilial = $Demande->getDateEvenementFamilial();
        $ar->ifCongePaye = $Demande->getIfCongePaye();
        $ar->joursCongePaye = $Demande->getJoursCongePaye();
        $ar->ifRtt = $Demande->getIfRtt();
        $ar->moisAcquisitionRtt = $Demande->getMoisAcquisitionRtt();
        $ar->ifCongeSansSolde = $Demande->getIfCongeSansSolde();
        $ar->joursCongeSansSolde = $Demande->getJoursCongeSansSolde();
        $ar->ifAutre = $Demande->getIfAutre();
        $ar->joursAutre = $Demande->getJoursAutre();
        $ar->janvier = $Demande->getJanvier();
        $ar->fevrier = $Demande->getFevrier();
        $ar->mars = $Demande->getMars();
        $ar->avril = $Demande->getAvril();
        $ar->mai = $Demande->getMai();
        $ar->juin = $Demande->getJuin();
        $ar->juillet = $Demande->geJuillet();
        $ar->aout = $Demande->getAout();
        $ar->septembre = $Demande->getSeptembre();
        $ar->octobre = $Demande->getOctobre();
        $ar->novembre = $Demande->getNovembre();
        $ar->decembre = $Demande->getDecembre();

        return $ar;
    }
}