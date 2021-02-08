<?php
declare(strict_types=1);

namespace Tarknaiev\ErpOrderExport\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;
use Tarknaiev\ErpOrderExport\Api\Data\ErpSystemInterface;
use Tarknaiev\OrderExport\Api\Data\ExportInterface;
use Tarknaiev\OrderExport\Api\Data\ExportInterfaceFactory;
use Tarknaiev\OrderExport\Api\ExportRepositoryInterface;
use Tarknaiev\OrderExport\Helper\Config;

/**
 * Class SaveOrderToExport
 *
 * @package Tarknaiev\ErpOrderExport\Observer
 */
class SaveOrderToExport implements ObserverInterface
{
    /**
     * @var Config
     */
    protected $helper;

    /**
     * @var ExportInterfaceFactory
     */
    protected $exportFactory;

    /**
     * @var ExportRepositoryInterface
     */
    protected $exportRepository;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * SaveOrderToExport constructor.
     *
     * @param Config $helper
     * @param ExportInterfaceFactory $exportFactory
     * @param ExportRepositoryInterface $exportRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        Config $helper,
        ExportInterfaceFactory $exportFactory,
        ExportRepositoryInterface $exportRepository,
        LoggerInterface $logger
    ) {
        $this->helper = $helper;
        $this->exportFactory = $exportFactory;
        $this->exportRepository = $exportRepository;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer): void
    {
        if ($this->helper->isEnabled(ErpSystemInterface::EXPORT_SYSTEM_TYPE)) {

            /** @var ExportInterface $exportModel */
            $exportModel = $this->exportFactory
                ->create()
                ->setOrderId((int) $observer->getEvent()->getOrder()->getEntityId())
                ->setExportType(ErpSystemInterface::EXPORT_SYSTEM_TYPE);

            try {
                $this->exportRepository->save($exportModel);
            } catch (CouldNotSaveException $e) {
                $this->logger->critical(__("Cannot save order data for export: %1", $e->getMessage()));
            }
        }
    }
}
