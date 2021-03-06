<?php

class Emergencyreport extends \Phalcon\Mvc\Model
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
    public $header;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $detail;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $runnerId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $staffId;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $lag;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $lng;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    public $status;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $level;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("marathon");
        $this->setSource("emergencyreport");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'emergencyreport';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Emergencyreport[]|Emergencyreport|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Emergencyreport|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
