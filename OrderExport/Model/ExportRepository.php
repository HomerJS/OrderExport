<?php
declare(strict_types=1);

namespace Tarknaiev\OrderExport\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Tarknaiev\OrderExport\Api\Data\ExportInterface;
use Tarknaiev\OrderExport\Api\Data\ExportSearchResultsInterface;
use Tarknaiev\OrderExport\Api\Data\ExportSearchResultsInterfaceFactory;
use Tarknaiev\OrderExport\Api\ExportRepositoryInterface;
use Tarknaiev\OrderExport\Model\ResourceModel\Export as ResourceExport;

/**
 * Class ExportRepository
 *
 * @package Tarknaiev\OrderExport\Model
 */
class ExportRepository implements ExportRepositoryInterface
{
    /**
     * @var ResourceExport
     */
    protected $resource;

    /**
     * @var ExportCollectionFactory
     */
    protected $exportCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var ExportSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * ExportRepository constructor.
     *
     * @param ResourceExport $resource
     * @param ExportCollectionFactory $exportCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param ExportSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ResourceExport $resource,
        ExportCollectionFactory $exportCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        ExportSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->exportCollectionFactory = $exportCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save data
     *
     * @param ExportInterface $export
     * @return ExportInterface
     * @throws CouldNotSaveException
     */
    public function save(ExportInterface $export): ExportInterface
    {
        try {
            $this->resource->save($export);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the data: %1', $exception->getMessage()),
                $exception
            );
        }
        return $export;
    }

    /**
     * Load Export data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param SearchCriteriaInterface $searchCriteria
     * @return ExportSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->exportCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
