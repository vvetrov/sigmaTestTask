<?php


namespace sigmaProducts;

use sigmaProducts\dataAdapters\smDataAdapter;
use sigmaProducts\dataAdapters\smTextData;
/*
 * wrapper for productCalc class to make terminal as required in the task
 * */
class productCalcTerminal {
	private $adapter;
	private $calc;

	/** Builds the terminal instance
	 * @param smDataAdapter $adapter
	 */
	public function __construct($adapter) {
		// will use adapter for setting new prices
			$this->adapter = $adapter;
		$this->calc = new productCalc($this->adapter);
	}

	/** Sets the price for product
	 *
	 * @param string $productName
	 * @param int $amount
	 * @param float $price
	 */
	public function setPricing($productName, $amount, $price) {
		$this->adapter->setItem($productName,[$amount=>$price]);
	}

	/** Adds the product to the pool
	 * @param string $productName
	 */
	public function scanItem($productName) {
		$this->calc->addProduct($productName);
	}

	/** Calculates the total for the pool */
	public function getTotal() {
		return$this->calc->getTotal();
	}
}