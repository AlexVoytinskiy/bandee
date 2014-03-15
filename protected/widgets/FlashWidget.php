<?php

class FlashWidget extends CWidget
{
	public $flashes;

	public function run()
	{
		if ($this->flashes === null) {
			return;
		}
		$this->render('flash', array('msgs' => $this->flashes));
	}
}