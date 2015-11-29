<?php

namespace ABS\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CelebrityType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('dateOfBirth', 'date', array('years' => range(1920, date('Y'))))
            ->add('file')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ABS\BlogBundle\Entity\Celebrity'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'abs_blogbundle_celebrity';
    }
}
