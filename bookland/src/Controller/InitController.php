<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Genre;
use App\Entity\Auteur;
use App\Entity\Livre;

class InitController extends AbstractController
{

    public function init() {
        $entityManager = $this->getDoctrine()->getManager();

        $genre1 = new Genre;
        $genre1->setNom('science fiction');
        $entityManager->persist($genre1);

        $genre2 = new Genre;
        $genre2->setNom('policier');
        $entityManager->persist($genre2);

        $genre3 = new Genre;
        $genre3->setNom('philosophie');
        $entityManager->persist($genre3);

        $genre4 = new Genre;
        $genre4->setNom('économie');
        $entityManager->persist($genre4);

        $genre5 = new Genre;
        $genre5->setNom('psychologie');
        $entityManager->persist($genre5);

        $auteur1 = new Auteur;
        $auteur1->setNomPrenom('Richard Thaler');
        $auteur1->setSexe('M');
        $auteur1->setDateDeNaissance(date_create('12/12/1945'));
        $auteur1->setNationalite('USA');
        $entityManager->persist($auteur1);

        $auteur2 = new Auteur;
        $auteur2->setNomPrenom('Cass Sunstein');
        $auteur2->setSexe('M');
        $auteur2->setDateDeNaissance(date_create('23/11/1943'));
        $auteur2->setNationalite('allemagne');
        $entityManager->persist($auteur2);

        $auteur3 = new Auteur;
        $auteur3->setNomPrenom('Francis Gabrelot');
        $auteur3->setSexe('M');
        $auteur3->setDateDeNaissance(date_create('29/01/1967'));
        $auteur3->setNationalite('france');
        $entityManager->persist($auteur3);

        $auteur4 = new Auteur;
        $auteur4->setNomPrenom('Ayn Rand');
        $auteur4->setSexe('F');
        $auteur4->setDateDeNaissance(date_create('21/06/1950'));
        $auteur4->setNationalite('russie');
        $entityManager->persist($auteur4);

        $auteur5 = new Auteur;
        $auteur5->setNomPrenom('Duschmol');
        $auteur5->setSexe('M');
        $auteur5->setDateDeNaissance(date_create('23/12/2001'));
        $auteur5->setNationalite('groland');
        $entityManager->persist($auteur5);

        $auteur6 = new Auteur;
        $auteur6->setNomPrenom('Nancy Grave');
        $auteur6->setSexe('F');
        $auteur6->setDateDeNaissance(date_create('24/10/1952'));
        $auteur6->setNationalite('USA');
        $entityManager->persist($auteur6);

        $auteur7 = new Auteur;
        $auteur7->setNomPrenom('James Enckling');
        $auteur7->setSexe('M');
        $auteur7->setDateDeNaissance(date_create('03/07/1970'));
        $auteur7->setNationalite('USA');
        $entityManager->persist($auteur7);

        $auteur8 = new Auteur;
        $auteur8->setNomPrenom('Jean Dupont');
        $auteur8->setSexe('M');
        $auteur8->setDateDeNaissance(date_create('03/07/1970'));
        $auteur8->setNationalite('france');
        $entityManager->persist($auteur8);

        $livre1 = new Livre;
        $livre1->setTitre('Symfonystique');
        $livre1->setIbsn('978-2-07-036822-8');
        $livre1->setNbpages('117');
        $livre1->setDateDeParution(date_create('20/01/2008'));
        $livre1->setNote('8');
        $livre1->addGenre('policier');
        $livre1->addGenre('philosophie');
        $livre1->addAuteur('Francis Gabrelot');
        $livre1->addAuteur('Ayn Rand');
        $livre1->addAuteur('Nancy Grave');
        $entityManager->persist($livre1);

        $livre2 = new Livre;
        $livre2->setTitre('La grève');
        $livre2->setIbsn('978-2-251-44417-8');
        $livre2->setNbpages('1245');
        $livre2->setDateDeParution(date_create('12/06/1961'));
        $livre2->setNote('19');
        $livre2->addGenre('philosophie');
        $livre2->addAuteur('Ayn Rand');
        $livre2->addAuteur('James Enckling');
        $entityManager->persist($livre2);

        $livre3 = new Livre;
        $livre3->setTitre('Symfonyland');
        $livre3->setIbsn('978-2-212-55652-0');
        $livre3->setNbpages('131');
        $livre3->setDateDeParution(date_create('17/09/1980'));
        $livre3->setNote('15');
        $livre3->addGenre('science fiction');
        $livre3->addAuteur('Jean Dupont');
        $livre3->addAuteur('James Enckling');
        $livre3->addAuteur('Ayn Rand');
        $entityManager->persist($livre3);

        $livre4 = new Livre;
        $livre4->setTitre('Négociation Complexe');
        $livre4->setIbsn('978-2-0807-1057-4');
        $livre4->setNbpages('234');
        $livre4->setDateDeParution(date_create('25/09/1992'));
        $livre4->setNote('16');
        $livre4->addGenre('psychologie');
        $livre4->addAuteur('Richard Thaler');
        $livre4->addAuteur('Cass Sunstein');
        $entityManager->persist($livre4);

        $livre5 = new Livre;
        $livre5->setTitre('Ma vie');
        $livre5->setIbsn('978-0-300-12223-7');
        $livre5->setNbpages('5');
        $livre5->setDateDeParution(date_create('08/11/2021'));
        $livre5->setNote('03');
        $livre5->addGenre('policier');
        $livre5->addAuteur('Jean Dupont');
        $entityManager->persist($livre5);

        $livre6 = new Livre;
        $livre6->setTitre('Ma vie : suite');
        $livre6->setIbsn('978-0-141-18776-1');
        $livre6->setNbpages('5');
        $livre6->setDateDeParution(date_create('09/11/2021'));
        $livre6->setNote('01');
        $livre6->addGenre('policier');
        $livre6->addAuteur('Jean Dupont');
        $entityManager->persist($livre6);

        $livre7 = new Livre;
        $livre7->setTitre('Le monde comme volonté et comme représentation');
        $livre7->setIbsn('978-0-141-18786-0');
        $livre7->setNbpages('1987');
        $livre7->setDateDeParution(date_create('09/11/1821'));
        $livre7->setNote('19');
        $livre7->addGenre('philosophie');
        $livre7->addAuteur('Nancy Grave');
        $livre7->addAuteur('Francis Gabrelot');
        $entityManager->persist($livre7);

        $entityManager->flush();
        return new Response('<html><body>Initialisation accomplie.</body></html>');
    }

}
