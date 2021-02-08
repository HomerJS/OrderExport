<?php
declare(strict_types=1);

namespace Tarknaiev\OrderExport\Model;

use Magento\Framework\Api\SearchResults;
use Tarknaiev\OrderExport\Api\Data\ExportSearchResultsInterface;

/**
 * Service Data Object with Export data search results.
 */
class ExportSearchResults extends SearchResults implements ExportSearchResultsInterface
{
}
