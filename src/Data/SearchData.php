<?php

namespace App\Data;






use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class SearchData
{
    /**
     * @var DateTime|null
     * @Assert\GreaterThan("today",
     *     message="La date debut ne doit pas être anterieure à la date d'aujourd'hui ")
     */
private $debut;


    /**
     * @var DateTime|null
     * @Assert\Type("DateTime")
     * @Assert\Expression("value > this.getDebut()",
     *     message="La date fin ne doit pas être antérieure à la date début")
     *
     */

private $fin;



    /**
     * @return DateTime|null
     */
    public function getDebut(): ?DateTime
    {
        return $this->debut;
    }

    /**
     * @param DateTime|null $debut
     */
    public function setDebut(?DateTime $debut): void
    {
        $this->debut = $debut;
    }

    /**
     * @return DateTime|null
     */
    public function getFin(): ?DateTime
    {
        return $this->fin;
    }

    /**
     * @param DateTime|null $fin
     */
    public function setFin(?DateTime $fin): void
    {
        $this->fin = $fin;
    }





}