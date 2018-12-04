<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Logement
 *
 * @ORM\Table(name="logement", indexes={@ORM\Index(name="fk_logement_type_idx", columns={"type_id"}), @ORM\Index(name="fk_logement_quartier1_idx", columns={"quartier_id"}), @ORM\Index(name="fk_logement_utilisateur1_idx", columns={"utilisateur_id"})})
 * @ORM\Entity
 */
class Logement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="surface", type="integer", nullable=false)
     */
    private $surface;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_chambres", type="integer", nullable=false)
     */
    private $nbChambres;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=false)
     */
    private $dateCreation;

    /**
     * @var Quartier
     *
     * @ORM\ManyToOne(targetEntity="Quartier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="quartier_id", referencedColumnName="id")
     * })
     */
    private $quartier;

    /**
     * @var Tipe
     *
     * @ORM\ManyToOne(targetEntity="Tipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;

    /**
     * @var Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     * })
     */
    private $utilisateur;

    /**
     * @var Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Commercial", inversedBy="logement")
     * @ORM\JoinTable(name="logement_has_commercial",
     *   joinColumns={
     *     @ORM\JoinColumn(name="logement_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="commercial_id", referencedColumnName="id")
     *   }
     * )
     */
    private $commercial;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commercial = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getNbChambres(): ?int
    {
        return $this->nbChambres;
    }

    public function setNbChambres(int $nbChambres): self
    {
        $this->nbChambres = $nbChambres;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getQuartier(): ?Quartier
    {
        return $this->quartier;
    }

    public function setQuartier(?Quartier $quartier): self
    {
        $this->quartier = $quartier;

        return $this;
    }

    public function getType(): ?Tipe
    {
        return $this->type;
    }

    public function setType(?Tipe $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * @return Collection|Commercial[]
     */
    public function getCommercial(): Collection
    {
        return $this->commercial;
    }

    public function addCommercial(Commercial $commercial): self
    {
        if (!$this->commercial->contains($commercial)) {
            $this->commercial[] = $commercial;
        }

        return $this;
    }

    public function removeCommercial(Commercial $commercial): self
    {
        if ($this->commercial->contains($commercial)) {
            $this->commercial->removeElement($commercial);
        }

        return $this;
    }

}
