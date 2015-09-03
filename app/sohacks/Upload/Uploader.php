<?php

namespace sohacks\Upload;

class Uploader 
{
	protected $user;
	protected $file;

	public function __construct($file, $user)
	{
		$this->user = $user;

		$this->file = $file;

	}

	public function uploadProfPic($id) {
		$this->file->setName($id);
		$this->addValidations(array(
			new \Upload\Validation\Mimetype('image/png','image/jpg'),
    		new \Upload\Validation\Size('5M')
		));
		$this->file->upload();
	}
}
