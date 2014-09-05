<?php
class Sedo_Pck_Listener
{
	public static function extendViewPublicPageView($class, array &$extend)
	{
		if($class == 'XenForo_ViewPublic_Page_View')
		{
			$extend[] = 'Sedo_Pck_ViewPublic_Page_View';
		}	
	}

	public static function extendViewAdminPageEdit($class, array &$extend)
	{
		if($class == 'XenForo_ViewAdmin_Page_Edit')
		{
			$extend[] = 'Sedo_Pck_ViewAdmin_Page_Edit';
		}	
	}	
}