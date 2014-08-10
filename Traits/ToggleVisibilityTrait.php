<?php
namespace PMS\Bundle\CoreBundle\Traits;

trait ToggleVisibilityTrait
{
    /**
     * Attribute visibility
     * @var boolean
     * @ODM\Boolean
     */
    protected $public = true;

    /**
     * Set public
     *
     * @param boolean $public
     * @return group
     */
    public function setPublic($public)
    {
        $this->public = (bool) $public;
        return $this;
    }

    /**
     * Is public
     *
     * @return boolean
     */
    public function isPublic($public = null)
    {
        if (null != $public && is_bool($public)) {
            $this->public = $public;

            return $this;
        }
        return (bool) $this->public;
    }
}
