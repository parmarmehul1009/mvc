<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Attribute extends \Model\Core\Table
{
    const TEXT = 'text';
    const VARCHAR = 'varchar';
    const INT = 'int';
    const DECIMAL = 'text';
    const TEXTAREA = 'textarea';
    const SELECT = 'select';
    const CHECKBOX = 'chechbox';
    const RADIO = 'radio';
    const PRODUCT = 'product';
    const CATEGORY = 'category';

    public function __construct()
    {
        $this->setPrimaryKey('attributeId');
        $this->setTableName('attribute');
    }

    public function getInputTypeOptions()
    {
        return [
            self::CHECKBOX => 'Checkbox',
            self::RADIO => 'Radio',
            self::TEXT => 'Text',
            self::TEXTAREA => 'Text Area',
            self::SELECT => 'select',
        ];
    }

    public function getBackendTypeOptions()
    {
        return [
            self::INT => 'INT',
            self::TEXT => 'Text',
            self::VARCHAR => 'Varchar'
        ];
    }

    public function getEntityTypeOptions()
    {
        return [
            self::PRODUCT => 'Product',
            self::CATEGORY => 'Category',
        ];
    }
}
