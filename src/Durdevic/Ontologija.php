<?php

namespace Durdevic;

/**
 * @Entity @Table(name="ontologija")
 **/


class Ontologija
{
    /** @id @Column(type="integer") @GeneratedValue **/
    protected $sifra;

    /**
    * @Column(type="string")
    */
    private $knjiga;

    /**
    * @Column(type="string")
    */
    private $nakladnik;

    /**
    * @Column(type="integer")
    */
    private $objavljena;

    /**
    * @Column(type="integer")
    */
    private $imaStranica;

    /**
    * @Column(type="integer")
    */
    private $dostupnost;

    /**
    * @Column(type="integer")
    */
    private $brPosudbi;

    /**
    * @Column(type="string")
    */
    private $vrijemePosudbe;

  public function getSifra(){
		return $this->sifra;
	}

	public function setSifra($sifra){
		$this->sifra = $sifra;
	}

  public function getKnjiga(){
		return $this->knjiga;
	}

	public function setKnjiga($knjiga){
		$this->knjiga = $knjiga;
	}

  public function getNakladnik(){
    return $this->nakladnik;
  }

  public function setNakladnik($nakladnik){
		$this->nakladnik = $nakladnik;
	}

  public function getObjavljena(){
  	return $this->objavljena;
  }

  public function setObjavljena($objavljena){
		$this->objavljena = $objavljena;
	}

  public function getImaStranica(){
    return $this->imaStranica;
  }

  public function setImaStranica($imaStranica){
    $this->imaStranica = $imaStranica;
  }

  public function getDostupnost(){
    return $this->dostupnost;
  }

  public function setDostupnost($dostupnost){
    $this->dostupnost = $dostupnost;
  }

  public function getBrPosudbi(){
    return $this->brPosudbi;
  }

  public function setBrPosudbi($brPosudbi){
    $this->brPosudbi = $brPosudbi;
  }

  public function getVrijemePosudbe(){
    return $this->vrijemePosudbe;
  }

  public function setVrijemePosudbe($vrijemePosudbe){
    $this->vrijemePosudbe = $vrijemePosudbe;
  }

  public function setPodaci($podaci)
	{
		foreach($podaci as $kljuc => $vrijednost){
			$this->{$kljuc} = $vrijednost;
		}
	}

}



?>
