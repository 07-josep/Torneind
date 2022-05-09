<?php

namespace App\Repository;

use App\Entity\Modalidad;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method Usuario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usuario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuario[]    findAll()
 * @method Usuario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuario::class);
    }
    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function getAllPaginated(Request $request, PaginatorInterface $paginator)
    {
        $qb = $this->createQueryBuilder('u');
        $qb->setMaxResults(4);
        $query = $qb->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),4
        );
        return $pagination;
    }

    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param string $tipo
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */

    public function getAllPaginatedByRole(Request $request, PaginatorInterface $paginator, string $tipo)
    {
        $qb = $this->createQueryBuilder('u')->where('u.role = :value');
        $qb->setParameter('value', $tipo);
        $qb->setMaxResults(4);
        $query = $qb->getQuery();
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),4
        );
        return $pagination;
    }

    /**
     * @param $text
     * @return \Doctrine\ORM\Query
     */

    public function findTextPaginated($text){
        $qb = $this->createQueryBuilder('u');
        $qb->where("u.nombre LIKE :value");
        $qb->orWhere("u.correo LIKE :value");
        $qb->setParameter('value',"%$text%");
        $query = $qb->getQuery();
        return $query;
    }

    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function userListPaginated(Request $request, PaginatorInterface $paginator)
    {
        $qb = $this->createQueryBuilder('u');
        $qb->setMaxResults(10);
        $query = $qb->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),10
        );
        return $pagination;
    }

}
