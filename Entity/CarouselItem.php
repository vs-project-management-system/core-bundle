<?php
namespace PMS\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

use \PMS\Component\Core\Model\CarouselItem as BaseCarouselItem;
use \PMS\Bundle\CoreBundle\Traits\EntityBootstrapTrait;
use \PMS\Bundle\CoreBundle\Traits\SluggableTrait;
use \PMS\Bundle\CoreBundle\Traits\TimestampableTrait;

/**
* @ORM\Entity(repositoryClass="PMS\Bundle\CoreBundle\Repository\CarouselItemRepository")
* @ORM\Table(name="carousel_item")
*/
class CarouselItem extends BaseCarouselItem
{
    use EntityBootstrapTrait;
    use SluggableTrait;
    use TimestampableTrait;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min = "1",
     *      max = "250",
     *      minMessage = "Name must be at least {{ limit }} characters length",
     *      maxMessage = "Name cannot be longer than {{ limit }} characters length"
     * )
     * @var string
     */
    protected $name;
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min = "1",
     *      max = "30",
     *      minMessage = "Caption must be at least {{ limit }} characters length",
     *      maxMessage = "Caption cannot be longer than {{ limit }} characters length"
     * )
     * @var string
     */
    protected $caption;

    /**
     * Get caption
     * 
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set caption
     * 
     * @param string $caption caption
     * 
     * @return CarouselItem
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * @ORM\Column(type="string")
     * @Assert\Url()
     * @Assert\Length(
     *      min = "1",
     *      max = "30",
     *      minMessage = "Caption must be at least {{ limit }} characters length",
     *      maxMessage = "Caption cannot be longer than {{ limit }} characters length"
     * )
     * @var string
     */
    protected $image;

    /**
     * Get image
     * 
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image url
     * 
     * @param string $image url
     * 
     * @return string
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}
