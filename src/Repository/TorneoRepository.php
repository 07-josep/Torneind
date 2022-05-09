<?php

namespace App\Repository;

use App\Entity\Modalidad;
use App\Entity\Torneo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method Torneo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Torneo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Torneo[]    findAll()
 * @method Torneo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TorneoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Torneo::class);
    }

    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function getAllPaginated(Request $request, PaginatorInterface $paginator)
    {
        $qb = $this->createQueryBuilder('t');
        $qb->orderBy('t.fecha', 'DESC');
        $qb->setMaxResults(6);
        $query = $qb->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),6
        );
        return $pagination;
    }

    /**
     * @param $data
     * @param $data2
     * @return mixed
     */

    public function findBetweenDatesPaginated($data, $data2)
    {
        $qb = $this->createQueryBuilder('t');
        $qb->where('t.fecha >=:data');
        $qb->andWhere('t.fecha <=:data2');
        $qb->orderBy('t.fecha', 'DESC');
        $qb->setParameter('data',$data);
        $qb->setParameter('data2',$data2);
        $query = $qb->getQuery();
        return $query;
    }

    /**
     * @param $text
     * @return \Doctrine\ORM\Query
     */

    public function findTextPaginated($text){
        $qb = $this->createQueryBuilder('t');
        $qb->where("t.nombre LIKE :value");
        $qb->orWhere("t.descripcion LIKE :value");
        $qb->orderBy('t.fecha', 'DESC');
        $qb->setParameter('value',"%$text%");
        $query = $qb->getQuery();
        return $query;
    }


    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function getAllPaginatedTusTorneos(Request $request, PaginatorInterface $paginator)
    {
        $qb = $this->createQueryBuilder('t');
        $qb->setMaxResults(5);
        $query = $qb->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),5
        );
        return $pagination;
    }

    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param Modalidad $categoria
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */

    public function getAllPaginatedByCategoria(Request $request, PaginatorInterface $paginator, Modalidad  $categoria)
    {
        $qb = $this->createQueryBuilder('t')->where('t.modalidad = :value');
        $qb->setParameter('value', $categoria);
        $qb->orderBy('t.fecha', 'DESC');
        $qb->setMaxResults(6);
        $query = $qb->getQuery();
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),6
        );
        return $pagination;
    }




    // /**
    //  * @return Torneo[] Returns an array of Torneo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Torneo
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
