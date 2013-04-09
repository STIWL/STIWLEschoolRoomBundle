<?php

namespace Esolving\Eschool\RoomBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * StudentInscribeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StudentInscribeRepository extends EntityRepository {

    public function findYearsInscribe() {
        $qb = $this->createQueryBuilder('studentInscribe');
        $qb->groupBy('studentInscribe.inscribedYearAt');
        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function findAllInscribeCurrentYear() {
        $qb = $this->createQueryBuilder('studentInscribe');
        $qb->where($qb->expr()->eq('studentInscribe.inscribedYearAt', ':thisYear'))
                ->setParameter('thisYear', date('Y'))
        ;
        $query = $qb->getQuery();
        $result = $query->getResult();
        return $result;
    }

    public function findAllBySectionIdByHeadquarterIdByLanguageByCriteria($sectionId, $heaquarterId, $language, $criteria = array()) {
        $defaults = array(
            'dateStart' => null,
            'dateEnd' => null
        );
        $criteria = array_merge($defaults, $criteria);

        $qb = $this->createQueryBuilder('studentInscribe');
        $qb->addSelect('student', 'user', 'room', 'room_roomType', 'room_roomType_languages', 'room_sectionType', 'room_sectionType_languages', 'room_headquarterType', 'room_headquarterType_languages')
                ->join('studentInscribe.student', 'student')
                ->join('student.user', 'user')
                ->join('studentInscribe.room', 'room')
                ->join('room.roomType', 'room_roomType')
                ->join('room_roomType.languages', 'room_roomType_languages')
                ->join('room.sectionType', 'room_sectionType')
                ->join('room_sectionType.languages', 'room_sectionType_languages')
                ->join('room.headquarterType', 'room_headquarterType')
                ->join('room_headquarterType.languages', 'room_headquarterType_languages')
                ->where($qb->expr()->eq('room_roomType_languages.language', $qb->expr()->literal($language)))
                ->andWhere($qb->expr()->eq('room_sectionType_languages.language', $qb->expr()->literal($language)))
                ->andWhere($qb->expr()->eq('room_headquarterType_languages.language', $qb->expr()->literal($language)))
                ->andWhere($qb->expr()->eq('room_sectionType.id', ':sectionId'))
                ->andWhere($qb->expr()->eq('room_headquarterType.id', ':headquarterId'))
                ->setParameter('sectionId', $sectionId)
                ->setParameter('headquarterId', $heaquarterId);


        if ($criteria['dateStart'] && $criteria['dateEnd']) {
            $qb->andWhere($qb->expr()->between('studentInscribe.inscribedAt', ':dateStart', ':dateEnd'));
            $qb->setParameter('dateStart', $criteria['dateStart']);
            $qb->setParameter('dateEnd', $criteria['dateEnd']);
        }

        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function findOneByStudentInscribeIdByLanguage($studentInscribeId, $language) {
        $qb = $this->createQueryBuilder('studentInscribe');
        $qb->addSelect('student', 'user', 'room', 'room_roomType', 'room_roomType_languages', 'room_sectionType', 'room_sectionType_languages', 'room_headquarterType', 'room_headquarterType_languages')
                ->join('studentInscribe.student', 'student')
                ->join('student.user', 'user')
                ->join('studentInscribe.room', 'room')
                ->join('room.roomType', 'room_roomType')
                ->join('room_roomType.languages', 'room_roomType_languages')
                ->join('room.sectionType', 'room_sectionType')
                ->join('room_sectionType.languages', 'room_sectionType_languages')
                ->join('room.headquarterType', 'room_headquarterType')
                ->join('room_headquarterType.languages', 'room_headquarterType_languages')
                ->where($qb->expr()->eq('room_roomType_languages.language', $qb->expr()->literal($language)))
                ->andWhere($qb->expr()->eq('room_sectionType_languages.language', $qb->expr()->literal($language)))
                ->andWhere($qb->expr()->eq('room_headquarterType_languages.language', $qb->expr()->literal($language)))
                ->andWhere('studentInscribe.id = :studentInscribeId')
                ->setParameter('studentInscribeId', $studentInscribeId)
        ;

        $query = $qb->getQuery();
        return $query->getOneOrNullResult();
    }

}
