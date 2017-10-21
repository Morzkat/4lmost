<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommentController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {

  }

  public function newComment()
  {
    $this->comment->newComment();
  }

  public function getComments()
  {
    $this->comment->getComments();
  }

  public function voteComment()
  {
    $commentVotes = $this->commentLikeAndDislike->voteComment();
    
    echo json_encode($commentVotes);
  }
}
