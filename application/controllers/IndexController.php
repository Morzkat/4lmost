<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class indexController extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//pagination

		$historyPerPage = 10;

		$totalHistories = $this->history->countHistories() / $historyPerPage;
		$round = round($totalHistories);
		$result = ($totalHistories > $round) ? $round + 1 : $round;

		$page = isset($_GET['pg']) ? $_GET['pg'] : 0;

		$histories = $this->history->getHistories($historyPerPage, $page."0");
		/*pagination*/

		$numberOfComments = $this->comment->countCommentFromHistory($histories);

		$twig = $this->twig->getTwig();
		echo $twig->render('index.twig', compact('histories', 'result', 'page', 'numberOfComments'));
	}
}
