<?php
class paieFournisseur implements \JsonSerializable
{

                    private $idPaieFournisseur;
                    private $nomFournisseur;
                    private $montant;
                    private $montantRester;
                    private $statut;
                    private $date;
                  


                    public function __construct($idPaieFournisseur,$nomFournisseur,$montant,$montantRester, $statut, $date)
                    {


                                        $this->idPaieFournisseur = $idPaieFournisseur;
                                        $this->nomFournisseur = $nomFournisseur;
                                        $this->montant = $montant;
                                        $this->montantRester = $montantRester;
                                        $this->statut = $statut;
                                        $this->date = $date;
                    }
                    public function getIdPaieFournisseur()
                    {
                                        return $this->idPaieFournisseur;
                    }


                    public function getNomFournisseur()
                    {
                                        return $this->nomFournisseur;
                    }

                    
                    public function getMontant()
                    {
                                        return $this->montant;
                    }



                    public function getMontantRester()
                    {
                                        return $this->montantRester;
                    }

                    public function getStatut()
                    {
                                        return $this->statut;
                    }

                    public function getDate()
                    {
                                        return $this->date;
                    }




                    public function setIdPaieFournisseur($value)
                    {
                                        $this->idPaieFournisseur = $value;
                    }



                    public function setNomFournisseur($value)
                    {
                                        $this->nomFournisseur = $value;
                    }

                    public function setMontant($value)
                    {
                                        $this->montant = $value;
                    }

                    public function setMontantRester($value)
                    {
                                        $this->montantRester = $value;
                    }


                    public function setStatut($value)
                    {
                                        $this->statut = $value;
                    }





                    public function setDate($value)
                    {
                                        $this->date = $value;
                    }


                    public function jsonSerialize()
                    {
                                        return [
                                               'idPaieFournisseur' => $this->idPaieFournisseur,
                                                'nomFournisseur' => $this->nomFournisseur,
                                                 'montant' => $this->montant,
                                                 'montantRester' => $this->montantRester,
                                                 'statut' => $this->statut,
                                                  'date' => $this->date


                                        ];
                    }
}
