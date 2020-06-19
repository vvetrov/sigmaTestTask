<?php


namespace sigmaProducts\dataAdapters;


use Exception;

/** interface for product data storage manipulation
 * @author Valery Vetrov
 */
interface smDataAdapter
{
    /**
     * Sets item prices
     *
     * @param string $productName - name of the product
     * @param float|array $prices - float price for one item or array like [qty=>price...]
     * @param bool $reset - if true then clear previously set prices
     * @return self
     */
    public function setItem($productName, $prices, $reset = false);

    /**
     * Gets item prices as array like [qty=>price...]
     * MUST return array with qty's in reverse order
     *
     * @param string $productName
     * @return array
     * @throws Exception - if product does not exist
     */
    public function getItem($productName);
}