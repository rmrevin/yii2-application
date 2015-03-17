<?php
/**
 * UserFacebookQuery.php
 * @author Revin Roman http://phptime.ru
 */

namespace resources\User\queries;

/**
 * Class UserFacebookQuery
 * @package resources\User\queries
 */
class UserFacebookQuery extends \yii\db\ActiveQuery implements AbstractSocialQueryInterface
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