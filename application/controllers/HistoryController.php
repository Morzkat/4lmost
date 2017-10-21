<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {

  }

  public function getHistory()
  {
    $twig = $this->twig->getTwig();

    $history = $this->history->getHistory();

    $comments = $this->comment->getComments();

    $likes = $this->historyLikeAndDislike->getLikes();
    $dislikes = $this->historyLikeAndDislike->getDislikes();

    echo $twig->render('history.twig', compact('history','comments','likes','dislikes'));
  }

  public function newHistory ()
  {
    $this->history->newHistory();
  }

  public function voteHistory()
  {
    $votes = $this->historyLikeAndDislike->voteHistory();
    echo json_encode($votes);
  }

}
