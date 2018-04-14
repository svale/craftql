<?php

namespace markhuot\CraftQL\Builder2;

use markhuot\CraftQL\Builder2\Attributes\HasFieldsConfig;
use markhuot\CraftQL\Builder2\Attributes\HasInterfaceAttribute;
use markhuot\CraftQL\Builder2\Attributes\HasNameAttribute;

class ObjectType extends GraphQLBuilder {

    use HasNameAttribute;
    use HasFieldsConfig;
    use HasInterfaceAttribute;

    /**
     * ObjectType constructor.
     * @param $name
     */
    function __construct(string $name) {
        $this->name = $name;
    }

    /**
     * Get a configuration array
     *
     * @return array
     */
    protected function config(): array {
        return [
            'name' => $this->name,
            'fields' => array_map(function (FieldType $field) {
                return $field->toGraphQL();
            }, $this->fields),
            'interfaces' => array_map(function (InterfaceType $interface) {
                return $interface->toGraphQL();
            }, $this->getInterfaces()),
        ];
    }

}