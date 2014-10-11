<?php
	namespace Mosaic\Model;
    
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Adapter\Adapter;
	use Zend\Db\TableGateway\TableGateway;
	
    use Core\Model\BaseTable;
    
	/**	TableGateway to the Products table. */
	class ProductTable extends BaseTable
	{
		/** Inserts a product to the database. Takes care of all the file operations. */
		public function insertProduct($FileTransfer, array $Data)
        {
        	// Save the most needed properties in variables.
        	$Category = explode('_', $Data['category'])[0];
        	$Subcategory = explode('_', $Data['category'])[1];
			$ProductName = $Data['productName'];
			$OldName = $Data['picture']['name'];
			
			// Fetch the extension from the old filename and assemble the new filename.
			$Parts = explode('.', $OldName);
			$Extension = $Parts[count($Parts) - 1];
			$NewName = "$ProductName.$Extension";
			
            // $DBPath is the path that is kept in the database and is used in the src attribute. $FullPath is the path
            // that is the real path used to check if folder exists and so on.
            $DBPath = "/img/catalogue/$Category/$Subcategory/$NewName";
            $FullPath = getcwd() . "/public_html/img/catalogue/$Category/$Subcategory/";
			
            // Build up the product instance.
            $Product = new \Mosaic\Model\Product(
			[
				'ProductName' => $Data['productName'],
				'Category' => $Data['category'],
				'Path' => $DBPath,
				'Description' => $Data['description'],
				'Price' => $Data['price'],
				'PriceSquareLoose' => $Data['priceSquareLoose'] != '' ? $Data['priceSquareLoose'] : null,
				'PriceSquareAssembled' => $Data['priceSquareAssembled'] != '' ? $Data['priceSquareAssembled'] : null,
				'PriceLinearLoose' => $Data['priceLinearLoose'] != '' ? $Data['priceLinearLoose'] : null,
				'PriceLinearAssembled' => $Data['priceLinearAssembled'] != '' ? $Data['priceLinearAssembled'] : null,
				'Price1x1' => $Data['price1x1'] != '' ? $Data['price1x1'] : null,
				'Price2x2' => $Data['price2x2'] != '' ? $Data['price2x2'] : null,
				'Price25x25' => $Data['price25x25'] != '' ? $Data['price25x25'] : null
			]);
			
            // Set the destination of the file transfer and transfer the file.
            $FileTransfer->setDestination($FullPath);
            if($FileTransfer->receive($OldName))
            {
            	// Assemble the names of functions used to create and save the picture.
                $create = 'imagecreatefrom' . ($Extension == 'jpg' ? 'jpeg' : $Extension);
                $save = 'image' . ($Extension == 'jpg' ? 'jpeg' : $Extension);
				
                // Create the old image's resource.
                $OldImage = $create("$FullPath/$OldName");
				
                // Save the new picture and delete the old one.
				$save($OldImage, "$FullPath/$NewName");
                shell_exec("rm -f $FullPath/$OldName");
				
            	// Insert the new product to the database.
				$this->insert($Product);
            }
            else
            {
                throw new \Exception('Error while transferring the file!');
            }
        }    
	}
?>