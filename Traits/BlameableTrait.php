<?php
namespace PMS\Bundle\CoreBundle\Traits;

trait BlameableTrait
{
    /**
     * Created by
     * @var \PMS\Bundle\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="\PMS\Bundle\UserBundle\Entity\User", inversedBy="project")
     * @ORM\JoinColumn(name="created_by_id", referencedColumnName="id")
     */
    protected $created_by;
    
    /**
     * Created by
     * @var \PMS\Bundle\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="\PMS\Bundle\UserBundle\Entity\User", inversedBy="project")
     * @ORM\JoinColumn(name="created_by_id", referencedColumnName="id")
     */
    protected $updated_by;

    /**
     * Get created by
     * @return \PMS\Bundle\UserBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Set created by
     * @var \PMS\Bundle\UserBundle\Entity\User $user
     * @return mixed
     */
    public function setCreatedBy(\PMS\Bundle\UserBundle\Entity\User $user)
    {
        $this->created_by = $user;

        return $user;
    }

    /**
     * Get updated by
     * @return \PMS\Bundle\UserBundle\Entity\User
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * Set updated by
     * @var \PMS\Bundle\UserBundle\Entity\User $user
     * @return mixed
     */
    public function setUpdatedBy(\PMS\Bundle\UserBundle\Entity\User $user)
    {
        $this->updated_by = $user;

        return $this;
    }
}
