<?php
declare(strict_types=1);

namespace Tarknaiev\ErpOrderExport\Model\Exporter;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;
use Tarknaiev\ErpOrderExport\Api\Data\ErpSystemInterface;
use Tarknaiev\ErpOrderExport\Model\Sender\Sender;
use Tarknaiev\OrderExport\Api\Data\ExportInterface;
use Tarknaiev\OrderExport\Api\ExportRepositoryInterface;

/**
 * Class ErpExporter
 *
 * @package Tarknaiev\ErpOrderExport\Model
 */
class ErpExporter implements ExporterInterface
{
    /**
     * @var ExportRepositoryInterface
     */
    protected $exportRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteria;

    /**
     * @var Sender
     */
    protected $sender;

    /**
     * ErpExporter constructor.
     *
     * @param ExportRepositoryInterface $exportRepository
     * @param SearchCriteriaBuilder $searchCriteria
     * @param Sender $sender
     */
    public function __construct(
        ExportRepositoryInterface $exportRepository,
        SearchCriteriaBuilder $searchCriteria,
        Sender $sender
    ) {
        $this->exportRepository = $exportRepository;
        $this->searchCriteria = $searchCriteria;
        $this->sender = $sender;
    }

    /**
     * Export orders for the current export system
     *
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function exportOrders(): void
    {
        $searchCriteria = $this->searchCriteria
            ->addFilter(ExportInterface::EXPORT_TYPE, ErpSystemInterface::EXPORT_SYSTEM_TYPE)
            ->addFilter(ExportInterface::RESULT_STATUS, null)
            ->crate();
        $exportOrders = $this->exportRepository->getList($searchCriteria)->getItems();
        foreach ($exportOrders as $exportOrder) {
            $this->exportOrder($exportOrder);
        }
    }

    /**
     * Export only one order for the current export system
     *
     * @param ExportInterface $exportOrder
     * @return void
     */
    public function exportOrder(ExportInterface $exportOrder): void
    {
        try {
            $data = $this->sender->prepareData((int)$exportOrder->getOrderId());
            $result = $this->sender->send($data);
        } catch (LocalizedException $e) {
            return;
        }

        $resultData = $this->sender->parseResult($result);

        //save result
    }
}
