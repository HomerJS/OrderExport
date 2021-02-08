<?php
declare(strict_types=1);

namespace Tarknaiev\OrderExport\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface ExportSearchResultsInterface
 *
 * @package Tarknaiev\OrderExport\Api\Data
 */
interface ExportSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get export data list.
     *
     * @return ExportInterface[]
     */
    public function getItems();

    /**
     * Set export data list.
     *
     * @param ExportInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
