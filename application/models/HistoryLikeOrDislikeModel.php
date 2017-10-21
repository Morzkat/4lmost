<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryLikeOrDislikeModel extends CI_Model
{
  public $userId;
  public $historyId;
  public $state;

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function getLikes()
  {
    $this->db->select('Idhistorylikeordislike AS likes', FALSE);

    $this->db->where('historyId ='. $this->input->get('history') );
    $this->db->where('state = 1');

    $this->db->from('historylikeordislike');

    $this->db->group_by("Idhistorylikeordislike");

    $this->db->count_all();

    $likes = $this->db->get()->num_rows();

     return $likes;
  }

  function getDislikes()
  {
    $this->db->select('Idhistorylikeordislike AS dislikes', FALSE);

    $this->db->where('historyId ='. $this->input->get('history') );
    $this->db->where('state = 0');

    $this->db->from('historylikeordislike');

    $this->db->group_by("Idhistorylikeordislike");

    $this->db->count_all();

    $dislikes = $this->db->get()->num_rows();

     return $dislikes;
  }

  public function voteHistory()
  {
    $this->historyId = $this->input->post('idHistory');
    $this->userId = 1;

    switch ($this->input->post('vote'))
    {
      case 'likes':
        $this->state = 1;
        break;

      case 'dislikes':
        $this->state = 0;
        break;
    }

    $query = $this->db->get_where('historylikeordislike', array('historyId' => $this->historyId, 'userId' => $this->userId ));

    $exist = $query->num_rows();
    $history = $query->row();

    if ($exist)
    {
      if ($history->state == $this->state)
      {
        $this->db->where('historyId', $this->historyId);
        $this->db->where('userId', $this->userId);

        $this->db->delete('historylikeordislike');
      }

      else
      {
        $this->db->where('historyId', $this->historyId);
        $this->db->where('userId', $this->userId);

        $this->db->update('historylikeordislike', $this);
      }
    }

    else
    {
      $this->db->insert('historylikeordislike', $this);
    }

    $_GET['history'] = $this->historyId;

    return $votes = array('likes' => $this->getLikes() , 'dislikes' => $this->getDislikes());

  }
}
