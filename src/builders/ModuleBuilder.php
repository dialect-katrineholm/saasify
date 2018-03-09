<?php
namespace Dialect\Saasify\Builders;

use Dialect\Saasify\Models\SaasifyModule;
use Dialect\Saasify\Module;

class ModuleBuilder extends Builder {


	function __construct($builder = null) {
		parent::__construct(SaasifyModule::class, $builder);
	}

	protected function convertModel($rawModel){
		$module = new Module($rawModel);

		$module->setName($rawModel->name);

		return $module;
	}








}