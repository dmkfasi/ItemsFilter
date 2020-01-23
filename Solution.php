<?php

class Item
{
	public $name;
	public $price;
	public $quantity;

	public function __construct($n, $p, $q) {
		$this->name = $n;
		$this->price = $p;
		$this->quantity = $q;
	}
}

class Items
{
	private $items;

	/**
	 * @param Items[] $items
	 */
	public function __construct($items)
	{
			$this->items = $items;
	}

	public function filterBy($rootCondition) {
		$output = [];

		foreach ($this->items as $item) {
			if ($rootCondition->process($item)) {
				$output[] = $item;
			}
		}

		return $output;
	}
}

class AndFilter
{
	// Condition List to apply against
	private $cl = [];

	public function __construct() {
		$this->cl = func_get_args();
	}

	public function process(Item $item) {

		// Whenever a condition is not true, it fails the whole chain
		foreach ($this->cl as $objectName) {
			if (false === $objectName->process($item)) {
				return false;
			}
		}

		return true;
	}
}

class OrFilter
{
	// Condition List to apply against
	private $cl = [];

	public function __construct() {
		$this->cl = func_get_args();
	}

	public function process(Item $item) {
		// Whenever a condition is true, the whole chain is success
		foreach ($this->cl as $objectName) {
			if (true === $objectName->process($item)) {
				return true;
			}
		}

		return false;
	}
}

class NameFilter
{
	private $name = null;

	public function __construct(string $name) {
		$this->name = $name;
	}

	public function process(Item $item) {
		return ($item->name === $this->name);
	}
}

class LtQuantityFilter
{
	private $quantity = null;

	public function __construct(int $quantity) {
		$this->quantity = $quantity;
	}

	public function process(Item $item) {
		return ($item->quantity < $this->quantity);
	}
}

class GtPriceFilter
{
	private $price = null;

	// This needs additional libraries for Decimal type
	public function __construct(float $price) {
		$this->price = $price;
	}

	public function process(Item $item) {
		return ($item->price > $this->price);
	}
}

$items = [
	new Item('item_name1',  110, 15),
	new Item('item_name2',  1000, 12),
	new Item('item_name3',  100.00, 13),
	new Item('item_name4',  110.00, 15),
	new Item('item_name1',  150.00, 16),
];

$newItemsList = (new Items($items))->filterBy(
	new AndFilter(
		new NameFilter('item_name1'),
			new OrFilter(
				new GtPriceFilter(100.00),
				new LtQuantityFilter(10)
			)
		)
	);

var_dump($newItemsList);

