<?php

namespace Esolving\Eschool\RoomBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\DependencyInjection\Container;
use Doctrine\ORM\EntityManager;

class RoomType extends AbstractType {

    private $container;
    private $em;

    public function __construct(Container $container, EntityManager $em) {
        $this->container = $container;
        $this->em = $em;
    }

    public function getTypeByCategoryByLanguage($xcategory, $xlanguage) {
        return $getSex = $this
                ->em
                ->getRepository("EsolvingEschoolCoreBundle:Type")
                ->findByCategoryByLanguage($xcategory, $xlanguage);
        ;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//                ->add('createdAt')
//                ->add('updatedAt')
//                ->add('disabledAt')
                ->add('roomType', null, array(
                    'group_by' => 'roomType',
                    'choices' => $this->getTypeByCategoryByLanguage("room", $this->container->get('request')->getLocale()),
                    'property' => 'languages.values[0].description',
                    'required' => true,
                    'label' => 'room'
                        )
                )
                ->add('headquarterType', null, array(
                    'group_by' => 'headquarterType',
                    'choices' => $this->getTypeByCategoryByLanguage("headquarter", $this->container->get('request')->getLocale()),
                    'property' => 'languages.values[0].description',
                    'required' => true,
                    'label' => 'headquarter'
                        )
                )
                ->add('sectionType', null, array(
                    'group_by' => 'sectionType',
                    'choices' => $this->getTypeByCategoryByLanguage("section", $this->container->get('request')->getLocale()),
                    'property' => 'languages.values[0].description',
                    'required' => true,
                    'label' => 'section'
                        )
                )
                ->add('status')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Esolving\Eschool\RoomBundle\Entity\Room'
        ));
    }

    public function getName() {
        return 'esolving_bundle_eschool_roombundle_room';
    }

}
