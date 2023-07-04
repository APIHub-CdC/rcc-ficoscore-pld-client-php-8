<?php

namespace RCCFSPLD\MX\Client\Model;

use \ArrayAccess;
use \RCCFSPLD\MX\Client\ObjectSerializer;

class Score implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;
    
    protected static $apihubModelName = 'Score';
    
    protected static $apihubTypes = [
        'nombre_score' => 'string',
        'valor' => 'int',
        'razones' => '\RCCFSPLD\MX\Client\Model\CatalogoRazones[]'
    ];
    
    protected static $apihubFormats = [
        'nombre_score' => null,
        'valor' => 'int32',
        'razones' => null
    ];
    
    public static function apihubTypes()
    {
        return self::$apihubTypes;
    }
    
    public static function apihubFormats()
    {
        return self::$apihubFormats;
    }
    
    protected static $attributeMap = [
        'nombre_score' => 'nombreScore',
        'valor' => 'valor',
        'razones' => 'razones'
    ];
    
    protected static $setters = [
        'nombre_score' => 'setNombreScore',
        'valor' => 'setValor',
        'razones' => 'setRazones'
    ];
    
    protected static $getters = [
        'nombre_score' => 'getNombreScore',
        'valor' => 'getValor',
        'razones' => 'getRazones'
    ];
    
    public static function attributeMap()
    {
        return self::$attributeMap;
    }
    
    public static function setters()
    {
        return self::$setters;
    }
    
    public static function getters()
    {
        return self::$getters;
    }
    
    public function getModelName()
    {
        return self::$apihubModelName;
    }
    
    
    
    protected $container = [];
    
    public function __construct(array $data = null)
    {
        $this->container['nombre_score'] = isset($data['nombre_score']) ? $data['nombre_score'] : null;
        $this->container['valor'] = isset($data['valor']) ? $data['valor'] : null;
        $this->container['razones'] = isset($data['razones']) ? $data['razones'] : null;
    }
    
    public function listInvalidProperties()
    {
        $invalidProperties = [];
        if (!is_null($this->container['valor']) && ($this->container['valor'] > 900)) {
            $invalidProperties[] = "invalid value for 'valor', must be smaller than or equal to 900.";
        }
        if (!is_null($this->container['valor']) && ($this->container['valor'] < 0)) {
            $invalidProperties[] = "invalid value for 'valor', must be bigger than or equal to 0.";
        }
        return $invalidProperties;
    }
    
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }
    
    public function getNombreScore()
    {
        return $this->container['nombre_score'];
    }
    
    public function setNombreScore($nombre_score)
    {
        $this->container['nombre_score'] = $nombre_score;
        return $this;
    }
    
    public function getValor()
    {
        return $this->container['valor'];
    }
    
    public function setValor($valor)
    {
        if (!is_null($valor) && ($valor > 900)) {
            throw new \InvalidArgumentException('invalid value for $valor when calling Score., must be smaller than or equal to 900.');
        }
        if (!is_null($valor) && ($valor < 0)) {
            throw new \InvalidArgumentException('invalid value for $valor when calling Score., must be bigger than or equal to 0.');
        }
        $this->container['valor'] = $valor;
        return $this;
    }
    
    public function getRazones()
    {
        return $this->container['razones'];
    }
    
    public function setRazones($razones)
    {
        $this->container['razones'] = $razones;
        return $this;
    }
    
    public function offsetExists($offset) : bool
    {
        return isset($this->container[$offset]);
    }
    
    public function offsetGet($offset) : bool
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
    
    public function offsetSet($offset, $value) : void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }
    
    public function offsetUnset($offset) : void
    {
        unset($this->container[$offset]);
    }
    
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) {
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
