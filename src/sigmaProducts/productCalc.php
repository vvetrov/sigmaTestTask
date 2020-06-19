<?php


namespace sigmaProducts;


use sigmaProducts\dataAdapters\smDataAdapter;

/**
 * basic product total calculation class
 */
class productCalc
{
	/** @var array $products */
	private $products = [];
	/** @var smDataAdapter $adapter */
	private $adapter;

	public function __construct(smDataAdapter $adapter) {
		$this->adapter = $adapter;
	}

	/**
	 * Adds another product into the pool
	 * @param string $productName
	 * @param int $amount
	 */
	public function addProduct($productName, $amount = 1) {
		$this->products[$productName] = empty($this->products[$productName]) ? $amount : $this->products[$productName] + $amount;
	}

	/** Empties the products pool */
	public function clear() {
		$this->products = [];
	}

	/**
	 * Calculates the total price for one product from price array
	 * @param int $amount
	 * @param array $price
	 *
	 * @return float
	 */
	public function calc($amount, $price) {
		$total = 0.0;
		do {
			foreach ($price as $qty=>$value) {
				if ($amount >= $qty) {
					$total += $value;
					$amount -= $qty;
					break;
				}
			}
		} while ($amount > 0);
		return $total;
	}

	/**
	 * Calculates the total price for pool
	 * @return float
	 */
	public function getTotal() {
		$total = 0.0;
		foreach ($this->products as $name=>$amount) {
			$price = $this->adapter->getItem($name);
			$total += $this->calc($amount, $price);
		}
		return $total;
	}
}