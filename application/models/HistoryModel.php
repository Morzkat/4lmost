<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryModel extends CI_Model
{

  public $titleHistory;
  public $historyContent;
  public $userName;
  public $categoryName;

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function newHistory()
  {
    $this->titleHistory = $this->input->post('txtAreaTitleHistory');
    $this->historyContent = $this->input->post('txtAreaHistory');
    $this->userName = $this->input->post('txtNameUser');
    $this->categoryName = $this->input->post('categoryName');

    $this->db->insert('history', $this);

  }

  public function getHistories($limit, $start)
  {
    $this->db->order_by('create_At', 'DESC');
    $query = $this->db->get('history', $limit, $start);
    return $query->result();
  }

  public function getHistory()
  {
    $this->db->select();
    $this->db->where('idHistory', $this->input->get('history'));
    $this->db->from('history');
    $query = $this->db->get();
    return $query->row();
  }

  public function countHistories()
  {
    $this->db->select('Idhistory AS numberHistories', FALSE);
    $this->db->from('history');
    $this->db->count_all();

    $numberHistories = $this->db->get()->num_rows();

    return $numberHistories;
  }

  public function getHistoriesByCategory($limit, $start)
  {
    $this->categoryName = $this->input->get('categoria');

    if ($this->categoryName == 'ramdon')
    {
      $this->db->order_by('rand()');
    }

    else
    {
      $this->db->where('categoryName', $this->categoryName);
      $this->db->order_by('create_At', 'DESC');
    }

    $query = $this->db->get('history', $limit, $start);
    return $query->result();
  }

  public function countHistoriesByCategory()
  {
    $this->categoryName = $this->input->get('categoria');

    $this->db->where('categoryName', $this->categoryName);
    $this->db->select('Idhistory AS numberHistories', FALSE);
    $this->db->from('history');
    $this->db->count_all();

    $numberHistories = $this->db->get()->num_rows();

    return $numberHistories;
  }
}

?>
