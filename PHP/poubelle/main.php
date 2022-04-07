<?php /*
include ('Arbre.php');
include ('Noeud.php');

header('content-type: text/html; charset=utf-8');

$racine = new Noeud(null, false, "Audit-001", "Test premier audit", "../references/ref1.txt");

$noeud1 = new Noeud($racine, false, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud2 = new Noeud($racine, false, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud3 = new Noeud($racine, false, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud4 = new Noeud($noeud1, false, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud5 = new Noeud($noeud1, false, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud6 = new Noeud($noeud1, false, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud7 = new Noeud($noeud2, false, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud8 = new Noeud($noeud2, false, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud9 = new Noeud($noeud2, false, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud10 = new Noeud($noeud3, false, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud11 = new Noeud($noeud3, false, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud12 = new Noeud($noeud3, false, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud13 = new Noeud($noeud4, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud14 = new Noeud($noeud4, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud15 = new Noeud($noeud4, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud16 = new Noeud($noeud5, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud17 = new Noeud($noeud5, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud18 = new Noeud($noeud5, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud19 = new Noeud($noeud6, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud20 = new Noeud($noeud6, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud21 = new Noeud($noeud6, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud22 = new Noeud($noeud7, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud23 = new Noeud($noeud7, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud24 = new Noeud($noeud7, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud25 = new Noeud($noeud8, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud26 = new Noeud($noeud8, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud27 = new Noeud($noeud8, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud28 = new Noeud($noeud9, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud29 = new Noeud($noeud9, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud30 = new Noeud($noeud9, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud31 = new Noeud($noeud10, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud32 = new Noeud($noeud10, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud33 = new Noeud($noeud10, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud34 = new Noeud($noeud11, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud35 = new Noeud($noeud11, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud36 = new Noeud($noeud11, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud37 = new Noeud($noeud12, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud38 = new Noeud($noeud12, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud39 = new Noeud($noeud12, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$arbre = new Arbre($racine);
$arbre->ajouterNoeud($noeud1);
$arbre->ajouterNoeud($noeud2);
$arbre->ajouterNoeud($noeud3);
$arbre->ajouterNoeud($noeud4);
$arbre->ajouterNoeud($noeud5);
$arbre->ajouterNoeud($noeud6);
$arbre->ajouterNoeud($noeud7);
$arbre->ajouterNoeud($noeud8);
$arbre->ajouterNoeud($noeud9);
$arbre->ajouterNoeud($noeud10);
$arbre->ajouterNoeud($noeud11);
$arbre->ajouterNoeud($noeud12);
$arbre->ajouterNoeud($noeud13);
$arbre->ajouterNoeud($noeud14);
$arbre->ajouterNoeud($noeud15);
$arbre->ajouterNoeud($noeud16);
$arbre->ajouterNoeud($noeud17);
$arbre->ajouterNoeud($noeud18);
$arbre->ajouterNoeud($noeud19);
$arbre->ajouterNoeud($noeud20);
$arbre->ajouterNoeud($noeud21);
$arbre->ajouterNoeud($noeud22);
$arbre->ajouterNoeud($noeud23);
$arbre->ajouterNoeud($noeud24);
$arbre->ajouterNoeud($noeud25);
$arbre->ajouterNoeud($noeud26);
$arbre->ajouterNoeud($noeud27);
$arbre->ajouterNoeud($noeud28);
$arbre->ajouterNoeud($noeud29);
$arbre->ajouterNoeud($noeud30);
$arbre->ajouterNoeud($noeud31);
$arbre->ajouterNoeud($noeud32);
$arbre->ajouterNoeud($noeud33);
$arbre->ajouterNoeud($noeud34);
$arbre->ajouterNoeud($noeud35);
$arbre->ajouterNoeud($noeud36);
$arbre->ajouterNoeud($noeud37);
$arbre->ajouterNoeud($noeud38);
$arbre->ajouterNoeud($noeud39);

echo "Parcours en largeur<br>";
$arbre->parcoursLargeur();
echo "<br><br>";
echo "Parcours en sommaire<br>";
$arbre->parcoursSommaire();
echo "<br><br>";
echo "Parcours préfixe<br>";
$arbre->parcoursPrefixe();*/