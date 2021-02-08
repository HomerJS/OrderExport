<?php
declare(strict_types=1);

namespace Tarknaiev\OrderExport\Api\Data;

/**
 * Interface ExportInterface
 *
 * @package Tarknaiev\OrderExport\Api\Data
 */
interface ExportInterface
{
    const ENTITY_ID      = "entity_id";
    const ORDER_ID = "order_id";
    const EXPORT_TYPE = "export_type";
    const RESULT_STATUS = "result_status";
    const RESULT_MESSAGE = "result_message";
    const CREATED_AT     = "created_at";
    const UPDATED_AT = "updated_at";

    /**
     * Get order_id
     *
     * @return int|null
     */
    public function getOrderId():? int;

    /**
     * Get export_type
     *
     * @return string|null
     */
    public function getExportType():? string;

    /**
     * Get result_status
     *
     * @return string|null
     */
    public function getResultStatus():? string;

    /**
     * Get result_message
     *
     * @return string|null
     */
    public function getResultMessage():? string;

    /**
     * Get created_at
     *
     * @return string|null
     */
    public function getCreatedAt():? string;

    /**
     * Get updated_at
     *
     * @return string|null
     */
    public function getUpdatedAt():? string;

    /**
     * Set order_id
     *
     * @param int $orderId
     * @return ExportInterface
     */
    public function setOrderId(int $orderId):? ExportInterface;

    /**
     * Set export_type
     *
     * @param string $exportType
     * @return ExportInterface
     */
    public function setExportType(string $exportType):? ExportInterface;

    /**
     * Set result_status
     *
     * @param string $resultStatus
     * @return ExportInterface
     */
    public function setResultStatus(string $resultStatus):? ExportInterface;

    /**
     * Set result_message
     *
     * @param string $resultMessage
     * @return ExportInterface
     */
    public function setResultMessage(string $resultMessage):? ExportInterface;

    /**
     * Set created_at
     *
     * @param string $createdAt
     * @return ExportInterface
     */
    public function setCreatedAt(string $createdAt):? ExportInterface;

    /**
     * Set updated_at
     *
     * @param string $updatedAt
     * @return ExportInterface
     */
    public function setUpdatedAt(string $updatedAt):? ExportInterface;


}
