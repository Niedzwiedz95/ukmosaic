<?php
    /* Namespace which holds all the models used in the Core module. */
    namespace Core\Model;

    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Adapter\Adapter;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Validator\File;
    
    use Core\Model\BaseModel;
    
    /** Base class for all tables in the whole site. */
    abstract class BaseTable
    {
        /** TableGateway instance used to execute most queries. */
        protected $TableGateway;
        
        /** Adapter instance used to execute queries to the Acitvations table. */
        protected $DB;
        
        /** Constructor, initializes the $TableGateway attribute with the provided instance of TableGateway class.
         *  Also sets the $DB property to the appropriate adapter so non-standard queries can be executed too. */
        public function __construct(TableGateway $TableGateway)
        {
            $this->TableGateway = $TableGateway;
            $this->DB = $TableGateway->getAdapter();
        }
        /** Returns the Adapter instance used to perform queries. */
        public function getDB()
        {
            return $this->DB;
        }
        /** Returns the TableGateway instance. */
        public function getTableGateway()
        {
            return $this->TableGateway;
        }
        /** Uses TableGateway::select method to select object derived from BaseModel. */
        public function select($Where = null)
        {
            if($Where == null)
            {
                return $this->TableGateway->select();
            }
            else if(is_array($Where))
            {
                return $this->TableGateway->select($Where);
            }
            else if(is_a($Where, '\Core\Model\BaseModel') || is_subclass_of($Where, '\Core\Model\BaseModel'))
            {
                return $this->TableGateway->select($Where->toArray());
            }
            else
            {
                throw new \Exception('$Where in BaseModel::select has incorrect type!');
            }
        }
        /** Uses TableGateway::insert method to insert object derived from BaseModel to the table. */
        public function insert(BaseModel $Set)
        {
            return $this->TableGateway->insert($Set->toArray()) == 1;
        }
        /** Saves an user to the database. */
        public function update(BaseModel $Set, BaseModel $Where)
        {
            return $this->TableGateway->update($Set->toArray(), $Where->toArray());
        }
        /** Uses TableGateway::delete method to delete object derived from BaseModel from the table. */
        public function delete(BaseModel $Where)
        {
            return $this->TableGateway->delete($Where->toArray()) == 1;
        }
        /** Return a random string of requested length. */ 
        public function getRandomString($Length, $Range = null)
        {
            /* List of all character permitted in the random string. */
            $Chars = "acbdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789~!@#$%^&*()_+[]\;',./{}|:<>?";
            
            /* Check if range is specified. */ 
            if($Range == null)
            {
                $Range = strlen($Chars) - 1;
            }
            /* Generate and return the string. */
            $String = '';
            for($i = 0; $i < $Length; ++$i)
            {
                $String .= $Chars[rand(0, $Range)];
            }
            return $String;
        }
    }
?>