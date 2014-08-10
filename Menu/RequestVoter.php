<?php
namespace PMS\Bundle\CoreBundle\Menu;
 
class RequestVoter implements \Knp\Menu\Matcher\Voter\VoterInterface
{
    private $container;
 
    public function __construct(\Symfony\Component\DependencyInjection\ContainerInterface $container)
    {
        $this->container = $container;
    }
 
    public function matchItem(\Knp\Menu\ItemInterface $item)
    {
        if ($item->getUri() === $this->container->get('request')->getRequestUri()) {
            return true;
        } elseif ($item->getUri() !== '/' &&
                (
                    substr(
                        $this->container->get('request')->getRequestUri(),
                        0,
                        strlen($item->getUri())
                    ) === $item->getUri()
                )
            ) {
            return true;
        }
        
        return null;
    }
}
