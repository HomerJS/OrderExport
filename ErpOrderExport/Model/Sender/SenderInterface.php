<?php
declare(strict_types=1);

namespace Tarknaiev\ErpOrderExport\Model\Sender;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Simplexml\Element;

/**
 * Interface SenderInterface
 *
 * @package Tarknaiev\ErpOrderExport\Model\Sender
 */
interface SenderInterface
{
    /**
     * Send POST request to ERP system
     *
     * @param Element $request
     * @return string
     * @throws LocalizedException
     */
    public function send(Element $request): string;

    /**
     * Prepare data for sending request
     *
     * @param int $orderId
     * @return Element
     * @throws LocalizedException
     */
    public function prepareData(int $orderId): Element;
}
