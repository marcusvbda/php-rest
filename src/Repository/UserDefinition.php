<?php

namespace MyRest\Repository;

use ByJG\AnyDataset\Db\DbDriverInterface;
use ByJG\Authenticate\Model\UserModel;
use ByJG\MicroOrm\Literal;
use MyRest\Psr11;
use MyRest\Util\HexUuidLiteral;

class UserDefinition extends \ByJG\Authenticate\Definition\UserDefinition
{
    public function __construct($table = 'users', $model = UserModel::class, $loginField = self::LOGIN_IS_USERNAME, $fieldDef = [])
    {
        parent::__construct($table, $model, $loginField, $fieldDef);

        $this->markPropertyAsReadOnly("uuid");
        $this->markPropertyAsReadOnly("created");
        $this->markPropertyAsReadOnly("updated");
        $this->defineGenerateKeyClosure(function () {
                    return new Literal("X'" . Psr11::container()->get(DbDriverInterface::class)->getScalar("SELECT hex(uuid_to_bin(uuid()))") . "'");
                }
        );

        $this->defineClosureForSelect(
            "userid",
            function ($value, $instance) {
                if (!method_exists($instance, 'getUuid')) {
                    return $value;
                }
                if (!empty($instance->getUuid())) {
                    return $instance->getUuid();
                }
                return $value;
            }
        );

        $this->defineClosureForUpdate(
            'userid',
            function ($value, $instance) {
                if (empty($value)) {
                    return null;
                }
                if (!($value instanceof Literal)) {
                    $value = new HexUuidLiteral($value);
                }
                return $value;
            }
        );
    }

}