<?php
declare(strict_types=1);

namespace Tarknaiev\OrderExport\Model;

use Magento\Framework\Model\AbstractModel;
use Tarknaiev\OrderExport\Api\Data\ExportInterface;
use Tarknaiev\OrderExport\Model\ResourceModel\Export as ResourceExport;

/**
 * Class Export
 *
 * @package Tarknaiev\OrderExport\Model
 */
class Export extends AbstractModel implements ExportInterface
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceExport::class);
    }

    /**
     * @inheritDoc
     */
    public function getOrderId(): ?int
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setOrderId(int $orderId): ?ExportInterface
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * @inheritDoc
     */
    public function getExportType(): ?string
    {
        return $this->getData(self::EXPORT_TYPE);
    }

    /**
     * @inheritDoc
     */
    public function setExportType(string $exportType): ?ExportInterface
    {
        return $this->setData(self::EXPORT_TYPE, $exportType);
    }

    /**
     * @inheritDoc
     */
    public function getResultStatus(): ?string
    {
        return $this->getData(self::RESULT_STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setResultStatus(string $resultStatus): ?ExportInterface
    {
        return $this->setData(self::RESULT_STATUS, $resultStatus);
    }

    /**
     * @inheritDoc
     */
    public function getResultMessage(): ?string
    {
        return $this->getData(self::RESULT_MESSAGE);
    }

    /**
     * @inheritDoc
     */
    public function setResultMessage(string $resultMessage): ?ExportInterface
    {
        return $this->setData(self::RESULT_MESSAGE, $resultMessage);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(string $createdAt): ?ExportInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(string $updatedAt): ?ExportInterface
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
