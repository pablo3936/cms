<?php
/**
 * @link      http://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license   http://craftcms.com/license
 */

namespace craft\app\records;

use Craft;
use craft\app\db\ActiveRecord;

/**
 * Class UserGroup record.
 *
 * @property integer $id     ID
 * @property string  $name   Name
 * @property string  $handle Handle
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  3.0
 */
class UserGroup extends ActiveRecord
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['handle'], 'craft\\app\\validators\\Handle', 'reservedWords' => ['id', 'dateCreated', 'dateUpdated', 'uid', 'title']],
            [['name', 'handle'], 'required'],
            [['name', 'handle'], 'unique'],
            [['name', 'handle'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     *
     * @return string
     */
    public static function tableName()
    {
        return '{{%usergroups}}';
    }

    /**
     * Returns the group’s users.
     *
     * @return \yii\db\ActiveQueryInterface
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'userId'])
            ->viaTable('{{%usergroups_users}}', ['groupId' => 'id']);
    }
}