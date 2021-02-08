<?php
declare(strict_types=1);

namespace Tarknaiev\ErpOrderExport\Model\Sender;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\HTTP\ZendClientFactory;
use Magento\Framework\Simplexml\Element;
use Magento\Framework\Simplexml\ElementFactory;
use Magento\Sales\Api\OrderRepositoryInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Sender
 *
 * @package Tarknaiev\ErpOrderExport\Model\Sender
 */
class Sender implements SenderInterface
{
    /**
     * @var ElementFactory
     */
    protected $xmlFactory;

    /**
     * @var ZendClientFactory
     */
    protected $httpClient;

    /**
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Sender constructor.
     *
     * @param ElementFactory $xmlFactory
     * @param ZendClientFactory $httpClient
     * @param OrderRepositoryInterface $orderRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        ElementFactory $xmlFactory,
        ZendClientFactory $httpClient,
        OrderRepositoryInterface $orderRepository,
        LoggerInterface $logger
    ) {
        $this->xmlFactory = $xmlFactory;
        $this->httpClient = $httpClient;
        $this->orderRepository = $orderRepository;
        $this->logger = $logger;
    }

    /**
     * Send POST request to ERP system
     *
     * @param Element $request
     * @return string
     * @throws LocalizedException
     */
    public function send(Element $request): string
    {
        try {
            $this->httpClient
                ->setUri()//TODO get url from system config
                ->setHeaders(['Content-Type: text/xml'])
                ->setMethod(\Zend_Http_Client::POST)
                ->setRawData($request);
        } catch (\Exception $e) {
            $this->logger->error(__("Cannot send data for export: %1", $e->getMessage()));
            throw new LocalizedException(_($e->getMessage()));
        }
        return $this->httpClient->request()->getBody();
    }

    /**
     * Prepare data for sending request
     *
     * @param int $orderId
     * @return Element
     * @throws LocalizedException
     */
    public function prepareData(int $orderId): Element
    {
        $xmlHeader = '<?xml version="1.0" encoding="UTF-8"?>';

        /** @var Element $request */
        $request=$this->xmlFactory->create(['data'=>$xmlHeader]);
        $request->addChild("order");
        $request->addChild("order_id",$orderId);
        try {
            $order = $this->orderRepository->get($orderId);
        } catch (NoSuchEntityException $e) {
            $this->logger->alert(__("Cannot prepare data for export: %1", $e->getMessage()));
            throw new LocalizedException(_($e->getMessage()));
        }

        //shipping
        $this->setAddressNode($request, $order->getShippingAddress(), "shipping_address");

        //billing
        $this->setAddressNode($request, $order->getBillingAddress(), "billing_address");

        //items
        $request->addChild("items");
        $items = $order->getItems();
        foreach ($items as $item) {
            $request->addChild("item");
            $request->addChild("sku", $item->getSku());
            $request->addChild("qty", $item->getQtyOrdered());
            $request->addChild("price", $item->getRowTotal());
        }

        return $request;
    }

    /**
     * Set shipping and billing address data
     *
     * @param $request
     * @param $address
     * @param $nodeType
     * @return Element
     */
    protected function setAddressNode(&$request, $address, $nodeType): Element
    {
        $request->addChild($nodeType);
        $request->addChild("first_name", $address->getFirstname());
        $request->addChild("last_name", $address->getLastname());
        $request->addChild("street1", $address->getStreetLine(1));
        $request->addChild("street2", $address->getStreetLine(2));
        $request->addChild("postcode", $address->getPostcode());
        $request->addChild("city", $address->getCity());
        $request->addChild("country_code", $address->getCountryId());
        return $request;
    }

    /**
     * @param string $result
     * @return array|string
     */
    public function parseResult(string $result): array
    {
        // TODO: finish parcing
        $return = [];
        return $result;
    }
}
