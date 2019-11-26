<?php

namespace App\Entity;

use App\Controller\HelperTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Demande
 *
 * @ORM\Table(name="Demande", indexes={@ORM\Index(name="IDX_23A0E66A76ED395", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\DemandeRepository")
 */
class Demande
{

    
    private static $_instance = null;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=0, nullable=false)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="featured_image", type="string", length=180, nullable=true)
     */
    private $featuredImage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_conge_debut", type="datetime", nullable=false)
     */
    private $dateCongeDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_conge_fin", type="datetime", nullable=false)
     */
    private $dateCongeFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=false)
     */
    private $createdDate;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    private $slug;

    /**
     * @var array
     *
     * @ORM\Column(name="status", type="array", length=0, nullable=false)
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="days", type="integer", nullable=false)
     */
    private $days;

    /**
     * @var int
     *
     * @ORM\Column(name="if_evenement_familial", type="boolean", nullable=true)
     */
    private $ifEvenementFamilial;

    /**
     * @var int
     *
     * @ORM\Column(name="jours_evenement_familial", type="integer", nullable=true)
     */
    private $joursEvenementFamilial;

    /**
     * @var string
     *
     * @ORM\Column(name="nature_evenement_familial", type="string", length=255, nullable=true)
     */
    private $natureEvenementFamilial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_evenement_familial", type="datetime", nullable=true)
     */
    private $dateEvenementFamilial;

    /**
     * @var int
     *
     * @ORM\Column(name="if_conge_paye", type="boolean", nullable=true)
     */
    private $ifCongePaye;

    /**
     * @var int
     *
     * @ORM\Column(name="jours_conge_paye", type="integer", nullable=true)
     */
    private $joursCongePaye;

    /**
     * @var int
     *
     * @ORM\Column(name="if_rtt", type="boolean", nullable=true)
     */
    private $ifRtt;

    /**
     * @var int
     *
     * @ORM\Column(name="janvier", type="boolean", nullable=true)
     */
    private $janvier;

    /**
     * @var int
     *
     * @ORM\Column(name="fevrier", type="boolean", nullable=true)
     */
    private $fevrier;

    /**
     * @var int
     *
     * @ORM\Column(name="mars", type="boolean", nullable=true)
     */
    private $mars;

    /**
     * @var int
     *
     * @ORM\Column(name="avril", type="boolean", nullable=true)
     */
    private $avril;

    /**
     * @var int
     *
     * @ORM\Column(name="mai", type="boolean", nullable=true)
     */
    private $mai;

    /**
     * @var int
     *
     * @ORM\Column(name="juin", type="boolean", nullable=true)
     */
    private $juin;

    /**
     * @var int
     *
     * @ORM\Column(name="juillet", type="boolean", nullable=true)
     */
    private $juillet;

    /**
     * @var int
     *
     * @ORM\Column(name="aout", type="boolean", nullable=true)
     */
    private $aout;

    /**
     * @var int
     *
     * @ORM\Column(name="septembre", type="boolean", nullable=true)
     */
    private $septembre;

    /**
     * @var int
     *
     * @ORM\Column(name="octobre", type="boolean", nullable=true)
     */
    private $octobre;

    /**
     * @var int
     *
     * @ORM\Column(name="novembre", type="boolean", nullable=true)
     */
    private $novembre;

    /**
     * @var int
     *
     * @ORM\Column(name="decembre", type="boolean", nullable=true)
     */
    private $decembre;

    /**
     * @var string
     *
     * @ORM\Column(name="mois_acquisition_rtt", type="string", length=255, nullable=true)
     */
    private $moisAcquisitionRtt;

    /**
     * @var int
     *
     * @ORM\Column(name="if_conge_sans_solde", type="boolean", nullable=true)
     */
    private $ifCongeSansSolde;

    /**
     * @var int
     *
     * @ORM\Column(name="jours_conge_sans_solde", type="integer", nullable=true)
     */
    private $joursCongeSansSolde;

    /**
     * @var int
     *
     * @ORM\Column(name="if_autre", type="boolean", nullable=true)
     */
    private $ifAutre;

    /**
     * @var int
     *
     * @ORM\Column(name="jours_autre", type="integer", nullable=true)
     */
    private $joursAutre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observation;


    /**
     * @var \DemandeManagerObservation
     *
     * @ORM\ManyToOne(targetEntity="DemandeManagerObservation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DemandeManagerObservation_id", referencedColumnName="id")
     * })
     */
    private $DemandeManagerObservation;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


    /**
     * Demande constructor.
     * @param $id
     * @param $title
     * @param $slug
     * @param $content
     * @param $featuredImage
     * @param $special
     * @param $spotlight
     * @param $createdDate
     * @param $user
     * @param $status
     */
    public function __construct($id = null, $title, $slug, $content, $featuredImage, $dateCongeDebut, $dateCongeFin, $createdDate, $user, $status, $days, $observation, 
							$ifEvenementFamilial,
							$joursEvenementFamilial,
							$natureEvenementFamilial,
							$dateEvenementFamilial,
							$ifCongePaye,
							$joursCongePaye,
							$ifRtt,
							$moisAcquisitionRtt,
							$ifCongeSansSolde,
							$joursCongeSansSolde,
							$ifAutre,
                            $joursAutre, 
                            $janvier, $fevrier, $mars, $avril, $mai, $juin, $juillet, $aout, $septembre, $octobre, $novembre, $decembre)
    {
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;
        $this->content = $content;
        $this->featuredImage = $featuredImage;
        $this->dateCongeDebut = $dateCongeDebut;
        $this->dateCongeFin = $dateCongeFin;
        $this->createdDate = new \DateTime();
        $this->user = $user;
        $this->status = $status;
        $this->days = $days;
        $this->observation = $observation;
		$this->ifEvenementFamilial = $ifEvenementFamilial;
		$this->joursEvenementFamilial = $joursEvenementFamilial;
		$this->natureEvenementFamilial = $natureEvenementFamilial;
		$this->dateEvenementFamilial = $dateEvenementFamilial;
		$this->ifCongePaye = $ifCongePaye;
		$this->joursCongePaye = $joursCongePaye;
		$this->ifRtt = $ifRtt;
		$this->moisAcquisitionRtt = $moisAcquisitionRtt;
		$this->ifCongeSansSolde = $ifCongeSansSolde;
		$this->joursCongeSansSolde = $joursCongeSansSolde;
		$this->ifAutre = $ifAutre;
        $this->joursAutre = $joursAutre;
        $this->janvier = $janvier;
        $this->fevrier = $fevrier;
        $this->mars = $mars;
        $this->avril = $avril;
        $this->mai = $mai;
        $this->juin = $juin;
        $this->juillet = $juillet;
        $this->aout = $aout;
        $this->septembre = $septembre;
        $this->octobre = $octobre;
        $this->novembre = $novembre;
        $this->decembre = $decembre;
    }

    public function update(string $title, string $slug, string $content,
                            string $featuredImage,
                            \DateTime $dateCongeDebut, \DateTime $dateCongeFin,
                            \DateTime $createdDate, int $days, string $observation,
                            bool $ifEvenementFamilial,
							int $joursEvenementFamilial,
							string $natureEvenementFamilial,
							\DateTime $dateEvenementFamilial,
							bool $ifCongePaye,
							int $joursCongePaye,
							bool $ifRtt,
							string $moisAcquisitionRtt,
							bool $ifCongeSansSolde,
							int $joursCongeSansSolde,
							bool $ifAutre,
							int $joursAutre, 
                            bool $janvier, bool $fevrier, bool $mars, bool $avril, bool $mai, bool $juin, bool $juillet, 
                            bool $aout, bool $septembre, bool $octobre, bool $novembre, bool $decembre)
    {
        $this->title            = $title;
        $this->slug             = $slug;
        $this->content          = $content;
        $this->featuredImage    = $featuredImage;
        $this->dateCongeDebut   = $dateCongeDebut;
        $this->dateCongeFin     = $dateCongeFin;
        $this->createdDate      = $createdDate;
        $this->days             = $days;
        $this->observation      = $observation;
        $this->ifEvenementFamilial = $ifEvenementFamilial;
		$this->joursEvenementFamilial = $joursEvenementFamilial;
		$this->natureEvenementFamilial = $natureEvenementFamilial;
		$this->dateEvenementFamilial = $dateEvenementFamilial;
		$this->ifCongePaye = $ifCongePaye;
		$this->joursCongePaye = $joursCongePaye;
		$this->ifRtt = $ifRtt;
		$this->moisAcquisitionRtt = $moisAcquisitionRtt;
		$this->ifCongeSansSolde = $ifCongeSansSolde;
		$this->joursCongeSansSolde = $joursCongeSansSolde;
		$this->ifAutre = $ifAutre;
        $this->joursAutre = $joursAutre;
        $this->janvier = $janvier;
        $this->fevrier = $fevrier;
        $this->mars = $mars;
        $this->avril = $avril;
        $this->mai = $mai;
        $this->juin = $juin;
        $this->juillet = $juillet;
        $this->aout = $aout;
        $this->septembre = $septembre;
        $this->octobre = $octobre;
        $this->novembre = $novembre;
        $this->decembre = $decembre;
    }

    /**
    * Méthode qui crée l'unique instance de la classe
    * si elle n'existe pas encore puis la retourne.
    */
    public static function getInstance() {

        if(is_null(self::$_instance)) {
            self::$_instance = new Singleton();  
        }

        return self::$_instance;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getFeaturedImage(): ?string
    {
        return $this->featuredImage;
    }

    public function setFeaturedImage(string $featuredImage): self
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    public function getDateCongeDebut(): ?\DateTimeInterface
    {
        return $this->dateCongeDebut;
    }

    public function setDateCongeDebut(\DateTimeInterface $dateCongeDebut): self
    {
        $this->dateCongeDebut = $dateCongeDebut;

        return $this;
    }

    public function getDateCongeFin(): ?\DateTimeInterface
    {
        return $this->dateCongeFin;
    }

    public function setDateCongeFin(\DateTimeInterface $dateCongeFin): self
    {
        $this->dateCongeFin = $dateCongeFin;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getStatus(): ?array
    {
        return $this->status;
    }

    public function setStatus(array $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDays(): ?int
    {
        return $this->days;
    }

    public function setDays(int $days): self
    {
        $this->days = $days;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getDemandeManagerObservation(): ?DemandeManagerObservation
    {
        return $this->DemandeManagerObservation;
    }

    public function setDemandeManagerObservation(?DemandeManagerObservation $DemandeManagerObservation): self
    {
        $this->DemandeManagerObservation = $DemandeManagerObservation;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
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
}
