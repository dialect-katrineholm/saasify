<?php
namespace Dialect\Saasify\Builders;
use Dialect\Saasify\Model;
use Dialect\Saasify\Models\SaasifyModel;

class ModelBuilder extends Builder {
	protected $findColumn = 'model_class';
	function __construct($builder = null) {
		parent::__construct(SaasifyModel::class, $builder);
	}

	protected function convertModel($rawModel){
		$model = new Model($rawModel);

		$model->setModel($rawModel->model_class)
			->setCanCreate($rawModel->can_create)
			->setCanUpdate($rawModel->can_update)
			->setCanDelete($rawModel->can_delete)
			->setMaxCount($rawModel->max_count);

		return $model;
	}








}