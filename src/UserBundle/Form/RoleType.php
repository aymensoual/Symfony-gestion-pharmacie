<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RoleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('role','choice', array ('choices'=>array('ROLE_ADMIN'=>'Admin','ROLE_USER'=>'User','ROLE_AGENT'=>'Agent')));
               
                
    }/**
     * {@inheritdoc}
     */
 
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_role';
    }


}