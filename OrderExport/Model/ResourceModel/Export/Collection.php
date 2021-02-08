<?php
declare(strict_types=1);

namespace Tarknaiev\OrderExport\Model\ResourceModel\Export;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Tarknaiev\OrderExport\Model\Export;
use Tarknaiev\OrderExport\Model\ResourceModel\Export as ResourceExport;

/**
 * Export data collection
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'export_data_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'export_data_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Export::class, ResourceExport::class);
    }
}
