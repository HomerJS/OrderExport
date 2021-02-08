<?php
declare(strict_types=1);

namespace Tarknaiev\OrderExport\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Config
 *
 * @package Tarknaiev\OrderExport\Helper
 */
class Config extends AbstractHelper
{
    const XML_CONFIG_SALES_ERP_ENABLED = "sales/erp/enabled";

    /**
     * @param string $system
     * @return bool
     */
    public function isEnabled(string $system): bool
    {
        $method = "isEnabled" . ucfirst(mb_strtolower($system));
        return method_exists($this, $method) ? $this->$method() : false;
    }

    /**
     * @return bool
     */
    protected function isEnabledErp(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_CONFIG_SALES_ERP_ENABLED);
    }
}
