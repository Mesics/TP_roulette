<!--- MACCAGNO Coralie - TP Roulette : Class Player DTO --->

<?php
	
class Player {
	private $name;
	private $id;
	private $money;
	
	public function __construct($id, $n, $m)
	{
		$this->name=$n;
		$this->id=$id;
		$this->money=$m;
	}
	
	public function getName() { return $this->name; }
	public function getId()	{return $this->id; }
	public function getMoney() { return $this->money; } 
}
