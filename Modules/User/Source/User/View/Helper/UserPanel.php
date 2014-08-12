<?php
	namespace User\View\Helper;
	
	use Zend\View\Helper\AbstractHelper;
	
	class UserPanel extends AbstractHelper
	{
		public function __invoke()
		{
			// Fetch email from the session data so it can be interpolated in the HTML code.
			$Email = $_SESSION['User']['Email'];
			echo "<li class='menu btn-group accessories'>
						<a class='dropdown-toggle' data-toggle='dropdown' href='#'>$Email</a>
						<ul class='dropdown-menu'>
				  			<li><a href='/user/account'>My account</a></li>
				  			<li><a href='/user/addresses'>My addresses</a></li>
				  			<li><a href='/user/orders'>My orders</a></li>
						</ul>
					</li>";
		}
	}
?>