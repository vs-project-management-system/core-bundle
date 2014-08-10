<?php
namespace PMS\Bundle\CoreBundle\Form\Type;

class SearchFormType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder->add('query');
    }
    
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver)
    {
    }
    
    public function getName()
    {
        return 'search';
    }
}
