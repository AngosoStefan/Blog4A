<?php

namespace ABS\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SerieType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('file')
            ->add('releaseDate', 'date', array('years' => range(1920, date('Y'))))
            ->add('director')
            ->add('seasons')
            ->add('duration')
            ->add('actor1')
            ->add('actor2')
            ->add('actor3')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ABS\BlogBundle\Entity\Serie'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'abs_blogbundle_serie';
    }
}
