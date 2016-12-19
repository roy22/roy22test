<?php
	namespace ROY\PlatformBundle\Antispam;
	
	class ROYAntispam{
		private $mailer;
		private $locale;
		private $minLenght;
		
		public function __construct(\Swift_Mailer $mailer, $locale, $minLenght)
		{
			$this->mailer=$mailer;
			$this->locale=$locale;
			$this->minLenght=$minLenght;
		}
		
		
		public function isSpam($text){
			return strlen($text)<$this->minLenght;
		}
	}
