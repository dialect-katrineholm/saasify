<?php
namespace Dialect\Saasify\Builders;
abstract class Builder{

	protected $builder;
	protected $modelClass;
	protected $findColumn = 'name';
	function __construct($modelClass,$builder = null) {
		$this->modelClass = $modelClass;
		$this->builder = $builder ? $builder : $modelClass::query();
	}

	public function all(){
		$modelClass = $this->modelClass;
		$collection = $modelClass::all();

		return $this->convertCollection($collection);

	}

	public function find($columnValue){
		$rawModel = $this->builder->where($this->findColumn, $columnValue)->first();
		if($rawModel){
			return $this->convertModel($rawModel);
		}

		return null;
	}

	public function query(Callable $callback){
		$this->builder = call_user_func($callback, $query = $this->builder);

		return $this;
	}

	public function get(){
		$collection = $this->builder->get();

		return $this->convertCollection($collection);
	}

	public function count(){
		return $this->builder->count();

	}

	public function first(){

		$rawModel = $this->builder->first();
		if($rawModel){
			return $this->convertModel($rawModel);
		}
		return null;

	}

	protected function convertCollection($collection){

		$result = collect();
		foreach($collection as $rawModel){
			$result->push($this->convertModel($rawModel));
		}

		return $result;
	}
	protected abstract function convertModel($rawModel);

}