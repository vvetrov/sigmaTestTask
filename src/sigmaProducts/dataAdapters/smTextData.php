<?php


namespace sigmaProducts\dataAdapters;

use PHPUnit\Exception;

/** simple data provider for productCalc library
 * stores product price data in the textfile in JSON format
 *
 * @author Valery Vetrov
 */
class smTextData implements smDataAdapter {
	private $storageFileName = null;
	private $data = [];

	private function save() {
		if (!is_null($this->storageFileName)) {
			file_put_contents($this->storageFileName, json_encode($this->data));
		}
	}

	/**
	 * Class constructor
	 * @param string $filename
	 * if $filename is not set, then adapter will not store data (runs in memory)
	 */
	public function __construct($filename = null) {
		if (is_null($filename)) {
			return;
		}
		$this->storageFileName = $filename;
		if (file_exists($this->storageFileName)) {
			$this->data = json_decode(file_get_contents($this->storageFileName), TRUE);
			//if the read file is empty (e.g created by tmpnam())
			if (is_null($this->data)) {
				$this->data = [];
			}
		}
	}

	/**
	 * Sets item prices
	 * @param string $productName
	 * @param float|double|array $prices - prices can be array like [amount=>price] or single price value
	 * if single value then will set price for amount=1
	 * @param bool $reset - if TRUE then will clear previously set prices for product
	 */
	public function setItem($productName, $prices, $reset = false) {
		if (!$reset && array_key_exists($productName, $this->data)) {
			$values = $this->data[$productName];
		} else {
			$values = [];
		}
		if (is_array($prices)) {
			foreach ($prices as $amount=>$price) {
				$values[$amount] = $price;
			}
		} else {
			$values[1] = $prices;
		}
		krsort($values, SORT_NUMERIC);
		$this->data[$productName] = $values;
		$this->save();
	}

	/**
	 * Gets all prices for product
	 * @param string $productName
	 * @return array
	 * @throws \Exception - if product does not exist
	 */
	public function getItem($productName) {
		if (array_key_exists($productName, $this->data)) {
			return $this->data[$productName];
		} else {
			throw new \Exception('Item does not exist');
		}
	}
}