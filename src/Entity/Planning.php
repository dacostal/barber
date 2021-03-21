<?php

namespace App\Entity;

class Planning
{
    /**
     * Jours de la semaine
     */
    private const DAYS = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");

    /**
     * Tableau des jours de la semaine et dates associées
     * sur quatre semaines à partir du jour actuel
     * @var array
     */
    private $head;

    /**
     * Tableau des disponibilités par jour
     * sur quatre semaines à partir du jour actuel
     * @var array
     */
    private $times;

    /**
     * Planning constructor.
     */
    public function __construct()
    {
        // TODO
    }
}
