<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $historyPerPage = 10;

    if ($this->input->get('categoria') != 'ramdon') 
    {
      $totalHistories = $this->history->countHistoriesByCategory() / $historyPerPage;
      $round = round($totalHistories);
      $result = ($totalHistories > $round) ? $round + 1 : $round;
    }

    else
    {
      $result = 0;
    }

		$page = isset($_GET['pg']) ? $_GET['pg'] : 0;

    $categoryName = $this->input->get('categoria');

    $histories = $this->history->getHistoriesByCategory($historyPerPage, $page."0");
    $twig = $this->twig->getTwig();
    echo $twig->render('category.twig',compact('histories', 'result', 'categoryName'));
  }

}
