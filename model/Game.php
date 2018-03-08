<!--- MACCAGNO Coralie - TP Roulette : Class Game DTO --->


<?php 
class Game {
	private $player;
	private $date;
	private $bet;
	private $profit;

	public function __construct($pl, $d, $b, $pr)
	{
		$this->player=$pl;
		$this->date=$d;
		$this->bet=$b;
		$this->profit=$pr;
	}
	
	public function getPlayer() { return $this->player; }
	public function getDate() { return $this->date; }
	public function getBet() { return $this->bet; }
	public function getProfit() { return $this->profit; }
	
	
	/* pas besoin de setter ?? */
	
}