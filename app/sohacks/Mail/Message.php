<?php

namespace sohacks\Mail;

class Message 
{
	protected $mailer;

	public function __construct($mailer) 
	{
		$this->mailer = $mailer; 
	}
	public function to($address) 
	{
		$this->mailer->addTo($address);
	}
	public function setto($address) 
	{
		$this->mailer->setSmtpapiTos($address);
	}
	public function subject($subject) 
	{
		$this->mailer->setSubject($subject);
	}
	public function body($body) 
	{
		$this->mailer->setHtml($body);
	}
	public function from($from)
	{
		$this->mailer->setFrom($from);
	}
}