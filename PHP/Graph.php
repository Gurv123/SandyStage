<?php

header('content-type: text/html; charset=utf-8');

class Graph
{
    private $_arbre;
	private $_chaine1;
	private $_chaine2;
	private $_chaineNoeud1;
	private $_chaineNoeud2;
	private $_titre;
	
	function __construct($arbre){
		
		$this->_arbre = $arbre;
		$this->_titre = $arbre->getRacine()->getTitre();

		$this->_chaine1="[";
		$this->_chaine2="[";

		for($i=0; $i < count($this->_arbre->getRacine()->getListeFils()); $i++)
		{
			if($i!=0)
			{
				$this->_chaine1.=",'".$this->_arbre->getRacine()->getListeFils()[$i]->getId()."'";
				$this->_chaine2.=",".$this->_arbre->getRacine()->getListeFils()[$i]->getNote();
			}
			else
			{
				$this->_chaine1.="'".$this->_arbre->getRacine()->getListeFils()[$i]->getId()."'";
				$this->_chaine2.=$this->_arbre->getRacine()->getListeFils()[$i]->getNote();
			}
		}
		$this->_chaine1.="]";
		$this->_chaine2.="]";
	}	
	
	function getArbre()
	{
		return $this->_arbre;
	}
	
	function setArbre($arbre)
	{
		$this->_arbre = $arbre;
	}
	
	function getTitre()
	{
		return $this->_titre;
	}
	
	function setTitre($titre)
	{
		$this->_titre = $titre;
	}
	
	function getChaine1()
	{
		return $this->_chaine1;
	}
	
	function getChaine2()
	{
		return $this->_chaine2;
	}
	
	function getChaineNoeud1()
	{
		return $this->_chaineNoeud1;
	}
	
	function setChaineNoeud1($chaine)
	{
		$this->_chaineNoeud1 = $chaine;
	}
	
	function getChaineNoeud2()
	{
		return $this->_chaineNoeud2;
	}
	
	function setChaineNoeud2($chaine)
	{
		$this->_chaineNoeud2 = $chaine;
	}
	
	function graphNoeud($noeud)
	{
		
		$this->_chaineNoeud1="[";
		$this->_chaineNoeud2="[";

		for($i=0; $i < count($noeud->getListeFils()); $i++)
		{
			if($i!=0)
			{
				$this->_chaineNoeud1.=",'".$noeud->getListeFils()[$i]->getId()."'";
				$this->_chaineNoeud2.=",".$noeud->getListeFils()[$i]->getNote();
			}
			else
			{
				$this->_chaineNoeud1.="'".$noeud->getListeFils()[$i]->getId()."'";
				$this->_chaineNoeud2.=$noeud->getListeFils()[$i]->getNote();
			}
		}
		$this->_chaineNoeud1.="]";
		$this->_chaineNoeud2.="]";
		
		/*$listeItemsNotes[0] = $this->_chaineNoeud1;
		$listeItemsNotes[1] = $this->_chaineNoeud2;
		
		return $listeItemsNotes;*/
	}
}
