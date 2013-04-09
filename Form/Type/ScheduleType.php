<?php

namespace Esolving\Eschool\RoomBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ScheduleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('timeStart', null, array('label' => 'time_start'))
                ->add('timeEnd', null, array('label' => 'time_end'))
                ->add('teacher', null, array('label' => 'teacher'))
                ->add('room', null, array('label' => 'room'))
                ->add('status', null, array('label' => 'status'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Esolving\Eschool\RoomBundle\Entity\Schedule',
            'translation_domain' => "EsolvingEschoolRoomBundle"
        ));
    }

    public function getName() {
        return 'esolving_bundle_eschool_roomB_Schedule';
    }

}

?>
