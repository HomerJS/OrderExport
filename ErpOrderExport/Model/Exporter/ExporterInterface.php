<?php
declare(strict_types=1);

namespace Tarknaiev\ErpOrderExport\Model\Exporter;

use Tarknaiev\OrderExport\Api\Data\ExportInterface;

/**
 * Interface ExporterInterface
 *
 * @package Tarknaiev\ErpOrderExport\Model\Exporter
 */
interface ExporterInterface
{
    /**
     * Export orders for the current export system
     *
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function exportOrders(): void;

    /**
     * Export only one order for the current export system
     *
     * @param ExportInterface $exportOrder
     * @return void
     */
    public function exportOrder(ExportInterface $exportOrder): void;
}
