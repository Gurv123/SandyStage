<?php
header('content-type: text/html; charset=utf-8');

class Noeud
{
    private $_noeudPere;
    private $_feuille; //booleen: true si item false si catégorie
	private $_listeFils;
	private $_id; //sera donné quand le noeud sera ajouté dans l'arbre
	private $_titre;
	private $_description;
	private $_reference;
	private $_note; //sera donnée lors de la réalisation de l'audit
	
    function __construct($noeudPere, $feuille, $titre, $description, $reference)
    {
        $this->_noeudPere = $noeudPere;
        $this->_feuille = $feuille;
		$this->_listeFils = array();
		$this->_titre = $titre;
		$this->_description = $description;
		$this->_reference = $reference;
    }
	
	//retourne le noeud père
	function getPere()
	{
		return $this->_noeudPere;
	}
	
	//modifie le noeud père
	function setPere($noeud)
	{
		$this->_noeudPere = $noeud;
	}
	
	//retourne true si le noeud est un item, false sinon
	function getFeuille()
	{
		return $this->_feuille;
	}
	
	//retourne la liste de noeuds fils
	function getListeFils()
	{
		return $this->_listeFils;
	}
	
	//ajoute un noeud à la liste de fils du noeud
	function ajouterFils($noeud)
	{
		$this->_listeFils[count($this->_listeFils)] = $noeud;
	}
	
	//retourne l'id du noeud
	function getId()
	{
		return $this->_id;
	}
	
	//modifie l'id du noeud
	function setId($id)
	{
		$this->_id = $id;
	}
	
	//retourne le titre du noeud
	function getTitre()
	{
		return $this->_titre;
	}
	
	//modifie le titre du noeud
	function setTitre($titre)
	{
		$this->_titre = $titre;
	}
	
	//retourne la description du noeud
	function getDescription()
	{
		return $this->_description;
	}
	
	//modifie la description du noeud
	function setDescription($description)
	{
		$this->_description = $description;
	}
	
	//retourne l'url de la doc de reference du noeud
	function getReference()
	{
		return $this->_reference;
	}
	
	//modifie la reference du noeud
	function setReference($reference)
	{
		$this->_reference = $reference;
	}
	
	//retourne la note du noeud
	function getNote()
	{
		return $this->_note;
	}
	
	//modifie la note du noeud
	function setNote($note)
	{
		$this->_note = $note;
	}
	
	//affiche les noeuds fils du noeud
	function afficherFils()
	{
		for($i = 0; $i < count($this->getListeFils()); $i++)
			{
				echo $this->getListeFils()[$i]->getId()." ".$this->getListeFils()[$i]->getTitre()."<br>";
			}
	}
	
	//affiche le sous-arbre en dessous du noeud par chapitre ligne par ligne
	function parcoursLargeur()
	{
		$h = $this->hauteur();
		for($i = 1; $i < $h + 1; $i++)
			{
				$this->afficherNiveau($i);
			}
	}
	
	//affiche tous les noeuds du niveau
	function afficherNiveau($niveau)
	{
		if(isset($this))
		{
			if($niveau == 1)
			{
				echo $this->getId()." ".$this->getTitre()."<br>";
			}
			else
			{
				for($i = 0; $i < count($this->getListeFils()); $i++)
				{
					$this->getListeFils()[$i]->afficherNiveau($niveau - 1);
				}
			}
		}
	}
	 
	//retourne la hauteur du noeud dans l'arbre dans lequel il se trouve
	function hauteur()
	{
		if(isset($this))
		{
			if(count($this->getListeFils()) != 0){
				$hauteurs = array();
				for($i = 0; $i < count($this->getListeFils()); $i++)
				{
					$hauteurs[$i] = $this->getListeFils()[$i]->hauteur();
				}
				return 1 + max($hauteurs);
			}
			else
			{
				return 1;
			}
		}
		else
		{
			return 0;
		}
	}	
	
	//affiche le sous-arbre en dessous du noeud par chapitre
	function parcoursSommaire()
	{
		if(isset($this))
		{
			echo $this->getId()." ".$this->getTitre()."<br>";
		
			for($i = 0; $i < count($this->getListeFils()); $i++)
			{
				$this->getListeFils()[$i]->parcoursSommaire();
			}
		}
	}
	
	//affiche le sous-arbre en dessous du noeud en commençant par les plus à gauche
	function parcoursPrefixe($enTete)
	{
		if($enTete == true)
		{
			echo $this->getTitre()."<br>";
			$enTete = false;
		}
			
		if($this->getFeuille() != true && count($this->getListeFils()) != 0)
		{
			$this->afficherFils();
			for($i = 0; $i < count($this->getListeFils()); $i++)
			{
				$this->getListeFils()[$i]->parcoursPrefixe($enTete);
			}
		}
	}
	
	//calcule les notes des noeuds en fonction des notes de leurs fils et affecte la valeur au noeud
	function parcoursPostfixe()
	{
		if(!$this->getFeuille()) 
		{
			if(count($this->getListeFils()) != 0)
			{
				
				for($i = 0; $i < count($this->getListeFils()); $i++)
				{
					$this->getListeFils()[$i]->parcoursPostfixe();
					$this->calculNote();
					$this->setNote($this->calculNote());
				}
			}
			else
			{
				$this->setNote(0);
			}
		}		
	}
	
	//prend un tableau vide en paramètre et un entier initialisé à -1, stocke les indices des noeuds dans la liste
	//à partir de l'instance du noeud qui invoque cette méthode
	function getSousArbre(&$sousArbre, &$position)
	{		
		$position++;
		
		if(isset($this))
		{
			$sousArbre[$position] = $this->getId();
		
			for($i = 0; $i < count($this->getListeFils()); $i++)
			{
				$this->getListeFils()[$i]->getSousArbre($sousArbre,$position);
			}
		}
	}
	
	function calculNote()
	{
		if(count($this->_listeFils) > 0)
		{
			$note = 0;
			for($i=0; $i<count($this->_listeFils); $i++)
			{
				$note += $this->_listeFils[$i]->getNote();
			}
			return $note/count($this->_listeFils);
		}
		else
		{
			return 0;
		}			
	}
}
