<?php
if (! function_exists('saasify')) {
	/**
	 * Get an instance of saasify
	 * @return \Illuminate\Foundation\Application|mixed
	 */
	function saasify() {
		return app('saasify');
	}
}
