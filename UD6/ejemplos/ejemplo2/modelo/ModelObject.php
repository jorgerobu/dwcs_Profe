<?php
abstract class ModelObject{
    abstract public function fromJson($json):ModelObject;
    abstract public function toJson():String;
}