<?php

/**
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Twig
{

  private $twig;
  function __construct()
  {
  }

  private function Twig()
  {
    //load the path views
    $loader = new Twig_Loader_Filesystem(realpath('application/views/'));

    //settings
    $twig = new Twig_Environment($loader, array('debug' => true ));
    //add cache
    // , array(
    //   'cache' => realpath('application/cache/Twig'),
    // )

    //debug of twig
    $twig->addExtension(new Twig_Extension_Debug());

    // url
     $twig->addGlobal('url', base_url());
     $twig->addGlobal('pg', isset($_GET['pg']) ? $_GET['pg'] : 0);

    return $twig;
  }

  public function getTwig()
  {
    return $this->Twig();
  }

}
