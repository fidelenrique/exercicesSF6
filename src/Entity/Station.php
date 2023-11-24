<?php

namespace App\Entity;

use App\Repository\StationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StationRepository::class)]
class Station
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $geoPoint = null;

    #[ORM\Column(length: 255)]
    private ?string $geoShape = null;

    #[ORM\Column(length: 255)]
    private ?string $objectid = null;

    #[ORM\Column(length: 255)]
    private ?string $idRefZdl = null;

    #[ORM\Column(length: 255)]
    private ?string $garesId = null;

    #[ORM\Column(length: 255)]
    private ?string $nomGare = null;

    #[ORM\Column(length: 255)]
    private ?string $nomlong = null;

    #[ORM\Column(length: 255)]
    private ?string $nomIv = null;

    #[ORM\Column(length: 255)]
    private ?string $numMod = null;

    #[ORM\Column(name:'mode_', length: 255)]
    private ?string $mode = null;

    #[ORM\Column(length: 255)]
    private ?string $fer = null;

    #[ORM\Column(length: 255)]
    private ?string $train = null;

    #[ORM\Column(length: 255)]
    private ?string $rer = null;

    #[ORM\Column(length: 255)]
    private ?string $metro = null;

    #[ORM\Column(length: 255)]
    private ?string $tramway = null;

    #[ORM\Column(length: 255)]
    private ?string $navette = null;

    #[ORM\Column(length: 255)]
    private ?string $val = null;

    #[ORM\Column(length: 255)]
    private ?string $terfer = null;

    #[ORM\Column(length: 255)]
    private ?string $tertrain = null;

    #[ORM\Column(length: 255)]
    private ?string $terrer = null;

    #[ORM\Column(length: 255)]
    private ?string $termetro = null;

    #[ORM\Column(length: 255)]
    private ?string $tertram = null;

    #[ORM\Column(length: 255)]
    private ?string $ternavette = null;

    #[ORM\Column(length: 255)]
    private ?string $terval = null;

    #[ORM\Column(length: 255)]
    private ?string $idrefliga = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $idrefligc = null;

    #[ORM\Column(length: 255)]
    private ?string $ligne = null;

    #[ORM\Column(length: 255)]
    private ?string $codLigf = null;

    #[ORM\Column(length: 255)]
    private ?string $ligneCode = null;

    #[ORM\Column(length: 255)]
    private ?string $indiceLig = null;

    #[ORM\Column(length: 255)]
    private ?string $reseau = null;

    #[ORM\Column(length: 255)]
    private ?string $resCom = null;

    #[ORM\Column(length: 255)]
    private ?string $codResf = null;

    #[ORM\Column(length: 255)]
    private ?string $resStif = null;

    #[ORM\Column(length: 255)]
    private ?string $exploitant = null;

    #[ORM\Column(length: 255)]
    private ?string $numPsr = null;

    #[ORM\Column(length: 255)]
    private ?string $idf = null;

    #[ORM\Column(length: 255)]
    private ?string $principal = null;

    #[ORM\Column(length: 255)]
    private ?string $x = null;

    #[ORM\Column(length: 255)]
    private ?string $y = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getGeoPoint(): ?string
    {
        return $this->geoPoint;
    }

    public function setGeoPoint(string $geoPoint): static
    {
        $this->geoPoint = $geoPoint;

        return $this;
    }

    public function getGeoShape(): ?string
    {
        return $this->geoShape;
    }

    public function setGeoShape(string $geoShape): static
    {
        $this->geoShape = $geoShape;

        return $this;
    }

    public function getObjectid(): ?string
    {
        return $this->objectid;
    }

    public function setObjectid(string $objectid): static
    {
        $this->objectid = $objectid;

        return $this;
    }

    public function getIdRefZdl(): ?string
    {
        return $this->idRefZdl;
    }

    public function setIdRefZdl(string $idRefZdl): static
    {
        $this->idRefZdl = $idRefZdl;

        return $this;
    }

    public function getGaresId(): ?string
    {
        return $this->garesId;
    }

    public function setGaresId(string $garesId): static
    {
        $this->garesId = $garesId;

        return $this;
    }

    public function getNomGare(): ?string
    {
        return $this->nomGare;
    }

    public function setNomGare(string $nomGare): static
    {
        $this->nomGare = $nomGare;

        return $this;
    }

    public function getNomlong(): ?string
    {
        return $this->nomlong;
    }

    public function setNomlong(string $nomlong): static
    {
        $this->nomlong = $nomlong;

        return $this;
    }

    public function getNomIv(): ?string
    {
        return $this->nomIv;
    }

    public function setNomIv(string $nomIv): static
    {
        $this->nomIv = $nomIv;

        return $this;
    }

    public function getNumMod(): ?string
    {
        return $this->numMod;
    }

    public function setNumMod(string $numMod): static
    {
        $this->numMod = $numMod;

        return $this;
    }

    public function getMode(): ?string
    {
        return $this->mode;
    }

    public function setMode(string $mode): static
    {
        $this->mode = $mode;

        return $this;
    }

    public function getFer(): ?string
    {
        return $this->fer;
    }

    public function setFer(string $fer): static
    {
        $this->fer = $fer;

        return $this;
    }

    public function getTrain(): ?string
    {
        return $this->train;
    }

    public function setTrain(string $train): static
    {
        $this->train = $train;

        return $this;
    }

    public function getRer(): ?string
    {
        return $this->rer;
    }

    public function setRer(string $rer): static
    {
        $this->rer = $rer;

        return $this;
    }

    public function getMetro(): ?string
    {
        return $this->metro;
    }

    public function setMetro(string $metro): static
    {
        $this->metro = $metro;

        return $this;
    }

    public function getTramway(): ?string
    {
        return $this->tramway;
    }

    public function setTramway(string $tramway): static
    {
        $this->tramway = $tramway;

        return $this;
    }

    public function getNavette(): ?string
    {
        return $this->navette;
    }

    public function setNavette(string $navette): static
    {
        $this->navette = $navette;

        return $this;
    }

    public function getVal(): ?string
    {
        return $this->val;
    }

    public function setVal(string $val): static
    {
        $this->val = $val;

        return $this;
    }

    public function getTerfer(): ?string
    {
        return $this->terfer;
    }

    public function setTerfer(string $terfer): static
    {
        $this->terfer = $terfer;

        return $this;
    }

    public function getTertrain(): ?string
    {
        return $this->tertrain;
    }

    public function setTertrain(string $tertrain): static
    {
        $this->tertrain = $tertrain;

        return $this;
    }

    public function getTerrer(): ?string
    {
        return $this->terrer;
    }

    public function setTerrer(string $terrer): static
    {
        $this->terrer = $terrer;

        return $this;
    }

    public function getTermetro(): ?string
    {
        return $this->termetro;
    }

    public function setTermetro(string $termetro): static
    {
        $this->termetro = $termetro;

        return $this;
    }

    public function getTertram(): ?string
    {
        return $this->tertram;
    }

    public function setTertram(string $tertram): static
    {
        $this->tertram = $tertram;

        return $this;
    }

    public function getTernavette(): ?string
    {
        return $this->ternavette;
    }

    public function setTernavette(string $ternavette): static
    {
        $this->ternavette = $ternavette;

        return $this;
    }

    public function getTerval(): ?string
    {
        return $this->terval;
    }

    public function setTerval(string $terval): static
    {
        $this->terval = $terval;

        return $this;
    }

    public function getIdrefliga(): ?string
    {
        return $this->idrefliga;
    }

    public function setIdrefliga(string $idrefliga): static
    {
        $this->idrefliga = $idrefliga;

        return $this;
    }

    public function getIdrefligc(): ?string
    {
        return $this->idrefligc;
    }

    public function setIdrefligc(string|null $idrefligc): static
    {
        $this->idrefligc = $idrefligc;

        return $this;
    }

    public function getLigne(): ?string
    {
        return $this->ligne;
    }

    public function setLigne(?string $ligne): static
    {
        $this->ligne = $ligne;

        return $this;
    }

    public function getCodLigf(): ?string
    {
        return $this->codLigf;
    }

    public function setCodLigf(string $codLigf): static
    {
        $this->codLigf = $codLigf;

        return $this;
    }

    public function getLigneCode(): ?string
    {
        return $this->ligneCode;
    }

    public function setLigneCode(string $ligneCode): static
    {
        $this->ligneCode = $ligneCode;

        return $this;
    }

    public function getIndiceLig(): ?string
    {
        return $this->indiceLig;
    }

    public function setIndiceLig(string $indiceLig): static
    {
        $this->indiceLig = $indiceLig;

        return $this;
    }

    public function getReseau(): ?string
    {
        return $this->reseau;
    }

    public function setReseau(string $reseau): static
    {
        $this->reseau = $reseau;

        return $this;
    }

    public function getResCom(): ?string
    {
        return $this->resCom;
    }

    public function setResCom(string $resCom): static
    {
        $this->resCom = $resCom;

        return $this;
    }

    public function getCodResf(): ?string
    {
        return $this->codResf;
    }

    public function setCodResf(string $codResf): static
    {
        $this->codResf = $codResf;

        return $this;
    }

    public function getResStif(): ?string
    {
        return $this->resStif;
    }

    public function setResStif(string $resStif): static
    {
        $this->resStif = $resStif;

        return $this;
    }

    public function getExploitant(): ?string
    {
        return $this->exploitant;
    }

    public function setExploitant(string $exploitant): static
    {
        $this->exploitant = $exploitant;

        return $this;
    }

    public function getNumPsr(): ?string
    {
        return $this->numPsr;
    }

    public function setNumPsr(string $numPsr): static
    {
        $this->numPsr = $numPsr;

        return $this;
    }

    public function getIdf(): ?string
    {
        return $this->idf;
    }

    public function setIdf(string $idf): static
    {
        $this->idf = $idf;

        return $this;
    }

    public function getPrincipal(): ?string
    {
        return $this->principal;
    }

    public function setPrincipal(string $principal): static
    {
        $this->principal = $principal;

        return $this;
    }

    public function getX(): ?string
    {
        return $this->x;
    }

    public function setX(string $x): static
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?string
    {
        return $this->y;
    }

    public function setY(string $y): static
    {
        $this->y = $y;

        return $this;
    }
}
