<?php
namespace Dialect\Saasify;
abstract class SaasifyObject{
	protected $rawModel;
	function __construct($rawModel) {
		$this->rawModel = $rawModel;
	}

	public abstract function save();
	public function update(){
		$this->save();
	}

	public function getRawModel(){
		return $this->rawModel;
	}

	public function delete(){
		$this->rawModel->delete();
	}

}