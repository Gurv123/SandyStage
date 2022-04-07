<?php

header('content-type: text/html; charset=utf-8');

class Arbre
{
    private $_racine;
    private $_taille;

    function __construct($racine)
    {
        $this->_racine = $racine;
        $this->_taille = 1;
    }
	
	//retourne la racine
	function getRacine()
	{
		return $this->_racine;
	}
	
	//modifie la racine
	function setRacine($racine)
	{
		$this->_racine = $racine;
	}
	
	//retourne la taille
	function geTaille()
	{
		return $this->_taille;
	}
	
	//ajoute un noeud à l'arbre
	function ajouterNoeud($noeud)
	{
		//donner un id au noeud racine
		if($noeud->getPere()->getId() == "")
		{
			$noeud->setId(count($noeud->getPere()->getListeFils())+1);
		}
		else
		{
			//donner un id au noeud
			$indice = count($noeud->getPere()->getListeFils())+1;
			$noeud->setId($noeud->getPere()->getId()."-$indice");
		}
		//ajouter le noeud dans l'arbre en liant deux noeuds père et fils
		$noeud->getPere()->ajouterFils($noeud);
		$this->_taille += 1;
	}	
	
	//affiche l'arbre niveau par niveau
	function parcoursLargeur()
	{
		$this->_racine->parcoursLargeur();
	}
	
	//affiche l'arbre par chapitre
	function parcoursSommaire()
	{
		$this->_racine->parcoursSommaire();
	}
	
	//affiche l'arbre en parcours préfixe
	function parcoursPrefixe()
	{
		$this->_racine->parcoursPrefixe(true);
	}
	
	//c
	/*function parcoursPostfixe()
	{
		$this->_racine->parcoursPrefixe(true);
	}*/
}
