<?php
/**
 * AbstractSocialQueryInterface.php
 * @author Revin Roman http://phptime.ru
 */

namespace resources\User\queries;

/**
 * Interface AbstractSocialQueryInterface
 * @package resources\User\queries
 */
interface AbstractSocialQueryInterface
{

    /**
     * @param integer|array $user_id
     * @return self
     */
    public function byUserId($user_id);

    /**
     * @param integer|array $social_id
     * @return self
     */
    public function bySocialId($social_id);
}