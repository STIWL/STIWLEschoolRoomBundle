<?php

namespace Esolving\Eschool\RoomBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

/**
 * Description of RoomUniqueConstraints
 *
 * @author luchin
 */
class RoomUniqueConstraintsValidator extends ConstraintValidator {

    private $em;
    private $container;

    public function __construct(EntityManager $em, Container $container) {
        $this->em = $em;
        $this->container = $container;
    }

    public function validate($value, Constraint $constraint) {

        $roomType = $value->getRoomType();
        $headquarterType = $value->getHeadquarterType();
        $sectionType = $value->getSectionType();
        $room = $this->em->getRepository('EsolvingEschoolRoomBundle:Room')->findOneBy(array('roomType' => $roomType, 'headquarterType' => $headquarterType, 'sectionType' => $sectionType));
        if ($room) {
            return $this->context->addViolation($constraint->message);
        }
    }

}

?>
