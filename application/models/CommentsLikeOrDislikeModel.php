<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommentsLikeOrDislikeModel extends CI_Model
{
  public $userId;
  public $commentId;
  public $state;

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function getLikes($idComment)
  {
    $this->db->select('Idcommentslikeordislike AS likes', FALSE);

    $this->db->where('commentId ='. $idComment );
    $this->db->where('state = 1');

    $this->db->from('commentslikeordislike');

    $this->db->group_by("Idcommentslikeordislike");

    $this->db->count_all();

    $likes = $this->db->get()->num_rows();

    $this->db->where('idComment', $idComment);
    $this->db->update('comment', array('likes' => $likes ));

     return $likes;
  }

  function getDislikes($idComment)
  {
    $this->db->select('Idcommentslikeordislike AS dislikes', FALSE);

    $this->db->where('commentId ='. $idComment );
    $this->db->where('state = 0');

    $this->db->from('commentslikeordislike');

    $this->db->group_by("Idcommentslikeordislike");

    $this->db->count_all();

    $dislikes = $this->db->get()->num_rows();

    $this->db->where('idComment', $idComment);
    $this->db->update('comment', array('dislikes' => $dislikes ));

     return $dislikes;
  }

  public function voteComment()
  {
    $this->commentId = $this->input->post('idComment');
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

    $query = $this->db->get_where('commentslikeordislike', array('commentId' => $this->commentId, 'userId' => $this->userId ));

    $exist = $query->num_rows();
    $comment = $query->row();

    if ($exist)
    {
      if ($comment->state == $this->state)
      {
        $this->db->where('commentId', $this->commentId);
        $this->db->where('userId', $this->userId);

        $this->db->delete('commentslikeordislike');
      }

      else
      {
        $this->db->where('commentId', $this->commentId);
        $this->db->where('userId', $this->userId);

        $this->db->update('commentslikeordislike', $this);
      }
    }

    else
    {
      $this->db->insert('commentslikeordislike', $this);
    }

    return $votes = array('likes' => $this->getLikes($this->commentId), 'dislikes' => $this->getDislikes($this->commentId));
  }
}
