<?php
namespace PMS\Bundle\CoreBundle\Kernel;

use \Symfony\Component\Config\Loader\LoaderInterface;

use \ReflectionClass;

abstract class Kernel extends \Symfony\Component\HttpKernel\Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = array(
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),
            new \Symfony\Bundle\MonologBundle\MonologBundle(),
            new \Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new \Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            
            new \JMS\AopBundle\JMSAopBundle(),
            new \JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new \JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new \JMS\TranslationBundle\JMSTranslationBundle(),

            new \FOS\UserBundle\FOSUserBundle(),
            new \PUGX\MultiUserBundle\PUGXMultiUserBundle(),
            
            new \Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new \Knp\Bundle\MenuBundle\KnpMenuBundle(),
            
            new \Liip\ImagineBundle\LiipImagineBundle(),
            new \Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            
            new \WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            new \WhiteOctober\BreadcrumbsBundle\WhiteOctoberBreadcrumbsBundle(),

            new \PMS\Bundle\ProjectBundle\PMSProjectBundle(),
            new \PMS\Bundle\CoreBundle\PMSCoreBundle(),
            new \PMS\Bundle\ResourceBundle(),
            new \PMS\Bundle\UserBundle()
        );
        
        if (in_array($this->environment, array('dev', 'test'))) {
            $bundles[] = new \Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new \Elao\WebProfilerExtraBundle\WebProfilerExtraBundle();
            $bundles[] = new \Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new \Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new \JMS\DebuggingBundle\JMSDebuggingBundle($this);
        }
        
        return $bundles;
    }
    
    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $dir = $this->getAppDir();
        $loader->load($dir.'/config/config_'.$this->environment.'.yml');
        
        if (is_file($file = $dir.'/config/config_'.$this->environment.'.local.yml')) {
            $loader->load($file);
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        if ($this->isVagrantEnvironment()) {
            return '/dev/shm/pms/cache/'.$this->environment;
        }
        
        return parent::getCacheDir();
    }
    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        if ($this->isVagrantEnvironment()) {
            return '/dev/shm/pms/log/'.$this->environment;
        }
        
        return parent::getLogDir();
    }
    
    /**
     * Is this a vagrant environment
     * @return boolean
     */
    protected function isVagrantEnvironment()
    {
        return (getenv('HOME') === '/home/vagrant' || getenv('VAGRANT') === 'VAGRANT') && is_dir('/dev/shm');
    }
    
    /**
     * Get app directory
     * @return string
     */
    protected function getAppDir()
    {
        $reflection = new ReflectionClass(get_class($this));
        
        return dirname($reflection->getFilename());
    }
}
