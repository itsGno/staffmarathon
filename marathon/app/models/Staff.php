<?php

class Staff extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fname;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $lname;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $category;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $username;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $password;
    
    public $images;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("marathon");
        $this->setSource("staff");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'staff';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Staff[]|Staff|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Staff|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
