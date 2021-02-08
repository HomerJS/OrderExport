<?php
declare(strict_types=1);

namespace Tarknaiev\OrderExport\Api;

use Tarknaiev\OrderExport\Api\Data\ExportInterface;

/**
 * Interface ExportRepositoryInterface
 *
 * @package Tarknaiev\OrderExport\Api
 */
interface ExportRepositoryInterface
{
    /**
     * Save data.
     *
     * @param ExportInterface $export
     * @return ExportInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(ExportInterface $export): ExportInterface;

    /**
     * Retrieve export data matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Tarknaiev\OrderExport\Api\Data\ExportInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}
