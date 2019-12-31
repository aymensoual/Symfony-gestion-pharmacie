c<?php

namespace CatalogueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RechercheType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('motcle')
        ->add('medicament','entity',
                array('class'=>'CatalogueBundle:Medicament'
                    ,'property'=>'nom'
                    ,'multiple'=>false,'expanded'=>true));
    }
    
  

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cataloguebundle_recherche';
    }


}
