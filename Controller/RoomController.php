<?php

namespace Esolving\Eschool\RoomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Esolving\Eschool\RoomBundle\Entity\Room;
use Symfony\Component\HttpFoundation\Request;
use Esolving\Eschool\RoomBundle\Form\Type\RoomType;

class RoomController extends Controller {
    public function submenuAction(){
        return $this->render('EsolvingEschoolRoomBundle:Room:submenu.html.twig');
    }
}
