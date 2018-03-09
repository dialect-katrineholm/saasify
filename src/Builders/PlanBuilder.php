<?php
namespace Dialect\Saasify\Builders;

use Dialect\Saasify\Models\SaasifyPlan;
use Dialect\Saasify\Plan;

class PlanBuilder extends Builder {


	function __construct($builder = null) {
		parent::__construct(SaasifyPlan::class, $builder);
	}

	protected function convertModel($rawModel){
		$plan = new Plan($rawModel);

		$plan->setName($rawModel->name);

		return $plan;
	}








}