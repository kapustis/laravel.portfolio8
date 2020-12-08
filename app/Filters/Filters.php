<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
	protected $request, $builder;

	protected $filters = [];

	/**
	 * ThreadFilter constructor.
	 * @param Request $request
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function apply($builder)
	{
		$this->builder = $builder;
		//dd($this->getFilters());
		foreach ($this->getFilters() as $filter => $value) {
			if (method_exists($this, $filter)) {
				$this->$filter($value);
			}
		}
		return $this->builder;
	}


	/**
	 * @return array
	 */
	public function getFilters(): array
	{
		return $this->request->only($this->filters);
//        return $this->request->intersect($this->filters);
	}
}
