<?php

namespace App\Repository;

use App\Entity\Appointment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Appointment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Appointment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appointment[]    findAll()
 * @method Appointment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppointmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appointment::class);
    }

    public function findTodayAppointments()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT COUNT(*) countToday FROM Appointment a
            WHERE a.date = CURRENT_DATE 

            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $todayAppointment = $stmt->fetchAllAssociative();

        foreach ($todayAppointment as $aa)
            $result = $aa;
        return $result;
    }

    public function getTodayAppointments()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT a.start_time, b.first_name, s.title
	            FROM Appointment a INNER JOIN user b
                ON a.barber_id = b.id
                INNER JOIN service s
                ON a.service_id = s.id
                WHERE a.date = CURRENT_DATE
                ORDER BY a.start_time
                ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAllAssociative();
    }

    public function findThisWeekAppointments()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT COUNT(*) FROM Appointment a
            WHERE week(a.date) = week(CURRENT_DATE) 

            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $thisWeekAppointment = $stmt->fetchAllAssociative();

        foreach ($thisWeekAppointment as $aa)
            $result = $aa;
        return $result;
    }

    public function getThisWeekAppointments() : array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT DAYNAME(date) day, COUNT(*) count FROM Appointment a
            WHERE week(a.date) = week(CURRENT_DATE) 
            GROUP BY day, DAYOFWEEK(a.date)
            ORDER BY DAYOFWEEK(a.date)

            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAllAssociative();

    }


    public function getTodayAppointmentsBarber() : array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT b.first_name name, IFNULL(a.date=CURRENT_DATE,0) count FROM user b
                LEFT OUTER JOIN appointment a ON b.id=a.barber_id
                WHERE b.type= "barber"
                GROUP BY name, count
                ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAllAssociative();

    }

    /*
    public function getAppointmentsLastDays(): array
    {

        $conn  = $this->getEntityManager()->getConnection();
        $sql = 'SELECT COUNT(id) num, DATE(create) d FROM Appointment GROUP BY DATE(create)';
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAllAssociative();
        } catch (\Doctrine\DBAL\Exception | Exception $e) {
        }

    }
    */

    // /**
    //  * @return Appointment[] Returns an array of Appointment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Appointment
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
