<?php
    namespace Shop\Controller;
    
    use Zend\View\Model\ViewModel;
    use Zend\View\Model\JsonModel;
    
    use Core\Controller\BaseController;
	
	use Mosaic\Form\ContactForm;

	/** The sole controller of the Mosaic module. */
    class ShopController extends BaseController
    {
    	// Properties.
    	private $ProductTable;
		protected $AddressTable;
		protected $OrderTable;
		protected $OrderProductTable;
		
        /** Retrieves the ProductTable instance. */
        public function getProductTable()
        {
            // If the PictureTable is null, it gets loaded from the ServiceManager.
            if($this->ProductTable == null)
            {
                $ServiceLocator = $this->getServiceLocator();
                $this->ProductTable = $ServiceLocator->get('Mosaic\Model\ProductTable');
            }
            return $this->ProductTable;
        }
		
        /** Retrieve the AddressTable instance. */
        public function getAddressTable()
        {
            /* If the UserTable is null, it gets loaded from the ServiceManager. */
            if($this->AddressTable == null)
            {
                $this->AddressTable = $this->getServiceLocator()->get('User\Model\AddressTable');
            }
            return $this->AddressTable;
        }
		
        /** Retrieve the OrderTable instance. */
        public function getOrderTable()
        {
            /* If the UserTable is null, it gets loaded from the ServiceManager. */
            if($this->OrderTable == null)
            {
                $this->OrderTable = $this->getServiceLocator()->get('Mosaic\Model\OrderTable');
            }
            return $this->OrderTable;
        }
		
        /** Retrieve the OrderProductTable instance. */
        public function getOrderProductTable()
        {
            // If the UserTable is null, it gets loaded from the ServiceManager.
            if($this->OrderProductTable == null)
            {
                $this->OrderProductTable = $this->getServiceLocator()->get('Mosaic\Model\OrderProductTable');
            }
            return $this->OrderProductTable;
        }
    }
?>