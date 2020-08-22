<?php
require 'vendor/autoload.php';
require 'bootstrap.php';
use Durdevic\Ontologija;
use Composer\Autoload\ClassLoader;

Flight::route('/', function(){
  $foaf = \EasyRdf\Graph::newAndLoad('http://oziz.ffos.hr/nastava20192020/kdurdevic_19/ontologija/rdf_durdevic/datasetDurdevic_ver3.rdf');
  echo $foaf->dump();
});

Flight::route('GET /search', function(){

  $doctrineBootstrap = Flight::entityManager();
  $em = $doctrineBootstrap->getEntityManager();
  $repozitorij=$em->getRepository('Durdevic\Ontologija');
  $zapisi = $repozitorij->findAll();
  echo $doctrineBootstrap->getJson($zapisi);
});


Flight::route('GET /tablica', function(){

  $foaf = \EasyRdf\Graph::newAndLoad('http://oziz.ffos.hr/nastava20192020/kdurdevic_19/ontologija/rdf_durdevic/datasetDurdevic_ver3.rdf');


  foreach ($foaf->resources() as $resource) {

    if($foaf->get($resource, 'rdf:type') != ''){
      $i = 0;
      $url = parse_url($foaf->get($resource, '<http://oziz.ffos.hr/kdjurdjevic/dk-ontologija#Knjiga>'));
      $knjiga = str_replace('_', ' ', $url["fragment"]);
      $url = parse_url($foaf->get($resource, '<http://oziz.ffos.hr/kdjurdjevic/dk-ontologija#Nakladnik>'));
      $nakladnik = str_replace('_', ' ', $url["fragment"]);
      $dostupnost = ''.$foaf->get($resource, '<http://oziz.ffos.hr/tsw2/kdjurdjevic/posudba#dostupnost>');
      $objavljena = ''.$foaf->get($resource, '<http://oziz.ffos.hr/aboras/ak-ontologija#jeObjavljena>') . ' god.';
      $imaStranica = ''.$foaf->get($resource, '<http://oziz.ffos.hr/kdjurdjevic/dk-ontologija#imaStranica>');
      $brPosudbi = ''.$foaf->get($resource, '<http://oziz.ffos.hr/tsw2/kdjurdjevic/posudba#br_posudbe>');
      $vrijemePosudbe = $foaf->get($resource, '<http://oziz.ffos.hr/tsw2/kdjurdjevic/posudba#vrijemePosudbe>');

      $ontologija = new Ontologija();
      $ontologija->setPodaci(Flight::request()->data);

      $ontologija->setKnjiga($knjiga);
      $ontologija->setNakladnik($nakladnik);
      $ontologija->setDostupnost($dostupnost);
      $ontologija->setObjavljena($objavljena);
      $ontologija->setImaStranica($imaStranica);
      $ontologija->setBrPosudbi($brPosudbi);
      $ontologija->setVrijemePosudbe($vrijemePosudbe);

      $doctrineBootstrap = Flight::entityManager();
      $em = $doctrineBootstrap->getEntityManager();

      $em->persist($ontologija);
      $em->flush();
      }
    }

  echo "Uspješno.";

});

Flight::route('GET /search/@knjiga', function($knjiga){

  $doctrineBootstrap = Flight::entityManager();
  $em = $doctrineBootstrap->getEntityManager();
  $repozitorij=$em->getRepository('Durdevic\Ontologija');
  $zapisi = $repozitorij->createQueryBuilder('p')
                        ->where('p.knjiga LIKE :knjiga')
                        ->setParameter('knjiga', '%'.$knjiga.'%')
                        ->getQuery()
                        ->getResult();
  echo $doctrineBootstrap->getJson($zapisi);

});

$cl = new ClassLoader('Durdevic', __DIR__, '/src');
$cl->register();
require_once 'bootstrap.php';
Flight::register('entityManager', 'DoctrineBootstrap');

Flight::start();
