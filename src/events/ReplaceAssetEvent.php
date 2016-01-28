<?php
/**
 * @link      http://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license   http://craftcms.com/license
 */

namespace craft\app\events;

/**
 * Replace asset event class.
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  3.0
 */
class ReplaceAssetEvent extends AssetEvent
{
    // Properties
    // =========================================================================

    /**
     * @var string file on server that is being used to replace
     */
    public $replaceWith;

    /**
     * @var string the file name that will be used
     */
    public $filename;

}