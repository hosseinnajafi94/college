<?php
namespace app\modules\site\models\DAL;
use Yii;
/**
 * This is the model class for table "site_settings".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id
 * @property string $title
 * @property string $logo
 * @property string $favicon
 * @property string $version
 */
class SiteSettings extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'site_settings';
    }
    public function rules() {
        return [
                [['title', 'version'], 'required'],
                [['title', 'logo', 'favicon', 'version'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels() {
        return [
            'id' => Yii::t('site', 'ID'),
            'title' => Yii::t('site', 'Title'),
            'logo' => Yii::t('site', 'Logo'),
            'favicon' => Yii::t('site', 'Favicon'),
            'version' => Yii::t('site', 'Version'),
        ];
    }
}