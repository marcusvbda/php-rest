<?php

namespace MyRest\Repository;

use MyRest\Psr11;
use ByJG\AnyDataset\Db\DbDriverInterface;
use ByJG\MicroOrm\FieldMapping;
use ByJG\MicroOrm\Mapper;
use ByJG\MicroOrm\Query;
use ByJG\MicroOrm\Repository;
use MyRest\Model\ExampleCrud;

class ExampleCrudRepository extends BaseRepository
{
    /**
     * ExampleCrudRepository constructor.
     *
     * @param DbDriverInterface $dbDriver
     *
     */
    public function __construct(DbDriverInterface $dbDriver)
    {
        $mapper = new Mapper(
            ExampleCrud::class,
            'example_crud',
            'id'
        );
        // $mapper->withPrimaryKeySeedFunction(BaseRepository::getClosureNewUUID());


        // Table UUID Definition
        // $this->setClosureFixBinaryUUID($mapper);


        $this->repository = new Repository($dbDriver, $mapper);
    }


}
