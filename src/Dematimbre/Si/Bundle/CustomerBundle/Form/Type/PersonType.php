<?php

namespace Dematimbre\Si\Bundle\CustomerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Person entity.
 */
class PersonType extends AbstractType
{
    /**
     * @see FormInterface::getName()
     */
    public function getName()
    {
        return 'person';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dematimbre\Si\Component\Customer\Entity\Person',
            'csrf_protection' => true,
            'allow_extra_fields' => false,
            'cascade_validation' => false,
            'intention' => null,
        ));
    }

    /**
     * @see FormInterface::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        // *************************************************
        //
        // Class auto generated by MajoraGeneratorBundle
        // Implement your own logic here !
        //
        // *************************************************
    }
}