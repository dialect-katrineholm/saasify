<?php

class HelperTest extends  \Dialect\Saasify\TestCase {

	/** @test */
	public function helper_function_returns_instance_of_saasify(){
		$this->assertEquals(get_class(saasify()), 'Dialect\Saasify\Saasify');
	}
}