<?php
/**
 * UserGithubQuery.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\modules\Account\models\queries;

/**
 * Class UserGithubQuery
 * @package frontend\modules\Account\models\queries
 */
class UserGithubQuery extends \yii\db\ActiveQuery
{

    /**
     * @param integer|array $user_id
     * @return self
     */
    public function byUserId($user_id)
    {
        $this->andWhere(['user_id' => $user_id]);

        return $this;
    }

    /**
     * @param integer|array $social_id
     * @return self
     */
    public function bySocialId($social_id)
    {
        $this->andWhere(['social_id' => $social_id]);

        return $this;
    }
}