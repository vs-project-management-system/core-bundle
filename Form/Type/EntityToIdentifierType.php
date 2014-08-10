<?php
namespace PMS\Bundle\CoreBundle\Form\Type;

use \PMS\Bundle\CoreBundle\Form\DataTransformer\EntityToIdentifierTransformer;

class EntityToIdentifierType extends \Symfony\Component\Form\AbstractType
{
    /**
     * Object Manager.
     *
     * @var type ObjectManager
     */
    protected $om;

    public function __construct(\Doctrine\Common\Persistence\ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(
            new EntityToIdentifierTransformer($this->om->getRepository($options['class']), $options['identifier'])
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(
                array(
                    'identifier' => 'id'
                )
            )
            ->setAllowedTypes(
                array(
                    'identifier' => array('string')
                )
            );
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'entity';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'pms_entity_to_identifier';
    }
}
