<?php
namespace PMS\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

use PMS\Component\Core\Model\Carousel as BaseCarousel;
use PMS\Bundle\CoreBundle\Entity\CarouselItem;
use PMS\Bundle\CoreBundle\Traits\EntityBootstrapTrait;
use PMS\Bundle\CoreBundle\Traits\SluggableTrait;
use PMS\Bundle\CoreBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity(repositoryClass="PMS\Bundle\CoreBundle\Repository\CarouselRepository")
 * @ORM\Table(name="carousel")
 */
class Carousel extends BaseCarousel
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
     * {@inheritdoc}
     * @ORM\OneToMany(targetEntity="CarouselItem", mappedBy="carousel")
     */
    protected $items;

    /**
     * {@inheritdoc}
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * {@inheritdoc}
     */
    public function setItems(array $items)
    {
        if (!$items instanceof ArrayCollection) {
            $items = new ArrayCollection($items);
        }

        $this->items = $items;

        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function addItem(\PMS\Component\Core\Model\CarouselItem $item)
    {
        $this->items[] = $item;
        
        return $this;
    }

    /**
     * Has items
     *
     * @return boolean
     */
    public function hasItems()
    {
        return !$this->items->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function getItem($item)
    {
        return $this->items->get($item);
    }
        
    /**
     * Remove a item
     *
     * @param CarouselItem|String $item item
     *
     * @return self
     */
    public function removeItem(CarouselItem $item)
    {
        unset($this->items[$item]);

        return $this;
    }
}
