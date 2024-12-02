<?php

class recette {
    private $idr;
    private $nomr;
    private $descriptionr;
    private $tempsr;
    private $difficulte;
   public function __construct( $idr,  $nomr, $descriptionr,$tempsr, $difficulte)
    {
        $this->idr = $idr;
        $this->nomr = $nomr;
        $this->descriptionr = $descriptionr;
        $this->tempsr = $tempsr;
        $this->difficulte= $difficulte;
    }
    
    public function getIdr()
    {
        return $this->idr;
    }
    public function setIdr($idr)
    {
        $this->idr = $idr;

        return $this;
    }
    public function getNomr()
    {
        return $this->nomr;
    }
    public function setNomr($nomr)
    {
        $this->nomr = $nomr;

        return $this;
    }
    public function getDescriptionr()
    {
        return $this->descriptionr;
    }
    public function setDescriptionr($descriptionr)
    {
        $this->descriptionr = $descriptionr;

        return $this;
    }
    public function getTempsr()
    {
        return $this->tempsr;
    }
    public function setTempsr($tempsr)
    {
        $this->tempsr = $tempsr;

        return $this;
    }
    public function getDifficulte()
    {
        return $this->difficulte;
    }
    public function setDifficulte($difficulte)
    {
        $this->difficulte = $difficulte;

        return $this;
    }




}