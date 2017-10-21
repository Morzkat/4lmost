<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommentModel extends CI_Model
{

  public $comment;
  public $idUser;
  public $idHistory;

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function newComment()
  {
    $this->comment = $this->input->post('comment');
    $this->idHistory = $this->input->post('idHistory');
    $this->idUser = 1;

    $this->db->insert('comment', $this);
  }

  public function getComments()
  {
    $this->db->order_by('create_At','DESC');
    $query = $this->db->get_where('comment', array('idHistory' => $this->input->get('history') ));
    return $query->result();
  }

  public function countCommentFromHistory($historyId)
  {
    $numberOfComments = array();
    foreach ($historyId as $key)
    {
      $this->db->select('idComment AS numberOfComments', FALSE);
      $this->db->where('idHistory', $key->idHistory);
      $this->db->from('comment');
      $this->db->count_all();

      $query = $this->db->get()->num_rows();

      array_push($numberOfComments, $query);
    }

    return $numberOfComments;
  }

}
