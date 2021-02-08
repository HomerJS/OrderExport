<?php
declare(strict_types=1);

namespace Tarknaiev\ErpOrderExport\Cron;

use Tarknaiev\ErpOrderExport\Api\Data\ErpSystemInterface;
use Tarknaiev\ErpOrderExport\Model\Exporter\ErpExporter;
use Tarknaiev\OrderExport\Helper\Config;

/**
 * Class ExportOrdersErp
 *
 * @package Tarknaiev\ErpOrderExport\Cron
 */
class ExportOrdersErp
{
    /**
     * @var Config
     */
    protected $helper;

    /**
     * @var ErpExporter
     */
    protected $exporter;

    /**
     * ExportOrdersErp constructor.
     *
     * @param Config $helper
     * @param ErpExporter $exporter
     */
    public function __construct(
        Config $helper,
        ErpExporter $exporter
    ) {
        $this->helper = $helper;
        $this->exporter = $exporter;
    }

    /**
     * Run order export orders by cron
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(): void
    {
        if ($this->helper->isEnabled(ErpSystemInterface::EXPORT_SYSTEM_TYPE)) {
            $this->exporter->exportOrders();
        }
    }
}
