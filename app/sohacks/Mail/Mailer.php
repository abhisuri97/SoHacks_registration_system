<?php

namespace sohacks\Mail;

class Mailer 
{
	protected $view;
	protected $email;
	protected $sendgrid;
	protected $from;

	public function __construct($view, $email , $sendgrid, $from)
	{
		$this->view = $view;

		$this->email = $email;

		$this->sendgrid = $sendgrid;

		$this->from = $from;
	}

	public function send($template,$data,$callback) 
	{
		$message = new Message($this->email); 

		$this->view->appendData($data);

		$message->body($this->view->render($template));

		$message->from($this->from);

		call_user_func($callback, $message);

		$this->sendgrid->send($this->email);
	}
	public function notice($body,$data,$callback) 
	{
		$message = new Message($this->email); 

		$message->body($body);

		$message->from($this->from);

		call_user_func($callback, $message);

		$this->sendgrid->send($this->email);
	}
}