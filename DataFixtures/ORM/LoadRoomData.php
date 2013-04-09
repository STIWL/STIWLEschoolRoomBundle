<?php

namespace Esolving\Eschool\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Esolving\Eschool\RoomBundle\Entity\Room;

class LoadRoomData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    protected $manager;
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $this->manager = $manager;
        $rooms = array(
            '1a' => array(
                'roomType_id' => 'room_1a',
                'headquarterType_id' => 'headquarter_atte',
                'sectionType_id' => 'section_initial'
            ),
            '2a' => array(
                'roomType_id' => 'room_2a',
                'headquarterType_id' => 'headquarter_atte',
                'sectionType_id' => 'section_initial'
            ),
            '1a' => array(
                'roomType_id' => 'room_1a',
                'headquarterType_id' => 'headquarter_atte',
                'sectionType_id' => 'section_secundary'
            ),
            '2a' => array(
                'roomType_id' => 'room_2a',
                'headquarterType_id' => 'headquarter_atte',
                'sectionType_id' => 'section_secundary'
            )
        );

        foreach ($rooms as $roomK => $roomV) {
                $room = new Room();
                $room->setRoomType($this->getReference($roomV['roomType_id']));
                $room->setHeadquarterType($this->getReference($roomV['headquarterType_id']));
                $room->setSectionType($this->getReference($roomV['sectionType_id']));
                $manager->persist($room);
                $this->addReference($roomK, $room);
        }
        $manager->flush();
    }

    public function getOrder() {
        return 2;
    }

}
