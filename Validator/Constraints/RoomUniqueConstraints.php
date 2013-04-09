<?php

namespace Esolving\Eschool\RoomBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Description of RoomUniqueConstraints
 *
 * @author luchin
 * @Annotation
 */
class RoomUniqueConstraints extends Constraint {

    public $message = 'was_registered_before';

    public function getTargets() {
        return self::CLASS_CONSTRAINT;
    }
    
    public function validatedBy() {
        return 'RoomUniqueConstraintsValidator';
    }

}

?>
